<?php
require_once 'core/dbConfig.php';
require_once 'core/models.php';

// Check if `album_id` is provided
if (!isset($_GET['album_id'])) {
    die("Album ID is required!");
}

$album_id = $_GET['album_id'];

// Only process deletion if `confirmDelete` is set
if (isset($_POST['confirmDelete'])) {
    $deleteStatus = deleteAlbum($pdo, $album_id);

    if ($deleteStatus) {
        header("Location: index.php");
        exit();
    } else {
        echo "Error deleting album!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Album</title>
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

        /* Button styles */
        button {
            background-color: #3a3a3a;  /* Dark button background */
            color: #ffffff;              /* Light text color */
            border: none;                /* Remove border */
            padding: 10px 20px;         /* Padding */
            border-radius: 5px;          /* Rounded corners */
            cursor: pointer;             /* Pointer cursor */
            margin: 5px;                /* Margin for spacing */
        }

        /* Hover effects */
        button:hover {
            background-color: #444;      /* Slightly lighter on hover */
        }
    </style>
</head>
<body>
    <h1>Are you sure you want to delete this album?</h1>
    <p>This action cannot be undone.</p>
    <form method="POST">
        <button type="submit" name="confirmDelete">Yes, Delete</button>
        <button type="button" onclick="window.location.href='index.php';">Cancel</button>
    </form>
</body>
</html>