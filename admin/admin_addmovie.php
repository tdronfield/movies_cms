<?php
require_once '../load.php';
confirm_logged_in();

if(isset($_POST['submit'])){

    ## DEBUGGING ONLY
    ## Whats in the $_FILES?
    ##var_dump($_FILES);
    ##exit;
    ## DEBUGGING ABOVE

    $data = array(
        'cover' => $_FILES['cover'],
        'title' => $_POST['title'],
        'year' => $_POST['year'],
        'run' => $_POST['run'],
        'trailer' => $_POST['trailer'],
        'release' => $_POST['release'],
        'genre' => $_POST['genre'],
        'story' => $_POST['story'],
    );

    $message = addMovie($data);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Movie</title>
</head>
<body>
    <h2>Add Movie</h2>

    <?php echo !empty($message)?$message:'';?>

    <!-- In order for form to accept file uploads, must add new attribute  -->
    <form action="admin_addmovie.php" method="POST" enctype="multipart/form-data">
        <label for="cover">Cover Image:</label>
        <input id="cover" type="file" name="cover" value="">

        <br><br>

        <label for="title">Movie Title:</label>
        <input id="title" type="text" name="title" value="">

        <br><br>

        <label for="year">Movie Year:</label>
        <input id="year" type="text" name="year" value="">

        <br><br>

        <label for="run">Movie Runtime:</label>
        <input id="run" type="text" name="run" value="">

        <br><br>

        <label for="trailer">Movie Trailer:</label>
        <input id="trailer" type="text" name="trailer" value="">

        <br><br>

        <label for="release">Movie Release:</label>
        <input id="release" type="text" name="release" value="">

        <br><br>

        <?php $genList = getAllMovieGenres();
            if(!empty($genList)):?>
        <label for="genList">Select Genre:</label>
        <select name="genre" id="genList">
            <?php while($genre = $genList->fetch(PDO::FETCH_ASSOC)):?>
                <option value="<?php echo $genre['genre_id'];?>"><?php echo $genre['genre_name'];?></option>
            <?php endwhile;?>
        </select>
        <?php endif;?>

        <br><br>

        <label for="story">Movie Storyline:</label>
        <textarea id="story" type="text" name="story" value=""></textarea>
        
        <br><br>

        <button type="submit" name="submit">Add Movie</button>
    </form>
</body>
</html>