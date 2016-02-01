<?php
	session_start();
	unset($_SESSION['LoginStatus']);
	header("Location: index.php");
?>