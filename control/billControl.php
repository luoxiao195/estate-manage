<?php
require_once '../model/billModel.php';
require_once('../config/config.php');
session_start();
$b=new billModel();
function getUserBill($houseId)					//返回bill主页所需信息
{
	$bill=new billModel();
	$json=$bill->getUserBill($houseId);
	echo (json_encode($json));
}
function deleteBill($billId)
{
	$bill=new billModel();
	$return=$bill->deleteBill($billId);
	return($return);
}
function getTomonth($houseId)
{
	$bill=new billModel();
	$result=$bill->getTomonth($houseId);
	return $result;
}
function getOld($houseId)
{
	$bill=new billModel();
	$result=$bill->getOld($houseId);
	return $result;
}
function getOldParking($parkingId)
{
	$bill=new billModel();
	$result=$bill->getOldParking($parkingId);
	return $result;
}
function insertHouseBill($houseId,$type,$usage,$price,$total,$unit)
{
	$bill=new billModel();
	$return=$bill->insertHouseBill($houseId,$type,$usage,$price,$total,$unit);
	return $return;
}
function insertParkingBill($parkingId,$type,$usage,$price,$total,$unit)
{
	$bill=new billModel();
	$return=$bill->insertParkingBill($parkingId,$type,$usage,$price,$total,$unit);
	return $return;
}
function getId($houseId)
{
	$bill=new billModel();
	$result=$bill->getId($houseId);
	return $result;
}
function search($building,$floor,$unit,$villageId,$skip)
{
	$bill=new billModel();
	$result=$bill->search($building,$floor,$unit,$villageId,$skip);
	return $result;
}
function getParkingTo($parkingId)
{
	$bill=new billModel();
	$result=$bill->getToParking($parkingId);
	return $result;
}
function addParking($parkingId)
{
	$bill=new billModel();
	$result=$bill->getParkingMessage($parkingId);
	return $result;
}
function houseVisible($billId)
{
	$bill=new billModel();
	$result=$bill->houseVisible($billId);
	return $result;
}
function parkingVisible($billId)
{
	$bill=new billModel();
	$result=$bill->parkingVisible($billId);
	return $result;
}
if(isset($_GET['method']))
{
	switch($_GET['method'])
	{
		case 'showUserBill':
			if(!empty($_GET['houseId']))
			{
				header("Location:".__PUBLIC__."/view/bill/index.php?houseId=".$_GET['houseId']);
			}
			break;
		case 'getUserBill':
			echo json_encode(getTomonth($_GET['houseId']));
			break;
		case 'deleteBill':
			deleteBill($_GET['billId']);
			header("Location:".__PUBLIC__."/view/bill/index.php");
			break;
		case 'deleteParkingBill':
			deleteBill($_GET['billId']);
			header("Location:".__PUBLIC__."/view/parkingBill/index.php");
			break;
		case 'newBill':
			header("Location:".__PUBLIC__."/view/bill/add.php?houseId=".$_GET['houseId']."&parkingId=".$_GET['parkingId']);
			break;
		case 'getTomonth':
			echo json_encode(getTomonth($_GET['objectId']));
			break;
		case 'getOldBill':
			echo json_encode(getOld($_GET['houseId']));
			break;
		case 'getId':
			echo json_encode(getId($_GET['houseId']));
			break;
		case 'search':
			echo json_encode(search($_GET['building'],$_GET['floor'],$_GET['unit'],$_GET['villageId'],$_GET['billListPage']));
			break;
		case 'getToParking':
			echo json_encode(getParkingTo($_GET['objectId']));
			break;
		case 'showParkingBill':
			header("Location:".__PUBLIC__."/view/parkingBill/index.php?parkingId=".$_GET['parkingId']);
			break;
		case 'getParkingBill':
			echo json_encode(getParkingTo($_GET['objectId']));
			break;
		case 'getOldParking':
			echo json_encode(getOldParking($_GET['parkingId']));
			break;
		case 'addParking':
			echo json_encode(addParking($_GET['parkingId']));
			break;
		case 'houseVisible':
			houseVisible($_GET['billId']);
			header("Location:".__PUBLIC__."/view/bill/index.php");
			break;
		case 'parkingVisible':
			parkingVisible($_GET['billId']);
			header("Location:".__PUBLIC__."/view/parkingBill/index.php");
			break;
		case 'allPassHouse':
			$b->allPassHouse($_GET['houseId']);
			header("Location:".__PUBLIC__."/view/bill/index.php");
			break;
		case 'allPassParking':
			$b->allPassParking($_GET['parkingId']);
			header("Location:".__PUBLIC__."/view/parkingBill/index.php");
			break;
		default:
			break;
	}
}

if(isset($_POST['houseId']))
{
	if(empty($_POST['houseId'])||empty($_POST['type'])||empty($_POST['usage'])||empty($_POST['price'])||empty($_POST['total'])||empty($_POST['unit']))
	{
		$_SESSION['billCode']='302';
	}
	else
		$return=insertHouseBill($_POST['houseId'],$_POST['type'],$_POST['usage'],$_POST['price'],$_POST['total'],$_POST['unit']);
	
	header("Location:".__PUBLIC__."/view/bill/index.php");
}
if(isset($_POST['parkingId']))
{
	if(empty($_POST['parkingId'])||empty($_POST['type'])||empty($_POST['usage'])||empty($_POST['price'])||empty($_POST['total'])||empty($_POST['unit']))
	{
		$_SESSION['billCode']='302';
	}
	else
	$return=insertParkingBill($_POST['parkingId'],$_POST['type'],$_POST['usage'],$_POST['price'],$_POST['total'],$_POST['unit']);
	//print_r($return);die;
	header("Location:".__PUBLIC__."/view/parkingBill/index.php");
}
