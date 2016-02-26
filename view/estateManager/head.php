<?php
@session_start();
	require_once('../../config/config.php');
	
	if(!isset($_SESSION['estateManager'])){
		header("Location:".__PUBLIC__."/view/estateManager/login.php");
	}
?>