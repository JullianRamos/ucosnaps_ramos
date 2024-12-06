<?php
require_once 'core/dbConfig.php';
require_once 'core/models.php';

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

// Check if album_id is passed in the URL
if (!isset($_GET['album_id'])) {
    echo "Album not specified.";
    exit;
}

// Fetch the album and its photos
$album_id = $_GET['album_id'];
$album = getAlbumByID($pdo, $album_id);

if (!$album) {
    echo "Album not found.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($album['album_name']); ?></title>
    <style>
        /* General body styles */
        body {
            background-color: #121212;  /* Dark background */
            color: #ffffff;              /* Light text color */
            font-family: Arial, sans-serif; /* Font style */
            margin: 0;
            padding: 0;
        }

        /* Navbar styles */
        .navbar {
            background-color: #1e1e1e;  /* Darker navbar */
            padding: 10px;
            text-align: center;
        }

        /* Album container styles */
        .albumContainer {
            text-align: center;
            margin-top: 20px;
            padding: 20px;
            background-color: #1e1e1e;  /* Dark background for album */
            border: 1px solid #444;      /* Light gray border */
            border-radius: 5px;          /* Rounded corners */
        }

        /* Photos container styles */
        .albumPhotos {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            justify-content: center;
        }

        /* Individual photo styles */
        .photo {
            width: 200px;
            background-color: #2a2a2a;  /* Darker background for photo */
            border-radius: 5px;          /* Rounded corners */
            padding: 10px;               /* Padding around photos */
        }

        /* Link styles */
        a {
            color: #1e90ff;              /* Bright blue for links */
            text-decoration: none;        /* Remove underline */
        }

        a:hover {
            text-decoration: underline;   /* Underline on hover */
        }
    </style>
</head>
<body>
    <?php include 'navbar.php'; ?>

    <div class="albumContainer">
        <h2><?php echo htmlspecialchars($album['album_name']); ?></h2>
        <p>Created by: <a href="profile.php?username=<?php echo htmlspecialchars($album['username']); ?>">
            <?php echo htmlspecialchars($album['username']); ?></a></p>
        <p><i><?php echo $album['date_created']; ?></i></p>

        <div class="albumPhotos">
            <?php foreach ($album['photos'] as $photo) { ?>
                <div class="photo">
                    <img src="images/<?php echo htmlspecialchars($photo['photo_name']); ?>" alt="" style="width: 100%; border-radius: 5px;">
                    <p><?php echo htmlspecialchars($photo['description']); ?></p>
                </div>
            <?php } ?>
        </div>
    </div>

    <?php if ($_SESSION['username'] == $album['username']) { ?>
        <div style="margin-top: 20px; text-align: center;">
            <a href="editalbum.php?album_id=<?php echo $album['album_id']; ?>">Edit Album</a> |
            <a href="deletealbum.php?album_id=<?php echo $album['album_id']; ?>">Delete Album</a>
        </div>
    <?php } ?>
</body>
</html>