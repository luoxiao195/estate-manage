<?php
require_once '../model/manageParkingModel.php';
require_once('../config/config.php');

function forParkingList($objectId,$skip)
{
	$message=new manageModel();
	$parkingList=$message->showParkingList($objectId,$skip);
	echo json_encode($parkingList);

}

function forParkingDetail($objectId)
{
	$message=new manageModel();
	$information=$message->showParkingDetail($objectId);
	echo json_encode($information);
}
function getTomMnthBill($houseId,$parkingId)
{
	//$houseId="55b4a3da00b0bb80c44c4516";
	//$parkingId="55b4b47000b0bb80c44cf833";
	$m=new manageModel();
	$return=$m->showTomonthBill($houseId,$parkingId);
	echo json_encode($return);
}
function deleteUser($objectId)
{
	$m=new manageModel();
	$return=$m->deleteUserInfo($objectId);
	return $return;
}
function getModifyData($parkingId)
{
	$m=new manageModel();
	$return=$m->modifyParking($parkingId);
	return $return;
}
if(isset($_GET['getMethod']))
{
	$choice=$_GET['getMethod'];
	switch ($choice) {
		case 'showUserList':
			header("Location:".__PUBLIC__."/view/user/index.php");
			break;
		case 'getInformation':
			forParkingList($_GET['objectId'],$_GET['parkingListPage']);
			break;
		case 'modifyDetailData':			//for modify.php
			echo json_encode(getModifyData($_GET['objectId']));
			break;
		case 'toDetail':
			header("Location:".__PUBLIC__."/view/manageUser/index.php?objectId=".$_GET['objectId']);
			break;
		case 'getDetailData':				//for detail.php
			forParkingDetail($_GET['objectId']);
			break;
		case 'modify':
			header("Location:".__PUBLIC__."/view/manageParking/modify.php?objectId=".$_GET['objectId']);
			break;
		case 'deleteUser':
			echo $_GET['parkingId'];
			deleteUser($_GET['parkingId']);
			header("Location:".__PUBLIC__."/view/manageParking/index.php");
			break;
		default:
			# code...
			break;
	}
}
if(isset($_POST['userId']))
{
	if(!isset($_POST['name']))
	{
		$_POST['name']='';
	}
	if(!isset($_POST['type']))
	{
		$_POST['type']='';
	}
	if(!isset($_POST['isMarried']))
	{
		$_POST['isMarried']='';
	}
	$message=array('name'=>$_POST['name'],'gender'=>$_POST['gender'],'type'=>$_POST['type'],'isMarried'=>$_POST['isMarried'],'mobilePhoneNumber'=>$_POST['mobilePhoneNumber'],'email'=>$_POST['email'],'age'=>$_POST['age'],'occupation'=>$_POST['occupation'],'userId'=>$_POST['userId'],'parking'=>array('building' =>$_POST['parkingBuilding'],'floor'=>$_POST['parkingFloor'],'unit'=>$_POST['houseUnit'],'parkingId'=>$_POST['parkingId']));
	print_r($message);
	$m=new manageModel();
	$return=$m->updateUser($message);
	header("Location:".__PUBLIC__."/view/manageParking/detail.php");
}