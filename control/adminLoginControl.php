<?php
	require_once('../model/adminUserModel.php');				/* 超级后台登录*/
	require_once('../config/config.php');
	session_start();
	$_SESSION['adminUser']=null;
	if(!isset($_POST["adminName"])||!isset($_POST["adminPassword"])){
		header("Location:".__PUBLIC__."/view/admin/login.php");
	}
	$username = $_POST["adminName"];
	$password = $_POST["adminPassword"];
	$adminUserModel = new adminUserModel();
	$adminUser = $adminUserModel->login($username,$password);
	
	if(!empty($adminUser)){
		$_SESSION['adminUser'] = $adminUser;
		header("Location:".__PUBLIC__."/view/admin/index.php");
	}
	else
	{
		$_SESSION['adminCookie']='301';
		header("Location:".__PUBLIC__."/view/admin/login.php");
	}
	
?>