<?php
	include_once 'auth.php';
	
	//Unset the variables stored in session
	unset($_SESSION['SESS_USER_ID']);
	unset($_SESSION['SESS_USERNAME']);
	unset($_SESSION['SESS_IS_ADMIN']);
	unset($_SESSION['CART']);


	$_SESSION['MSGS'] = array("You have been logged out. ");
	session_write_close();
	//redirect to main page after the logging out is done
	header("location: index.php");
?>
