<?php
    require_once 'load.php';

    if(isset($_GET['filter'])){
        $filter = $_GET['filter'];
        $getMovies = getMoviesByGenre($filter);
        
    } else {
        $getMovies = getAllMovies();
    }

    // get data ready to send to AJAX call
    echo json_encode($getMovies);

