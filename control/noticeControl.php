<?php
require_once('../model/noticeModel.php');
require_once('../config/config.php');
session_start();
if(isset($_GET['method'])){
	$method = $_GET['method'];
	$noticeModel = new noticeModel();
	if($method == 'getAll'){
		$villageId = $_SESSION['estateManager']['villageId'];
		$noticeList = $noticeModel->getAll($villageId);
		$_SESSION['noticeList'] = $noticeList;
		header("Location:".__PUBLIC__."/view/notice/index.php");
	}else if($method='add'){
		$villageId = $_SESSION['estateManager']['villageId'];
		$title = $_POST['title'];
		$content = $_POST['mycontent'];
		
		$noticeModel->add($villageId,$title,$content);
		header('Location:'.__PUBLIC__.'/control/noticeControl.php?method=getAll');
	}
}

?>