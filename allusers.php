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
	<title>All Users</title>
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

		/* User list styles */
		.allUsers {
			background-color: #1e1e1e;  /* Dark background for user list */
			border: 1px solid #444;      /* Light gray border */
			width: 25%;
			text-align: center;
			padding: 15px;               /* Padding for better spacing */
			border-radius: 5px;          /* Rounded corners */
		}

		/* List styles */
		ul {
			display: flex;
			flex-direction: column;
			align-items: center;
			list-style-type: disc;
			padding: 0;
		}

		li {
			margin-top: 10px;
		}

		a {
			color: #ffffff;              /* Light text for links */
			text-decoration: none;       /* Remove underline */
		}

		a:hover {
			text-decoration: underline;  /* Underline on hover for better visibility */
		}
	</style>
</head>
<body>
	<?php include 'navbar.php'; ?>
	<div class="container">
		<div class="allUsers">
			<h1>All Users</h1>
			<ul>
				<?php $getAllUsers = getAllUsers($pdo); ?>
				<?php foreach ($getAllUsers as $row) { ?>
					<li><a href="profile.php?username=<?php echo $row['username']; ?>"><?php echo $row['username']; ?></a></li>
				<?php } ?>
			</ul>
		</div>
	</div>
</body>
</html>