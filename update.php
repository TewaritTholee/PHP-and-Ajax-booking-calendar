<?php
    require 'db.php';

    if(isset($_POST["id"])) {
        $query = "
        UPDATE bookings 
        SET start_date = :start, end_date = :end 
        WHERE id = :id
        ";
        $statement = $pdo->prepare($query);
        $statement->execute(
            array(
                ':start' => $_POST['start'],
                ':end' => $_POST['end'],
                ':id'   => $_POST['id']
            )
        );
    }
?>
