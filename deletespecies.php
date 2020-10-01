<?php
	include('db/db_connect.php');
  if($_SESSION['sessUserType'] != "admin"){
  header('Location:login.php'); //if the user is not admin go to login page
  }
   $stmt = $pdo->prepare('DELETE FROM tb_animal_details WHERE species_id = :species_id');
   $stmt->execute(['species_id' => $_GET['species_id']]);
   header('Location:adminindex.php?showResult= Species Deleted');
  
?>