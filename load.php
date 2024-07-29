<?php
    require 'db.php';

    $data = array();

    $query = "SELECT * FROM bookings ORDER BY id";
    $statement = $pdo->prepare($query);
    $statement->execute();

    $result = $statement->fetchAll(PDO::FETCH_ASSOC);

    foreach($result as $row) {
        $data[] = array(
            'id'   => $row["id"],
            'title'   => $row["title"],
            'start'   => $row["start_date"],
            'end'   => $row["end_date"]
        );
    }

    echo json_encode($data);
?>
