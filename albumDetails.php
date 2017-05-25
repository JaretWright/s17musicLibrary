<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Album Details</title>

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
</head>
<body>
<main class="container">
<h1>Album Details</h1>

    <?php
        //check the URL for an albumID to determine if this is a new or edit album
        if (!empty($_GET['albumID']))
            $albumID = $_GET['albumID'];
        else
            $albumID = null;
        $title = null;
        $year = null;
        $artist = null;
        $genrePicked = null;

        //to decide if the album is an edit, we look at the albumID
        if (!empty($albumID))
        {
            //Step 1 connect to the DB
            $conn = new PDO('mysql:host=localhost;dbname=php','root','admin');

            //Step 2 create the SQL query
            $sql = "SELECT * FROM albums WHERE albumID = :albumID";

            //Step 3 prepare and execute the SQL
            $cmd = $conn->prepare($sql);
            $cmd->bindParam(':albumID', $albumID, PDO::PARAM_INT);

            //Step 4 update the variables
            $cmd->execute();
            $album = $cmd->fetch();
            $title = $album['title'];
            $year = $album['year'];
            $artist = $album['artist'];
            $genrePicked =$album['genre'];

            //Step 5 close the DB connection
            $conn=null;
        }
    ?>


<form method="post" action="saveAlbum.php">
    <fieldset class="form-group">
        <label for="title" class="col-sm-1">Title: *</label>
        <input name="title" id="title" required placeholder="Album Title"
                value="<?php echo $title?>"/>
    </fieldset>
    <fieldset class="form-group">
        <label for="year" class="col-sm-1">Year: </label>
        <input name="year" id="year" type="number" min="1900" placeholder="Year released"
           value="<?php echo $year ?>"/>
    </fieldset>
    <fieldset class="form-group">
        <label for="artist" class="col-sm-1">Artist: *</label>
        <input name="artist" id="artist" required placeholder="Artist name"
            value="<?php echo $artist?>"/>
    </fieldset>
    <fieldset class="form-group">
        <label for="genre" class="col-sm-1">Genre: *</label>
        <select name="genre" id="genre">
            <?php
                //Step 1 - connect to the DB
                $conn = new PDO('mysql:host=localhost;dbname=php','root','admin');

                //Step 2 - create a SQL script
                $sql = "SELECT * FROM genres";

                //Step 3 - prepare and execute the SQL script
                $cmd = $conn->prepare($sql);
                $cmd->execute();
                $genres = $cmd->fetchAll();

                //Step 4 - display the results
                foreach($genres as $genre)
                {
                    if ($genrePicked == $genre['genre']){
                        echo '<option selected>'.$genre['genre'].'</option>';
                    }
                    else {
                        echo '<option>'.$genre['genre'].'</option>';
                    }

                }

                //Step 5 - disconnect from the DB
                $conn=null;
            ?>
        </select>
    </fieldset>
    <input name="albumID" id="albumID" value="<?php echo $albumID?>" type="hidden"/>
    <button class="btn btn-success col-sm-offset-1">Save</button>
</form>
</main>
</body>

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</html>
