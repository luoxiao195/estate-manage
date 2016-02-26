<?php
require_once('../utils/function.php');
require_once('../leancloud/AV.php');
Class assistantModel{
	public function getAll(){
		$query = new leancloud\AVQuery("Assistant");
		$query->setLimit(300);			
		$assistantList = toArray($query->find(),array('villageId'));
		return $assistantList;
	}
	public function register($villageId,$username,$password){
		$query=new leancloud\AVQuery("Assistant");
		$query->where('username',$username);
		$result=toArray($query->find(),array('villageId'));
		if(!empty($result))
			return 0;

		$obj = new leancloud\AVObject("Assistant");
		$obj->username = $username;
		$obj->password = $password;
		$obj->villageId = getPointer('Village',$villageId);
		$obj->save();
		return true;
	}
	public function delete($id){
		$obj = new leancloud\AVObject("Assistant");
		$obj->delete($id);
	}
	public function login($username,$password){
		$query = new leancloud\AVQuery("Assistant");
		$query->where("username",$username);
		$query->where("password",$password);
		$assistant = toArray($query->find(),array("villageId"));
		return $assistant;
	}
	public function showUserList($villageId,$skip)				//返回已经录入的房屋用户列表
	{
		try
		{
			$house_Q=new leancloud\AVQuery('House');
			$house_Q->where('villageId',getPointer('Village',$villageId));
			$house_Q->whereNotEqualTo('user',getPointer('_User',null));			//查找所有存在的用户的房屋
			//$house_Q->setLimit(100);
			$house_Q->setSkip((int)$skip);
			$house_r=toArray($house_Q->find(),array('villageId','user'));
			$returnList=array();				//逻辑由房子入手，寻找用户
			if(!empty($house_r))
			{
				foreach($house_r as $key =>$value)
				{
					if(!empty($value['user']))
					{
						$user_Q=new leancloud\AVQuery('_User');
						$user_Q->where('objectId',$value['user']);
						$userInfo=toArray($user_Q->find(),array());
						$houseList[$key]=array('userInfo'=>$userInfo[0],'houseInfo'=>$value);
					}
				}
				$returnList['house']=$houseList;
			}
			else
				return null;
			return $returnList;
		}
		catch(Exception $e)
		{
			return $e;
		}
		
	}
	public function showParkingList($villageId,$skip)
	{
		$parking_Q=new leancloud\AVQuery('Parking');
		$parking_Q->where('villageId',getPointer('Village',$villageId));
		$parking_Q->whereNotEqualTo('user',getPointer('_User',null));
		$parking_Q->setSkip((int)$skip);
		$parking_r=toArray($parking_Q->find(),array('villageId','user'));
		if(!empty($parking_r))
		{
			foreach ($parking_r as $key => $value) 
			{
				if(!empty($value['user']))
				{
					$user_Q=new leancloud\AVQuery('_User');
					$user_Q->where('objectId',$value['user']);
					$userInfo=toArray($user_Q->find(),array());
					if(!empty($userInfo[0]))
						$parkingList[$key]=array('userInfo'=>$userInfo[0],'parkingInfo'=>$value);
				}
			}
			$returnList['parking']=$parkingList;
		}
		return $returnList;
	}
	public function deleteUser($userId)
	{
		try
		{

			$house_q=new leancloud\AVQuery('House');
			$house_q->where('user',getPointer('_User',$userId));
			$house_r=toArray($house_q->find(),array('villageId','user'));

			if(!empty($house_r))
				foreach ($house_r as $key => $value) {
					$house=new leancloud\AVObject('House');
					$house->user=null;
					$return_h[$key]=$house->update($value['objectId']);
				}

			
			
			$parking_q=new leancloud\AVQuery('Parking');
			$parking_q->where('user',getPointer('_User',$userId));
			$parking_r=toArray($parking_q->find(),array('villageId','user'));

			if(!empty($parking_r))
			{
				foreach ($parking_r as $key => $value) 
				{
					$parking=new leancloud\AVObject('Parking');
					$parking->user=null;
					$return_p[$key]=$parking->update($value['objectId']);
				}
			}

			$user=new leancloud\AVObject('_User');
			$return_u=$user->delete($userId);

			$return=array('house'=>$return_h,'parking'=>$return_p,'user'=>$return_u);
			return $return;
			
		}
		catch(Exception $e)
		{
			return $e;
		}
		
	}
}
?>