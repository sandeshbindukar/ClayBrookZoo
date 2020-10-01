<?php 
include('db/db_connect.php');
$stmt = $pdo->prepare('DELETE FROM tb_sponsor_details WHERE sponsor_id = :sponsor_id');
    $stmt->execute(['sponsor_id' => $_GET['sponsor_id']]);
    header('Location:manageSponsor.php?showResult= Sponsor Deleted');

?>