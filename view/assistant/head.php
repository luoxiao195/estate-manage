<?php
	session_start();	
	require_once('../../config/config.php');
	if(!isset($_SESSION['assistant'])){
		header("Location:".__PUBLIC__."/view/assistant/login.php");
	}
?>