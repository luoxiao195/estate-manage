<?php
require_once('../model/uploadModel.php');

    $uploadModel = new uploadModel();

    
    $name = $_FILES['fileData']['name'];
    $filePath = $_FILES['fileData']['tmp_name'];
    $type = $_FILES['fileData']['type'];
    $url = $uploadModel->postDoupload($name,$filePath,$type);
  
    echo json_encode(array('success'=>true,'file_path'=>$url));
?>