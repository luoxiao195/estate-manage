<?php
require_once('../leancloud/AV.php');
require_once('../utils/function.php');
	Class villageModel{
		public function getAll(){
			$query = new leancloud\AVQuery('Village');
			$query->setLimit(300);
			$villageList = $query->find();
			$villageList = toArray($villageList);
			return $villageList;
		}
		public function add($villageName,$address,$province,$city){
			$obj = new leancloud\AVObject('Village');
   		 	$obj->name = $villageName;
   		 	$obj->city = $city;
   		 	$obj->villageName=$villageName;
   		 	$obj->province = $province;
   			$obj->address = $address;
    		$obj->save();

		}
		public function getByVillageId($villageId){
			$query = new leancloud\AVQuery('Village');
			$query->where('objectId',$villageId);
			$query->setLimit(300);
			$villageInfo = $query->find();
			$villageInfo = toArray($villageInfo);
			return $villageInfo[0];
		}
		public function update($villageName,$address,$villageId,$province,$city){
			$query = new leancloud\AVQuery('Village');
			$query->where('name',$villageName);
			$villageInfoList = $query->find();
			$villageInfoList = toArray($villageInfoList);
			foreach ($villageInfoList as $key => $value) {
				if($value['province']==$province&&$value['city']==$city&&$value['address'] == $address){
					return false;
				}
			}
			$obj = new leancloud\AVObject('Village');
			$obj->villageName = $villageName;
			$obj->name=$villageName;
			$obj->address = $address;
			$obj->province = $province;
			$obj->city = $city;
			$obj->update($villageId);
			return true;
		}
		public function updateWater($fee,$villageId){
			$obj = new leancloud\AVObject('Village');
			$obj->waterPrice = $fee;
			$obj->update($villageId);
			return true;

		}
		public function updatePower($fee,$villageId){
			$obj = new leancloud\AVObject('Village');
			$obj->powerPrice = $fee;
			$obj->update($villageId);
			return true;
		}
		public function addHouse($buildingArr,$floorArr,$unitArr,$villageId){
			$obj = new leancloud\AVObject('House');
			foreach ($buildingArr as $building) {
				if($building!=""){
					foreach ($floorArr as $floor) {
						if($floor!=""){
							foreach ($unitArr as $unit) {
								if($unit!=""){
									$obj->building = $building;
									$obj->floor = $floor;
									$obj->unit = $unit;
									$obj->villageId = getPointer("Village",$villageId);
									$obj->save();
								}
							
							}
						}
					
					}
				}
				
			}
		}
		public function getBuilding($building,$floor,$unit,$villageId){
			$query = new leancloud\AVQuery("House");
			if($building!=""){
				$query->where('building',$building);
			}
			if($floor!=""){
				$query->where('floor',$floor);
			}
			if ($unit!="") {
				$query->where('unit',$unit);
			}
			$query->setLimit(300);
			$query->where('villageId',getPointer("Village",$villageId));
			return toArray($query->find(),array("villageId"));
		}
		public function deleteHouse($id){
			$obj = new leancloud\AVObject("House");
			$obj->delete($id);
		}
		public function updateHouse($id,$building,$floor,$unit){
			$update = new leancloud\AVObject("House");
			$update->building = $building;
			$update->floor = $floor;
			$update->unit = $unit;
			$update->update($id);

		}
		public function addParking($buildingArr,$floorArr,$unitArr,$villageId){
			$obj = new leancloud\AVObject('Parking');
			foreach ($buildingArr as $building) {
				if($building!=""){
					foreach ($floorArr as $floor) {
						if($floor!=""){
							foreach ($unitArr as $unit) {
								if($unit!=""){
									$obj->building = $building;
									$obj->floor = $floor;
									$obj->unit = $unit;
									$obj->villageId = getPointer("Village",$villageId);
									$obj->save();
								}
							
							}
						}
					
					}
				}
				
			}
		}
		public function getParking($building,$floor,$unit,$villageId){
			$query = new leancloud\AVQuery("Parking");
			if($building!=""){
				$query->where('building',$building);
			}
			if($floor!=""){
				$query->where('floor',$floor);
			}
			if ($unit!="") {
				$query->where('unit',$unit);
			}
			$query->setLimit(300);
			$query->where('villageId',getPointer("Village",$villageId));
			return toArray($query->find(),array("villageId"));
		}
		public function deleteParking($id){
			$obj = new leancloud\AVObject("Parking");
			$obj->delete($id);
		}
		public function updateParking($id,$building,$floor,$unit){
			$update = new leancloud\AVObject("Parking");
			$update->building = $building;
			$update->floor = $floor;
			$update->unit = $unit;
			$update->update($id);

		}
		public function getUpdateVillageInfo($villageId)
		{
			$query=new leancloud\AVQuery('Village');
			$query->where('objectId',$villageId);
			$result=toArray($query->find(),array());
			if(empty($result))
			{
				$return['code']='402';
			}
			else
				$return['code']='201';
			$return['villageInfo']=$result[0];
			return $return;
		}
	}

?>