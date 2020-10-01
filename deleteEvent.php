<?php 
include('db/db_connect.php');
$stmt = $pdo->prepare('DELETE FROM tb_events WHERE event_id = :event_id');
    $stmt->execute(['event_id' => $_GET['event_id']]);
    header('Location:adminevents.php?showResult= Event Deleted');

?>