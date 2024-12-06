<?php require_once 'core/dbConfig.php'; ?>
<?php require_once 'core/models.php'; ?>

<?php  
if (!isset($_SESSION['username'])) {
	header("Location: login.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>User Profile</title>
	<link rel="stylesheet" href="styles/styles.css">
	<style>
		/* General body styles */
		body {
			background-color: #121212;  /* Dark background */
			color: #ffffff;              /* Light text color */
		}

		/* Navbar styles */
		.navbar {
			background-color: #1e1e1e;  /* Darker navbar */
		}

		/* Container styles */
		.container {
			display: flex;
			justify-content: center;
		}

		/* User info styles */
		.userInfo {
			background-color: #1e1e1e;  /* Dark background for user info */
			border: 1px solid #444;      /* Light gray border */
			width: 50%;
			text-align: center;
			padding: 15px;               /* Padding for better spacing */
			border-radius: 5px;          /* Rounded corners */
		}

		/* Album container styles */
		.albumContainer {
			background-color: #1e1e1e;  /* Dark background for album containers */
			border: 1px solid #444;      /* Light gray border */
			width: 50%;
			text-align: center;
			padding: 20px;               /* Padding */
			margin-top: 25px;            /* Margin for spacing */
			border-radius: 5px;          /* Rounded corners */
		}

		/* Link styles */
		a {
			color: #1e90ff;              /* Bright blue for links */
			text-decoration: none;       /* Remove underline */
		}

		a:hover {
			text-decoration: underline;  /* Underline on hover */
		}
	</style>
</head>
<body>
	<?php include 'navbar.php'; ?>

	<?php 
	$getUserByID = getUserByID($pdo, $_GET['username']); 
	?>

	<div class="container">
		<div class="userInfo">
			<h3>Username: <span style="color: #1e90ff;"><?php echo $getUserByID['username']; ?></span></h3>
			<h3>First Name: <span style="color: #1e90ff;"><?php echo $getUserByID['first_name']; ?></span></h3>
			<h3>Last Name: <span style="color: #1e90ff;"><?php echo $getUserByID['last_name']; ?></span></h3>
			<h3>Date Joined: <span style="color: #1e90ff;"><?php echo $getUserByID['date_added']; ?></span></h3>
		</div>
	</div>

	<?php 
	$getAllAlbums = getAllAlbums($pdo, $_GET['username']); 
	if (empty($getAllAlbums)) {
		echo '<p style="text-align: center; margin-top: 20px; color: #ffffff;">No albums to display.</p>';
	} else {
		foreach ($getAllAlbums as $album) { 
	?>
		<div class="albums" style="display: flex; justify-content: center;">
			<div class="albumContainer">
				<h3><?php echo $album['album_name']; ?></h3>
				<p>Created by: <span style="color: #1e90ff;"><?php echo $album['username']; ?></span></p>
				<p><i><?php echo $album['date_created']; ?></i></p>
				<a href="viewalbum.php?album_id=<?php echo $album['album_id']; ?>">View Album</a>

				<?php if ($_SESSION['username'] == $album['username']) { ?>
					<br><br>
					<a href="editalbum.php?album_id=<?php echo $album['album_id']; ?>" style="float: right;"> Edit </a>
					<br><br>
					<a href="deletealbum.php?album_id=<?php echo $album['album_id']; ?>" style="float: right;"> Delete</a>
				<?php } ?>
			</div>
		</div>
	<?php 
		}
	} 
	?>

</body>
</html>