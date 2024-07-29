<?php
    require 'db.php';

    if(isset($_POST["title"])) {
        $query = "
        INSERT INTO bookings (title, start_date, end_date) 
        VALUES (:title, :start, :end)
        ";
        $statement = $pdo->prepare($query);
        $statement->execute(
            array(
                ':title'  => $_POST['title'],
                ':start' => $_POST['start'],
                ':end' => $_POST['end']
            )
        );
    }
?>
