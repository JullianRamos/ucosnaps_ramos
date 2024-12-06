<?php
require_once 'core/dbConfig.php';
require_once 'core/models.php';

// Check if `album_id` is provided
if (!isset($_GET['album_id'])) {
    die("Album ID is required!");
}

$album_id = $_GET['album_id'];

// Fetch album details
$album = getAlbumByID($pdo, $album_id);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $album_name = $_POST['album_name'];

    // Update the album name
    $updateStatus = updateAlbum($pdo, $album_id, $album_name);

    if ($updateStatus) {
        header("Location: index.php");
        exit();
    } else {
        echo "Error updating album!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Album</title>
    <style>
        /* General body styles */
        body {
            background-color: #121212;  /* Dark background */
            color: #ffffff;              /* Light text color */
            font-family: Arial, sans-serif; /* Font style */
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;              /* Full height */
            margin: 0;
        }

        /* Form styles */
        form {
            background-color: #1e1e1e;  /* Darker background for form */
            border: 1px solid #444;      /* Light gray border */
            padding: 20px;               /* Padding for better spacing */
            border-radius: 5px;          /* Rounded corners */
            text-align: center;           /* Centered text */
        }

        /* Input styles */
        input[type="text"] {
            background-color: #2a2a2a;  /* Darker input field */
            color: #ffffff;              /* Light text color */
            border: 1px solid #444;      /* Light gray border */
            padding: 10px;               /* Padding */
            border-radius: 5px;          /* Rounded corners */
            width: 100%;                 /* Full width */
            margin-top: 10px;            /* Spacing above input */
        }

        /* Button styles */
        button {
            background-color: #3a3a3a;  /* Dark button background */
            color: #ffffff;              /* Light text color */
            border: none;                /* Remove border */
            padding: 10px 20px;         /* Padding */
            border-radius: 5px;          /* Rounded corners */
            cursor: pointer;             /* Pointer cursor */
            margin-top: 10px;            /* Spacing above button */
        }

        /* Hover effects */
        button:hover {
            background-color: #444;      /* Slightly lighter on hover */
        }
    </style>
</head>
<body>
    <h1>Edit Album</h1>
    <form action="" method="POST">
        <label for="album_name">Album Name:</label>
        <input type="text" name="album_name" value="<?php echo htmlspecialchars($album['album_name']); ?>" required>
        <button type="submit">Update Album</button>
    </form>
</body>
</html>