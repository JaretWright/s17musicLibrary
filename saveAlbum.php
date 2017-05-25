<?php ob_start();?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Saving Album</title>
</head>
<body>
<?php
    $albumID = $_POST['albumID'];
    $title = $_POST['title'];
    $year = $_POST['year'];
    $artist = $_POST['artist'];
    $genre = $_POST['genre'];

    //Step 1 - connect to the DB
    $conn = new PDO('mysql:host=localhost;dbname=php','root','admin');
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    //Step 2 - create a SQL command
    if (!empty($albumID))
    {
        $sql = "UPDATE albums
                SET title = :title, year = :year, artist = :artist, genre = :genre
                WHERE albumID = :albumID";

    }
    else {
        $sql = "INSERT INTO albums (title, year, artist, genre) 
            VALUES (:title, :year, :artist, :genre)";
    }

    //Step 3 - prep the command and bind the parameters to avoid SQL injection
    $cmd = $conn->prepare($sql);
    $cmd->bindParam(':title', $title, PDO::PARAM_STR, 50);
    $cmd->bindParam(':year', $year, PDO::PARAM_INT, 4);
    $cmd->bindParam(':artist', $artist, PDO::PARAM_STR, 50);
    $cmd->bindParam(':genre', $genre, PDO::PARAM_STR, 20);
    if (!empty($albumID))
    {
        $cmd->bindParam(':albumID',$albumID, PDO::PARAM_INT);
    }

    //Step 4 - execute the command
    $cmd->execute();

    //Step 5 - disconnect from the DB
    $conn = null;

    //Step 6 - redirect to another page
    header('location:albums.php');
?>
</body>
</html>
<?php ob_flush(); ?>
