<?php
    require_once 'load.php';

    if(isset($_GET['filter'])){
        $filter = $_GET['filter'];
        $getMovies = getMoviesByGenre($filter);
    } else {
        $getMovies = getAllMovies();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Movies CMS</title>
    
    <link rel="stylesheet" href="style.css">
</head>

<body>
<?php include 'templates/header.php'; ?>


<?php foreach ($getMovies as $movie):?>

    <div class="movie-item">
        <img src="images/<?php echo $movie['movies_cover'];?>" alt="<?php echo $movie['movies_title'];?> Cover Image">
        <h2><?php echo $movie['movies_title'];?></h2>
        <h4>Released: <?php echo $movie['movies_release']; ?></h4>
        <h4>Year: <?php echo $movie['movies_year']; ?></h4>
        <a href="details.php?id=<?php echo $movie['movies_id'];?>">More details..</a>
        <p>
            <?php echo $movie['movies_storyline']; ?>
        </p>
    </div>

<?php endforeach;?>
    

    <?php include 'templates/footer.php'; ?>
</body>
</html>