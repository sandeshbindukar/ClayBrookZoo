<!-- For logging out -->
<?php
	session_start(); //starts the session
	session_unset(); //unset the session
	session_destroy(); //destroys the session
	header('Location:login.php'); //redirect to login page
?>