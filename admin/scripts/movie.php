<?php
function addMovie($movie)
{
    ## Debugging Only!! Remove After
    ##return 'You are about to create a new movie'.PHP_EOL.var_export($movie,true);

    ## TO DO
    try{
        # 1. Connect to Database
        $pdo = Database::getInstance()->getConnection();

        # 2. Validate uploaded file
        $cover = $movie['cover'];
        $upload_file = pathinfo($cover['name']);
        $accepted_types = array('gif', 'jpg', 'jpeg', 'jpe', 'png', 'svg');

        if(!in_array($upload_file['extension'],$accepted_types)){
            throw new Exception('Wrong file type.');
        }

        # 3. Movie uploaded file around(move file from tmp path to /images)
        $image_path = '../images/';
        $generated_name = md5($upload_file['filename'].time());

        $generated_filename = $generated_name.'.'.$upload_file['extension'];
        $target_path = $image_path.$generated_filename;

        if(!move_uploaded_file($cover['tmp_name'],$target_path)){
            throw new Exception('Failed to move uploaded file, check permission.');
        }

        # Generate a thumbnail from the original image
        $th_copy = $image_path.'TH_'.$cover['name'];
        if(!copy($target_path,$th_copy)){
            throw new Exception('Whooops, thumbnail copy did not work!');
        }

        # 4. Insert into database (tbl_movies)
        $insert_movie_query = 'INSERT INTO tbl_movies(movies_cover, movies_title, movies_year, movies_runtime, movies_storyline, movies_trailer, movies_release)';
        $insert_movie_query .= ' VALUES(:cover, :title, :year, :run, :story, :trailer, :release)';
        $insert_movie = $pdo->prepare($insert_movie_query);
        $insert_movie_result = $insert_movie->execute(
            array(
                ':cover'=>$generated_filename,
                ':title'=>$movie['title'],
                ':year'=>$movie['year'],
                ':run'=>$movie['run'],
                ':story'=>$movie['story'],
                ':trailer'=>$movie['trailer'],
                ':release'=>$movie['release'],
            )
        );

        ## Only insert into linking table if initial movie insert is successful
        ## Return that last ID that was updated
        $last_updated_id - $pdo->lastInsertId();

        if(!empty($last_updated_id) && $insert_movie_result){
            $update_genre_query = 'INSERT INTO tbl_mov_genre(movies_id, genre_id) VALUES (:movies_id, :genre_id)';
            $update_genre = $pdo->prepare($update_genre_query);
            $update_genre->execute(
                array(
                    ':movies_id'=>$last_updated_id,
                    ':genre_id'=>$movie['genre']
                )
            );
        }

        # 5. If this all works, redirect to index.php

        redirect_to('index.php');

    } catch(Exception $e){

        # Return error message
        $error = $e->getMessage();
        return $error;
    }
    
}

function getAllMovieGenres(){
    $pdo = Database::getInstance()->getConnection();

    $get_all_genre_query = 'SELECT * FROM tbl_genre';
    $genres = $pdo->query($get_all_genre_query);

    // If users returned in query, return in browser.
    // Otherwise, return false
    if($genres){
        return $genres;
    } else {
        return false;
    }
}