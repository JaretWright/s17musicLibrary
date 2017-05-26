<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Albums</title>

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">

    <!-- Optional theme -->
    <link rel="stylesheet" href="css/bootstrap-theme.min.css">


</head>
<body>
<main class="container">
    <h1>Albums</h1>
    <a href="albumDetails.php">Add a new album</a>
    <?php
        //Step 1 - connect to the DB
        $conn = new PDO('mysql:host=localhost;dbname=php','root','admin');

        //Step 2 - create a SQL command
        $sql = "SELECT * FROM albums";

        //Step 3 - prepare and execute the SQL command
        $cmd = $conn->prepare($sql);
        $cmd->execute();

        //Step 4 - store the results in a variable
        $albums = $cmd->fetchAll();

        //Step 5 - close the DB connection
        $conn=null;

        //Step 6 - display the results in a table
        echo '<table class="table table-striped table-hover"><tr>
                        <th>Title</th>
                        <th>Year</th>
                        <th>Artist</th>
                        <th>Genre</th>
                        <th>Edit</th>
                        <th>Delete</th></tr>';

        //loop over the $albums array to display each album as a new row
        foreach($albums as $album)
        {
            echo '<tr><td>'.$album['title'].'</td>
                      <td>'.$album['year'].'</td>
                      <td>'.$album['artist'].'</td>
                      <td>'.$album['genre'].'</td>
                      <td><a href="albumDetails.php?albumID='.$album['albumID'].'"class="btn btn-primary"</a>Edit</td>
                      <td><a href="deleteAlbum.php?albumID='.$album['albumID'].'" class="btn btn-danger confirmation">Delete</td></tr>';
        }

    ?>

</main>
</body>

<!-- Latest jQuery -->
<script src="js/jquery-3.2.1.min.js"></script>

<!-- Latest compiled and minified JavaScript -->
<script src="js/bootstrap.min.js"></script>

<script src="js/app.js"></script>
</html>
