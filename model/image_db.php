<?php

function get_images() {
    global $db;
    $query = 'SELECT * FROM images';
    try {
        $statement = $db->prepare($query);
        $statement->execute();
        $results = $statement->fetchAll();
        $statement->closeCursor();
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        display_db_error($error_message);
    }
}

function add_images($name, $path) {
    global $db;
    $query = 'INSERT INTO images
              (imageName, imagePath)
            VALUES
            (:name, :path)';
    try {
        $statement = $db->prepare($query);
        $statement->bindValue(':name', $name);
        $statement->bindValue(':path', $path);
        $statement->execute();
        $statement->closeCursor();
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        display_db_error($error_message);
    }
}

function delete_image(){
    global $db;
    $query = 'DELETE FROM galleries WHERE imageID = :gallery_id';
}
