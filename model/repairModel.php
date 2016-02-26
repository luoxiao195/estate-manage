<?php
require_once('../leancloud/AV.php');
require_once('../utils/function.php');
Class repairModel{
	public function getWaitRepair($villageId){
		$query = new leancloud\AVQuery('Repair');
		$query->where('villageId',getPointer('Village',$villageId));
		$query->where('ifConfirm',false);
		$waitRepair = $query->find();
		$waitRepair = toArray($waitRepair,array('villageId','userId'));
		return $waitRepair;
	}
	public function getHaveRepair($villageId){
		$query = new leancloud\AVQuery('Repair');
		$query->where('villageId',getPointer('Village',$villageId));
		$query->where('ifConfirm',true);
		$haveRepair = $query->find();
		$haveRepair = toArray($haveRepair,array('villageId','userId'));
		return $haveRepair;
	}
	public function pass($objectId){
		$update = new leancloud\AVObject("Repair");
		$update->ifConfirm = true;
		$update->update($objectId);
		return true;
	}
}
?>