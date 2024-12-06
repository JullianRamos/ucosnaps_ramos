<?php
require_once 'core/dbConfig.php';
require_once 'core/models.php';

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}


if (!isset($_GET['album_id'])) {
    echo "Album not specified.";
    exit;
}


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
      
        body {
            background-color: #121212;  
            color: #ffffff;              
            font-family: Arial, sans-serif; 
            margin: 0;
            padding: 0;
        }

      
        .navbar {
            background-color: #1e1e1e; 
            padding: 10px;
            text-align: center;
        }

        
        .albumContainer {
            text-align: center;
            margin-top: 20px;
            padding: 20px;
            background-color: #1e1e1e;  
            border: 1px solid #444;     
            border-radius: 5px;         
        }


        .albumPhotos {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            justify-content: center;
        }

    
        .photo {
            width: 200px;
            background-color: #2a2a2a; 
            border-radius: 5px;         
            padding: 10px;               
        }


        a {
            color: #1e90ff;             
            text-decoration: none;       
        }

        a:hover {
            text-decoration: underline;  
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
