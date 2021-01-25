<?php
    require_once './config/database.php';
    require_once './admin/scripts/read.php';

    // Using GET to get ID to pass into getSingleMovie()
    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $movie = getSingleMovie($id);
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Details</title>
    
    <link rel="stylesheet" href="style.css">
</head>
<body>

<?php include 'templates/header.php'; ?>


<?php if(!empty($movie)):?>

    <div class="movie-item">
        <img src="images/<?php echo $movie['movies_cover'];?>" alt="<?php echo $movie['movies_title'];?> Cover Image">
        <h2><?php echo $movie['movies_title'];?></h2>
        <h4>Released: <?php echo $movie['movies_release']; ?></h4>
        <h4>Year: <?php echo $movie['movies_year']; ?></h4>
        <a href="details.php?=<?php echo $movie['movies_id'];?>">More details..</a>
        <p>
            <?php echo $movie['movies_storyline']; ?>
        </p>
    </div>

<?php else:?>
<p>There isn't such a movie</p>

<?php endif;?>
    

    <footer>
        <p>Copyright &#xA9; <?php echo date('Y');?> </p>
    </footer>
</body>
</html>