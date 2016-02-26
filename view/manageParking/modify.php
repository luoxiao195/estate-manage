<?php
		require_once('../estateManager/head.php');
		require ('../../utils/getInformation.php');
		require ('../../utils/function.php');
		if (isset($_GET['objectId']))
			$_SESSION['modifyId']=$_GET['objectId'];				//userId
		if(isset($_SESSION['objectId']))
		{
		HttpClient::init($HttpClient, array('userAgent' => $_SERVER['HTTP_USER_AGENT'], 'redirect' => true));
		$HttpClient->get(__PUBLIC__."/control/manageParkingControl.php?getMethod=modifyDetailData&objectId=".$_SESSION['modifyId']);
		$json=json_decode($HttpClient->buffer,true);
		}
?>
<!DOCTYPE html>
<html>
	<head>
		<title>修改停车位用户信息</title>
		<meta http-equiv="Content-Type" content="text/html;charset=utf-8">
		<meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0,user-scalable=no">
    	<link href="http://apps.bdimg.com/libs/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet">
    	<script src="http://apps.bdimg.com/libs/jquery/2.0.0/jquery.min.js"></script>
    	<script src="http://apps.bdimg.com/libs/bootstrap/3.3.0/js/bootstrap.min.js"></script>
			
	</head>
	<?php
		require_once('../estateManager/navigation.php');
		echo "<div class='container'>";
		require_once('navigation.php');
	?>
	<script type="text/javascript">
		document.getElementById('parking').setAttribute('class','dropdown active');
		document.getElementById('lookParking').setAttribute('class','active');
		document.getElementById('update').setAttribute('class','active');
	</script>
	<body>
		
		<div class="col-sm-8" align="center">
		<form method="POST" action="../../control/manageParkingControl.php" role="form" class="form-horizontal">
			<div class="row form-group">
				<input type="hidden" name="userId" <?php  echo "value=\"".$json['userInfo']['objectId']."\""; ?>>
			</div>
			<div class="row form-group">
				<input type="hidden" name="parkingId" <?php  echo "value=\"".$json['parkingInfo']['objectId']."\""; ?>>
			</div>
			
 			<div class="row form-group">
 				<label for="name" class="col-sm-4 control-label">姓名</label>
 				<div class="col-sm-4">
 					<input class="form-control" type="text" name="name" <?php echo "value=\"".$json['userInfo']['name']."\""; ?>>
 				</div>
 			</div>
 			<hr>
 			<div class="row form-group">
 				<label for="gender" class="col-sm-4 control-label">性别</label>
 				<div class="col-sm-4">
					<input  type="radio" name="gender"
					<?php if(!isset($json['userInfo']['gender'])||$json['userInfo']['gender']==0)
					echo "checked";
					?> value="0">未知
					<input type="radio"
					<?php if(isset($json['userInfo']['gender'])&&$json['userInfo']['gender']==1)
					echo "checked";
					?>  name="gender" value="1">男
					<input type="radio" <?php if(isset($json['userInfo']['gender'])&&$json['userInfo']['gender']==2)
					echo "checked";
					?>  name="gender" value="2">女
				</div>
			</div>
			<hr>
			<div class="row form-group">
				<label for="age" class="col-sm-4 control-label">年龄</label>
				<div class="col-sm-4">
					<input class="form-control" type="text" name="age" <?php if(isset($json['userInfo']['age'])) echo "value=\"".ifExit($json['userInfo']['age'])."\""; ?>>
				</div>
			</div>
			<hr>
			<div class="row form-group">
				<label for="mobilePhoneNumber" class="col-sm-4 control-label">联系电话</label>
				<div class="col-sm-4">
					<input class="form-control" type="text" name="mobilePhoneNumber" <?php echo "value=\"".$json['userInfo']['mobilePhoneNumber']."\""; ?>>
				</div>
			</div>
			<hr>
			<div class="row form-group">
				<label for="type" class="col-sm-4 control-label">用户类型</label>
				<div class="col-sm-4">
					<input type="radio" <?php if($json['userInfo']['type']=="tenant")
													echo "checked";
										?>  name="type" value="tenant">租户
					<input type="radio" <?php if($json['userInfo']['type']=="owner")
											echo "checked";
										?>   name="type" value="owner">业主
				</div>
			</div>
			<hr>
			<div class="row form-group">
				<label for="email" class="col-sm-4 control-label">邮箱地址</label>
				<div class="col-sm-4">
					<input class="form-control" type="text" name="email" <?php if(isset($json['userInfo']['email'])) echo "value=\"".$json['userInfo']['email']."\""; ?>>
				</div>
			</div>
			<hr>
			<div class="row form-group">
				<label for="isMarried" class="col-sm-4 control-label">婚姻状况</label>
				<div class="col-sm-4">
					<input type="radio" <?php if(!isset($json['userInfo']['isMarried'])||$json['userInfo']['isMarried']=="未知")
												echo "checked";
										?> name="isMarried" value="未知">未知
					<input type="radio" <?php if(isset($json['userInfo']['isMarried'])&&$json['userInfo']['isMarried']=="已婚")
												echo "checked";
										?> name="isMarried" value="已婚">已婚
					<input type="radio" <?php if(isset($json['userInfo']['isMarried'])&&$json['userInfo']['isMarried']=="未婚")
												echo "checked";
										?> name="isMarried" value="未婚">未婚
				</div>
			</div>
			<hr>
			
		
			<div class="row form-group">
				<label for="occupation" class="col-sm-4 control-label">职业</label>
				<div class="col-sm-4">
					<input class="form-control" type="text" name="occupation" <?php if(isset($json['userInfo']['occupation'])) echo "value=\"".$json['userInfo']['occupation']."\""; ?>>
				</div>	
			</div>
			<hr>
			<h4>停车位地址</h4>
			<div class="row form-group">
				<label for="houseBuilding" class="col-sm-4 control-label">座别</label>
				<div class="col-sm-4">
					<input class="form-control" type="text" name="parkingBuilding" <?php echo "value=\"".$json['parkingInfo']['building']."\""; ?> >
				</div>
			</div>
			<div class="row form-group">
				<label for="houseFloor" class="col-sm-4 control-label">楼层</label>
				<div class="col-sm-4">
					<input class="form-control" type="text" name="parkingFloor" <?php echo "value=\"".$json['parkingInfo']['floor']."\""; ?> >
				</div>
			</div>
			<div class="row form-group">
				<label for="houseUnit" class="col-sm-4 control-label">单元</label>
				<div class="col-sm-4">
					<input class="form-control" type="text" name="houseUnit" <?php echo "value=\"".$json['parkingInfo']['unit']."\""; ?> >
				</div>
			</div>
			<div class="form-group">
				<div class="col-sm-offset-3 col-sm-6">
					<button type="submit" class="btn btn-primary">确定</button>
				</div>
			</div>
		</form>
		</div>
		</div>
	</body>
</html>