<?php
require_once('../leancloud/AV.php');
require_once('../utils/function.php');

class manageModel
{
	function showUserList($objectId,$skip)				//获取房屋用户信息列表
	{  	
		$villageId=$objectId;
		$query=new leancloud\AVQuery('House');
		$query->where('villageId',getPointer('Village',$objectId));
		$query->setSkip((int)$skip);
		$query->setLimit(150);
		$query->orderBy("building");
		$query->orderBy("floor");
		$query->orderBy("unit");
		$result=toArray($query->find(),array('villageId','user'));
		return $result;
	}
	function showUserDetail($objectId)				//返回房屋用户详细信息
	{
		$houseId=$objectId;
		
		$queryUser=new leancloud\AVQuery('_User');
		$queryHouse = new leancloud\AVQuery("House");
		$queryHouse->where('objectId',$houseId);
		$houseInfo=toArray($queryHouse->find(),array('villageId','user'));
		$queryUser->where('objectId',$houseInfo[0]['user']);
		$userInfo = toArray($queryUser->find());
		
		if(empty($userInfo))
			return array('code'=>'700');
		
		$queryHouse=new leancloud\AVQuery('House');
		//$queryHouse->where('user',getPointer('_User',$userInfo[0]['objectId']));
		$queryHouse->where('objectId',$houseId);
		$houseInfo=toArray($queryHouse->find(),array('villageId','user'));
		
		$returnList=array('userInfo'=>$userInfo[0],'houseInfo'=>$houseInfo[0]);
		
		return $returnList;
	}
	function modifyUser($houseId)	//传回修改用户信息所需要的信息
	{
		$queryUser=new leancloud\AVQuery('_User');
		$queryHouse = new leancloud\AVQuery("House");
		$queryHouse->where('objectId',$houseId);
		$houseInfo=toArray($queryHouse->find(),array('villageId','user'));
		$queryUser->where('objectId',$houseInfo[0]['user']);
		$userInfo = toArray($queryUser->find());
		
		$queryHouse=new leancloud\AVQuery('House');
		$queryHouse->where('objectId',$houseId);
		$houseInfo=toArray($queryHouse->find(),array('villageId','user'));
		
		$returnList=array('userInfo'=>$userInfo[0],'houseInfo'=>$houseInfo[0]);
		
		return $returnList;
	}

	function updateUser($message)
	{
		$u=new leancloud\AVObject('_User');
		if(isset($message['name']))
			$u->name=$message['name'];
		if(isset($message['gender']))
			$u->gender=$message['gender'];
		if(isset($message['type']))
			$u->type=$message['type'];
		if(isset($message['isMarried']))
			$u->isMarried=$message['isMarried'];
		if(isset($message['mobilePhoneNumber']))
			$u->mobilePhoneNumber=$message['mobilePhoneNumber'];
		if(isset($message['email']))
			$u->email=$message['email'];
		if(isset($message['age']))
			$u->age=$message['age'];
		if(isset($message['occupation']))
			$u->occupation=$message['occupation'];
		$return=$u->update($message['userId']);
		if(isset($message['house']['building'])&&isset($message['house']['floor'])&&isset($message['house']['unit']))
		{
			$house=new leancloud\AVQuery('House');
			$house->where('building',$message['house']['building']);
			$house->where('floor',$message['house']['floor']);
			$house->where('unit',$message['house']['unit']);
			$isCover=toArray($house->find(),array('villageId','user'));
			if(!empty($isCover))
			{
				if($isCover[0]['objectId']!=$message['house']['houseId'])	
					return array('code'=>'301');
			}
			$updateHouse=new leancloud\AVObject('House');
			$updateHouse->building=$message['house']['building'];
			$updateHouse->floor=$message['house']['floor'];
			$updateHouse->unit=$message['house']['unit'];
			$updateHouse->update($message['house']['houseId']);
		}
		
		return $return;
	}
	function deleteUserInfo($objectId)
	{
		$houseId=$objectId;
		$update=new leancloud\AVObject('House');
		$update->user=null;
		$return=$update->update($objectId);
		return $return;
	}
	function addUser($username,$password,$name,$gender,$age,$mobilePhoneNumber,$type,$email,$isMarry,$occupation,$houseArr,$parkingArr,$villageId){
		if(empty($houseArr))
		{
			return '405';
		}
		foreach ($houseArr as $key => $value) {
			$query = new leancloud\AVQuery("House");
			$query->where("building",$value['building']);
			$query->where("floor",$value['floor']);
			$query->where("unit",$value['unit']);
			$query->where("villageId",getPointer('Village',$villageId));
			$house = toArray($query->find(),array("villageId","user"));
			if(empty($house))
			{
				return '308';
			}			
		}
		
		foreach ($parkingArr as $key => $value) {
			$query = new leancloud\AVQuery("Parking");
			$query->where("building",$value['building']);
			$query->where("floor",$value['floor']);
			$query->where("unit",$value['unit']);
			$query->where("villageId",getPointer('Village',$villageId));
			$parking = toArray($query->find(),array("villageId","user"));
			if(empty($parking))
			{
				return '309';
			}
		}


		$obj = new leancloud\AVObject("_User");
		$obj->username = $username;
		$obj->password = $password;
		$obj->name = $name;
		$obj->gender = $gender;
		$obj->age = $age;
		$obj->mobilePhoneNumber = $mobilePhoneNumber;
		$obj->type = $type;
		$obj->email = $email;
		$obj->isMarried = $isMarry;
		$obj->occupation = $occupation;
		$obj->isConfirm = true;
		try
		{
			$result = (array)$obj->save();
		}
		catch(Exception $e)
		{
			if($e=='AVOSCloud.com error: Username has already been taken')
				return '303';
			else if($e=='AVOSCloud.com error: 此电子邮箱已经被占用。')
				return '304';
			else if($e=='AVOSCloud.com error: Password is missing or empty')
				return '305';
			else if($e=='AVOSCloud.com error: The email address was invalid.')
				return '306';
			else if($e=="AVOSCloud.com error: The mobile phone number was invalid. It must be a string,numbers and '-' are the only valid characters.")
				return '307';
			else if($e=="AVOSCloud.com error: Mobile phone number has already been taken")
				return '312';
			else
				return $e;
		}

		
		foreach ($houseArr as $key => $value) {
			$query = new leancloud\AVQuery("House");
			$query->where("building",$value['building']);
			$query->where("floor",$value['floor']);
			$query->where("unit",$value['unit']);
			$query->where("villageId",getPointer('Village',$villageId));
			$house = toArray($query->find(),array("villageId","user"));
			$update = new leancloud\AVObject("House");
			$update->user = getPointer("_User",$result['objectId']);
			try
			{
				$update->update($house[0]['objectId']);
			}
			catch(Exception $e)
			{
				return '235';
			}
			
		}
		
		foreach ($parkingArr as $key => $value) {
			$query = new leancloud\AVQuery("Parking");
			$query->where("building",$value['building']);
			$query->where("floor",$value['floor']);
			$query->where("unit",$value['unit']);
			$query->where("villageId",getPointer('Village',$villageId));
			$parking = toArray($query->find(),array("villageId","user"));
			$update = new leancloud\AVObject("Parking");
			$update->user = getPointer("_User",$result['objectId']);
			try
			{
				$update->update($parking[0]['objectId']);
			}
			catch(Exception $e)
			{
				return '236';
			}
		}
		return '201';
	}
}