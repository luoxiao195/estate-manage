<?php
	require_once('../model/villageModel.php');
	require_once('../config/config.php');
	session_start();
	if(isset($_GET['method'])){
		$method = $_GET['method'];
		$villageModel = new villageModel();
		
		if($method == 'getAll'){			//获得所有小区信息	
			$villageList = $villageModel->getAll();
			$_SESSION['villageInfoList'] = $villageList;
			header('Location:'.__PUBLIC__.'/view/admin/villageIndex.php');
		}

		else if($method == 'add'){			//添加小区信息
			if(empty($_POST['villageName'])||empty($_POST['address'])||empty($_POST['province'])||empty($_POST['city'])){
				header('Location:'.__PUBLIC__.'/view/admin/addVillage.php');
			}else{
				$villageName = $_POST['villageName'];
				$address = $_POST['address'];
				$province = $_POST['province'];
				$city = $_POST['city'];
				$villageModel->add($villageName,$address,$province,$city);
				header('Location:'.__PUBLIC__.'/control/villageControl.php?method=getAll');
			}
		
		}

		else if($method == 'getByVillageId'){			//根据小区Id取得小区信息
			
			$villageId = $_GET['id'];
			$villageInfo = $villageModel->getByVillageId($villageId);
			$_SESSION['villageInfo'] = $villageInfo;
			header('Location:'.__PUBLIC__.'/view/admin/lookVillage.php');
		}

		else if($method =='update'){					//修改小区信息
			if(empty($_POST['villageName'])||empty($_POST['address'])||empty($_POST['province'])||empty($_POST['city'])){
				$_SESSION['code']='302';
				header('Location:'.__PUBLIC__.'/view/admin/villageUpdate.php');
			}else{
				$villageId = $_GET['id'];
				$villageName = $_POST['villageName'];
				$address = $_POST['address'];
				$province = $_POST['province'];
				$city = $_POST['city'];
				$villageModel->update($villageName,$address,$villageId,$province,$city);
				header('Location:'.__PUBLIC__.'/control/villageControl.php?method=getAll');
			}
		}

		
		else if($method == 'inputHouse'){
			$floor = $_POST['floors'];
			$unit = $_POST['units'];
			$building = $_POST['buildings'];
			$floorArr = explode(",", $floor);
			$unitArr = explode(",", $unit);
			$buildingArr = explode(",", $building);
			$villageModel->addHouse($buildingArr,$floorArr,$unitArr,$_GET['id']);
			header("Location:".__PUBLIC__.'/view/estateManager/index.php');
		}
		else if($method == 'getBuilding'){
			$building = "";
			if(isset($_GET['building'])){
				$building = $_GET['building'];
			}
			$floor = "";
			if(isset($_GET['floor'])){
				$floor = $_GET['floor'];
			}
			$unit = "";
			if (isset($_GET['unit'])) {
				$unit = $_GET['unit'];
			}
			$villageId = $_SESSION['estateManager']['villageId'];
			echo json_encode($villageModel->getBuilding($building,$floor,$unit,$villageId));
		}
		else if($method == 'deleteHouse'){
			$id = $_GET['id'];
			$villageModel->deleteHouse($id);
			echo json_encode(array("code"=>200));
		}
		else if($method == 'updateHouse'){
			$id = $_GET['id'];
			$building = $_GET['building'];
			$floor = $_GET['floor'];
			$unit = $_GET['unit'];
			$villageModel->updateHouse($id,$building,$floor,$unit);
			echo json_encode(array("code"=>200));
		}
		else if($method == 'inputParking'){
			$floor = $_POST['floors'];
			$unit = $_POST['units'];
			$building = $_POST['buildings'];
			$floorArr = explode(",", $floor);
			$unitArr = explode(",", $unit);
			$buildingArr = explode(",", $building);
			$villageModel->addParking($buildingArr,$floorArr,$unitArr,$_GET['id']);
			header("Location:".__PUBLIC__.'/view/estateManager/index.php');
		}
		else if($method == 'getParking'){
			$building = "";
			if(isset($_GET['building'])){
				$building = $_GET['building'];
			}
			$floor = "";
			if(isset($_GET['floor'])){
				$floor = $_GET['floor'];
			}
			$unit = "";
			if (isset($_GET['unit'])) {
				$unit = $_GET['unit'];
			}
			$villageId = $_SESSION['estateManager']['villageId'];
			echo json_encode($villageModel->getParking($building,$floor,$unit,$villageId));
		}
		else if($method == 'deleteParking'){
			$id = $_GET['id'];
			$villageModel->deleteParking($id);
			echo json_encode(array("code"=>200));
		}
		else if($method == 'updateParking'){
			$id = $_GET['id'];
			$building = $_GET['building'];
			$floor = $_GET['floor'];
			$unit = $_GET['unit'];
			$villageModel->updateParking($id,$building,$floor,$unit);
			echo json_encode(array("code"=>200));
		}
		else if($method='getUpdateVillageInfo')
		{
			$info=$villageModel->getUpdateVillageInfo($_GET['villageId']);
			echo  json_encode($info);
		}
	}
	

?>