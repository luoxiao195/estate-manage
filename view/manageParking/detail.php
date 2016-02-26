<?php
	require_once('../../utils/getInformation.php');
	require_once('../estateManager/head.php');
	if(isset($_GET['objectId']))
		$_SESSION['objectId']=$_GET['objectId'];
	if(isset($_SESSION['objectId']))
	{
		HttpClient::init($HttpClient, array('userAgent' => $_SERVER['HTTP_USER_AGENT'], 'redirect' => true));
		$HttpClient->get(__PUBLIC__."/control/manageParkingControl.php?getMethod=getDetailData&objectId=".$_SESSION['objectId']);
		$json=json_decode($HttpClient->buffer,true);
		if(!empty($json['userInfo']))
			$_SESSION['userId']=$json['userInfo']['objectId'];
		if(empty($json))
			$json=array('userInfo'=>'','parkingInfo'=>'');
		
	}
	
	
?>
<!DOCTYPE html>
<html>
<head>
	<title>停车位用户详细</title>
	<meta http-equiv="Content-Type" content="text/html;charset=utf-8">
	<meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0,user-scalable=no">
    <link href="http://apps.bdimg.com/libs/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet">
    <script src="http://apps.bdimg.com/libs/jquery/2.0.0/jquery.min.js"></script>
    <script src="http://apps.bdimg.com/libs/bootstrap/3.3.0/js/bootstrap.min.js"></script>
</head>
<body>
<?php 
require_once('../estateManager/navigation.php');
echo "<div class='container'>";
require_once('navigation.php');
?>
<script type="text/javascript">
	document.getElementById('parking').setAttribute('class','dropdown active');
	document.getElementById('lookParking').setAttribute('class','active');
	document.getElementById('detail').setAttribute('class','active');
</script>

<div class="col-sm-7 jumbotron">
	<p align="center">账号:<?php 
	if(empty($json['userInfo']['username']))
		echo "尚未填写";
	else
		echo $json['userInfo']['username'];?></p>
	<p align="center">姓名:<?php 
	if(empty($json['userInfo']['name']))
		echo "尚未填写";
	else
		echo $json['userInfo']['name'];?></p>
	<p align="center">性别:
				<?php
				if(!isset($json['userInfo']['gender']))
				{
					echo "尚未填写";
				} 
  				else if($json['userInfo']['gender']==1)
					echo "男";
				else if($json['userInfo']['gender']==2)
					echo "女";
				?>
	</p>
	<p align="center">用户类型:
				<?php 
				if(empty($json['userInfo']['type']))
					echo "尚未填写";
				else if($json['userInfo']['type']=="tenant")
					echo "租户";
				else if($json['userInfo']['type']=="owner")
					echo "房东";
				?>
	</p>
	<p align="center">联系电话:<?php 
	if(empty($json['userInfo']['mobilePhoneNumber']))
		echo "尚未填写";
	else
	echo $json['userInfo']['mobilePhoneNumber'];?></p>
	<p align="center">邮箱地址:<?php 
	if(empty($json['userInfo']['email']))
		echo "尚未填写";
	else
	echo $json['userInfo']['email'];?></p>
	<p align="center">年龄:<?php 
	if(empty($json['userInfo']['age']))
		echo "尚未填写";
	else
	echo $json['userInfo']['age'];?></p>
	<p align="center">职业:<?php 
	if(empty($json['userInfo']['occupation']))
		echo "尚未填写";
	else
	echo $json['userInfo']['occupation'];?></p>
	<p align="center">婚姻状况:<?php 
	if(empty($json['userInfo']['isMarried']))
		echo "尚未填写";
	else
		echo $json['userInfo']['isMarried'];?></p>
	<?php 
	if(!empty($json['parkingInfo']))
	{
		echo "<p align=\"center\">停车位: ".$json['parkingInfo']['building']."栋".$json['parkingInfo']['floor']."层".$json['parkingInfo']['unit']."号"."</p>";
	}
	else
	{
		echo "<p align=\"center\">住址:尚未拥有</p>";
	}		
		
	?>
	<div align="center">
		<a class="btn btn-primary alert alert-danger" <?php echo "href=\"../../control/manageParkingControl.php?getMethod=deleteUser&parkingId=".$_SESSION['objectId']."\"";?>>删除该用户</a></br> 
	</div>


</div>


</div>


</body>
</html>
