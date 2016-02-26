<?php
require_once('../config/config.php');
require_once('../model/uploadFileModel.php');
$uploadFileModel = new uploadFileModel();
if ($_FILES["file"]["error"] > 0)
{
	echo "Error: " . $_FILES["file"]["error"] . "<br />";
}
else
{
	$fileName = $_FILES['file']['name'];
	$type = $_FILES["file"]["type"];
 	$filePath = $_FILES['file']['tmp_name'];
 	$content = file_get_contents($filePath);
 	session_start();
 	$estateManager = $_SESSION['estateManager'];
 	$villageId = $estateManager['villageId'];
  	$uploadFileModel->upload($fileName,$type,$content,$villageId);
  	header("Location:".__PUBLIC__."/view/estateManager/upload.php");
}
?>