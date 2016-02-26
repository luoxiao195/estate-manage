<?php
require_once('../leancloud/AV.php');
require_once('../utils/function.php');
require_once('uploadFileModel.php');
$f=new uploadFileModel();
echo $f->deleteFile('55dd9b3500b01143acd057fa');

