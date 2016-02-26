<?php
require_once('../leancloud/AV.php');
require_once('../utils/function.php');
Class uploadFileModel{
	public function upload($fileName,$type,$content,$villageId){
		$file = new leancloud\AVFile($type,$content);
		$result = (array)$file->save($fileName);
		$obj = new leancloud\AVObject("FileToVillage");
		$obj->villageId = getPointer("Village",$villageId);
		$obj->fileId = getPointer("_File",$result['objectId']);
		$obj->save();
	}
	public function getFiles($villageId){
		$query = new leancloud\AVQuery("FileToVillage");
		$query->where("villageId",getPointer("Village",$villageId));
		$fileIds = toArray($query->find(),array("villageId","fileId"));
		$fileList = array();
		foreach ($fileIds as $key => $value) {
			$query = new leancloud\AVQuery("_File");
			$query->where("objectId",$value['fileId']);
			$file = toArray($query->find());
			$fileList = array_merge($fileList,$file);
		}
		return $fileList;
	}
	public function deleteFile($fileId)
	{
		$query=new leancloud\AVQuery('FileToVillage');
		$query->where('fileId',getPointer('_File',$fileId));
		$result=toArray($query->find(),array('fileId','villageId'));
		if(empty($result))
			return false;
		$rela=new leancloud\AVObject('FileToVillage');
		$resultOfRela=$rela->delete($result[0]['objectId']);
		if(!$resultOfRela)
			return false;
		$file=new leancloud\AVObject('_File');
		$resultFile=$file->delete($fileId);
		if(!$resultFile)
			return false;
		return true;
	}
}
?>