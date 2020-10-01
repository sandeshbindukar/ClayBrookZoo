<?php
	session_start();
 	$pdo = new PDO('mysql:dbname=zoo;host=localhost', 'root', '', [PDO::ATTR_ERRMODE =>  PDO::ERRMODE_EXCEPTION ]);
?>
