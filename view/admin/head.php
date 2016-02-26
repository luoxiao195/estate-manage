<?php
	session_start();	
	require_once('../../config/config.php');
	if(!isset($_SESSION['adminUser'])){
		header("Location:".__PUBLIC__."/view/admin/login.php");
	}
?>