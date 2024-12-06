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
  
        body {
            background-color: #121212;  
            color: #ffffff;             
            font-family: Arial, sans-serif; 
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;            
            margin: 0;
        }

  
        form {
            background-color: #1e1e1e;  
            border: 1px solid #444;    
            padding: 20px;              
            border-radius: 5px;       
            text-align: center;     
        }


        input[type="text"] {
            background-color: #2a2a2a;  
            color: #ffffff;   
            border: 1px solid #444; 
            padding: 10px;        
            border-radius: 5px;    
            width: 100%;             
            margin-top: 10px;          
        }

 
        button {
            background-color: #3a3a3a; 
            color: #ffffff;            
            border: none;     
            padding: 10px 20px;     
            border-radius: 5px;       
            cursor: pointer;         
            margin-top: 10px;           
        }

   
        button:hover {
            background-color: #444;      
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
