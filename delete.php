<?php
    require 'db.php';

    if(isset($_POST["id"])) {
        $query = "
        DELETE from bookings WHERE id = :id
        ";
        $statement = $pdo->prepare($query);
        $statement->execute(
            array(
                ':id' => $_POST['id']
            )
        );
    }
?>
