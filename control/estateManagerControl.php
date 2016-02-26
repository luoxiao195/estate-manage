<?php
require_once('../model/estateManagerModel.php');
require_once('../model/villageModel.php');
require_once('../config/config.php');
require_once('../model/uploadFileModel.php');
session_start();
if(isset($_GET['method'])){
	$method = $_GET['method'];

	$estateManagerModel = new estateManagerModel();
	$villageModel = new villageModel();

	if($method=='getAll'){				//获得所有管理员信息
		$estateManagerList = $estateManagerModel->getAll();
		$returnList=array();
		foreach ($estateManagerList as $key => $value) {
			$returnList[$key]=$value;
			$villageInfo = $villageModel->getByVillageId($value['villageId']);
			$returnList[$key]['villageName']=$villageInfo['villageName'];
		}


		//$_SESSION['estateManagerList']=$estateManagerList;
		$_SESSION['estateManagerList']=$returnList;
		header("Location:".__PUBLIC__."/view/admin/estateManagerIndex.php");
	}

	else if($method=='register'){     //注册管理员账号
		$villageId = $_GET['id'];
		if(!isset($_POST['adminName'])||!isset($_POST['adminPassword'])){
			header("Location:".__PUBLIC__."/view/admin/registerManager.php?id=".$villageId);
		}else{
			$estateName = $_POST['adminName'];
			$estatePassword = $_POST['adminPassword'];
			$return=$estateManagerModel->register($estateName,$estatePassword,$villageId);
			if($return)
				$_SESSION['registerCode']='200';
			else
				$_SESSION['registerCode']='310';
			header("Location:".__PUBLIC__.'/control/estateManagerControl.php?method=getAll');
		}
		
	}

	else if($method=='look'){   		//查看管理员所属小区信息
		$villageId = $_GET['id'];
		$villageInfo = $villageModel->getByVillageId($villageId);
		$_SESSION['villageInfo'] = $villageInfo;
		header("Location:".__PUBLIC__."/view/admin/lookVillage.php");
	}

	else if($method=='login'){			//管理员登录处理
		if(isset($_POST['username'])&&isset($_POST['password'])){
			$estateManager = $estateManagerModel->login($_POST['username'],$_POST['password']);
			if(!empty($estateManager)){
				$villageId = $estateManager['villageId'];

				$villageInfo = $villageModel->getByVillageId($villageId);
                $estateManager = array_merge($estateManager,array('name'=>$villageInfo['name']));
				$estateManager = array_merge($estateManager,array('province'=>$villageInfo['province']));
				$estateManager = array_merge($estateManager,array('city'=>$villageInfo['city']));
				$estateManager = array_merge($estateManager,array('address'=>$villageInfo['address']));
				$_SESSION['estateManager'] = $estateManager;
				$_SESSION['eCookie']='201';
				$_SESSION['houseListPage']=0;
				$_SESSION['parkingListPage']=0;
				$_SESSION['billListPage']=0;
				header("Location:".__PUBLIC__."/view/estateManager/index.php");
			}
			else
			{
				$_SESSION['eCookie']='301';
				header("Location:".__PUBLIC__."/view/estateManager/login.php");
			}
			
				
		}
		
	}
	else if($method=='update'){				//修改密码
		if(isset($_POST['password'])&&$_POST['password']==$_SESSION['estateManager']['password']&&isset($_POST['newPassword'])){
			$estatePassword = $_POST['newPassword'];
			$estateManagerId = $_GET['id'];
			$estateManagerModel->update($estatePassword,$estateManagerId);

		}
		header("Location:".__PUBLIC__.'/control/estateManagerControl.php?method=logout');		
	}

	else if($method == 'delete'){			//删除管理员账号
		if(isset($_GET['id'])){
			$estateManagerId = $_GET['id'];
			$estateManagerModel->delete($estateManagerId);
		}
		header('Location:'.__PUBLIC__.'/control/estateManagerControl.php?method=getAll');
	}
	else if($method == 'logout'){			//退出管理员账号
		$_SESSION['estateManager'] = null;
		header("Location:".__PUBLIC__.'/view/estateManager/login.php');
	}
	else if($method == 'waterPrice'){		//修改水费
		if(isset($_POST['fee'])&&isset($_SESSION['estateManager'])){
			$villageModel->updateWater((double)$_POST['fee'],$_SESSION['estateManager']['villageId']);
		}
		header("Location:".__PUBLIC__.'/view/estateManager/index.php');
		
	}	
	else if($method == 'powerPrice'){		//修改电费
		if(isset($_POST['fee'])&&isset($_SESSION['estateManager'])){
			$villageModel->updatePower((double)$_POST['fee'],$_SESSION['estateManager']['villageId']);
		}
		header("Location:".__PUBLIC__.'/view/estateManager/index.php');
	}
	else if($method=='getFiles')
	{
		$uploadFileModel=new uploadFileModel();
		$villageId =$_GET['villageId'];
		$fileList =$uploadFileModel->getFiles($villageId);
		echo json_encode($fileList);
	}
	else if($method='deleteFile')
	{
		$f=new uploadFileModel();
		$result=$f->deleteFile($_GET['fileId']);
		if($result)
			$_SESSION['fileCode']='200';
		else
			$_SESSION['fileCode']='313';
		header('Location:'.__PUBLIC__.'/view/estateManager/upload.php');
	}
}


?>