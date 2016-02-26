<?php
require_once('head.php');
?>
<!DOCTYPE html>
<html>
<head>
	<?php
    	echo "<script  type=\"text/javascript\">";
    	if(isset($_SESSION["assCode"]))
    		switch ($_SESSION["assCode"]) {
    			case "303":
    				echo "alert(\"用户名已被占用\");";
    				break;
    			case "304":
    				echo "alert(\"邮箱已被占用\");";
    				break;
    			case "305":
    				echo "alert(\"输入密码格式错误\");";
    				break;
    			case "306":
    				echo "alert(\"邮箱格式不合法\");";
    				break;
    			case "307":
    				echo "alert(\"手机格式不合法\")";
    				break;
    			case '308':
    				echo "alert(\"输入房屋信息错误\")";
    				break;
    			case '309':
    				echo "alert(\"输入停车位信息错误\")";
    				break;
    			case '201':
    				echo "alert(\"录入成功\")";
    				break;
				case '405':
					echo "alert(\"必须填写房屋信息\")";
					break;
				case '312':
					echo "alert(\"联系电话已被占用\")";
					break;
    			default:
    				# code...
    				break;
    		}
    	$_SESSION["assCode"]=null;
    		echo "</script>";
    ?>
	<title>添加用户</title>
	<meta http-equiv="Content-Type" content="text/html;charset=utf-8">
	<meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0,user-scalable=no">
    <link href="http://apps.bdimg.com/libs/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet">
    <script src="http://apps.bdimg.com/libs/jquery/2.0.0/jquery.min.js"></script>
    <script src="http://apps.bdimg.com/libs/bootstrap/3.3.0/js/bootstrap.min.js"></script>
    <script type="text/javascript">

    	var i = 0;
    	var j = 0;
    	function addHouse(){
    		$("#house").append('<hr><div class="row form-group"><label for=houseBuilding'+i+' class="col-sm-4 control-label">座别</label><div class="col-sm-4"><input class="form-control" type="text" name=houseBuilding'+i+'></div></div>');
    		$("#house").append('<div class="row form-group"><label for=houseFloor'+i+' class="col-sm-4 control-label">楼层</label><div class="col-sm-4"><input class="form-control" type="text" name=houseFloor'+i+'></div></div>');
    		$("#house").append('<div class="row form-group"><label for=houseUnit'+i+' class="col-sm-4 control-label">单元</label><div class="col-sm-4"><input class="form-control" type="text" name=houseUnit'+i+'></div></div>')
    		i++;
    	};
    	function addParking(){
    		$("#parking").append('<hr><div class="row form-group"><label for=parkingBuilding'+j+' class="col-sm-4 control-label">座别</label><div class="col-sm-4"><input class="form-control" type="text" name=parkingBuilding'+j+'></div></div>');
    		$("#parking").append('<div class="row form-group"><label for=parkingFloor'+j+' class="col-sm-4 control-label">楼层</label><div class="col-sm-4"><input class="form-control" type="text" name=parkingFloor'+j+'></div></div>');
    		$("#parking").append('<div class="row form-group"><label for=parkingUnit'+j+' class="col-sm-4 control-label">单元</label><div class="col-sm-4"><input class="form-control" type="text" name=parkingUnit'+j+'></div></div>')
    		j++;
    	};
    	function add(){
    		$("#content").append('<input type="hidden" name="houseNum" value='+i+'>');
    		$("#content").append('<input type="hidden" name="parkingNum" value='+j+'>');
    	};
    </script>
    
   
    	
	
</head>
<body>
	<div class='container'>
	<?php require_once('navigation.php');?>
	<script type="text/javascript">
		document.getElementById('user').setAttribute('class','dropdown active');
		document.getElementById('addUser').setAttribute('class','active');
	</script>
	<div align="center">
		<form method="POST" action=<?php echo __PUBLIC__."/control/assistantControl.php?method=add"?> role="form" class="form-horizontal" id="content">
 			<div class="row form-group">
 				<label for="username" class="col-sm-4 control-label">账号</label>
 				<div class="col-sm-4">
 					<input class="form-control" type="text" name="username" value=<?php
						if(isset($_SESSION['username']))
						{
							echo "\"".$_SESSION['username']."\"";
						}
						else
						{
							echo '一般账号为手机号';
						}							
					?> onfocus="if(this.value == '一般账号为手机号'){this.value = ''}" onblur="if(this.value == ''){this.value = '一般账号为手机号'}"/>
 				</div>
 			</div>
 			<div class="row form-group">
 				<label for="password" class="col-sm-4 control-label">密码</label>
 				<div class="col-sm-4">
 					<input class="form-control" type="text" name="password" <?php
						if(isset($_SESSION['password']))
						{
							echo "value=\"".$_SESSION['password']."\"";
						}							
					?>>
 					<p style="color:red;font-size:8px;">一旦录入将无法查看</p>
 				</div>
 			</div>
 			<div class="row form-group">
 				<label for="name" class="col-sm-4 control-label">姓名</label>
 				<div class="col-sm-4">
 					<input class="form-control" type="text" name="name" <?php
						if(isset($_SESSION['name']))
						{
							echo "value=\"".$_SESSION['name']."\"";
						}							
					?>/>
 				</div>
 			</div>
 			<hr>
 			<div class="row form-group">
 				<label for="gender" class="col-sm-4 control-label">性别</label>
 				<div class="col-sm-4">
					<input  type="radio" name="gender" value="0" <?php if(isset($_SESSION['gender'])&&$_SESSION['gender']=='0')
						{
							echo "checked=\"true\"";
						}
						else if(empty($_SESSION['gender']))
						{
							echo "checked=\"true\"";
						}
								?>
						>未知
					<input type="radio" name="gender" value="1" <?php if(isset($_SESSION['gender'])&&$_SESSION['gender']=='1')
						{
							echo "checked=\"true\"";
						}?>>男
					<input type="radio" name="gender" value="2" <?php if(isset($_SESSION['gender'])&&$_SESSION['gender']=='2')
						{
							echo "checked=\"true\"";
						}?>>女
				</div>
			</div>
			<hr>
			<div class="row form-group">
				<label for="age" class="col-sm-4 control-label">年龄</label>
				<div class="col-sm-4">
					<input class="form-control" type="text" name="age" <?php
						if(isset($_SESSION['age']))
						{
							echo "value=\"".$_SESSION['age']."\"";
						}							
					?>>
				</div>
			</div>
			<hr>
			<div class="row form-group">
				<label for="mobilePhoneNumber" class="col-sm-4 control-label">联系电话</label>
				<div class="col-sm-4">
					<input class="form-control" type="text" name="mobilePhoneNumber" <?php
						if(isset($_SESSION['mobilePhoneNumber']))
						{
							echo "value=\"".$_SESSION['mobilePhoneNumber']."\"";
						}							
					?>>
					<p style="color:red;font-size:8px;">此项必填</p>
				</div>
			</div>
			<hr>
			<div class="row form-group">
				<label for="type" class="col-sm-4 control-label">用户类型</label>
				<div class="col-sm-4">
					<input type="radio" name="type" value="tenant" <?php if(isset($_SESSION['type'])&&$_SESSION['type']=='tenant')
						{
							echo "checked=\"true\"";
						}
						else if(empty($_SESSION['type']))
						{
							echo "checked=\"true\"";
						}		?>>租户
					<input type="radio" name="type" value="owner" <?php if(isset($_SESSION['type'])&&$_SESSION['type']=='owner')
						{
							echo "checked=\"true\"";
						}		?> >业主
				</div>
			</div>
			<hr>
			<div class="row form-group">
				<label for="email" class="col-sm-4 control-label">邮箱地址</label>
				<div class="col-sm-4">
					<input class="form-control" type="text" name="email"  <?php
						if(isset($_SESSION['email']))
						{
							echo "value=\"".$_SESSION['email']."\"";
						}							
					?>/>
					<p style="color:red;font-size:8px;">此项必填</p>
				</div>
			</div>
			<hr>
			<div class="row form-group">
				<label for="isMarried" class="col-sm-4 control-label">婚姻状况</label>
				<div class="col-sm-4">
					<input type="radio" name="isMarried" value="未知" checked="true" <?php if(isset($_SESSION['isMarry'])&&$_SESSION['isMarry']=='未知')
						{
							echo "checked=\"true\"";
						}		?>>未知
					<input type="radio" name="isMarried" value="已婚"  <?php if(isset($_SESSION['isMarry'])&&$_SESSION['isMarry']=='已婚')
						{
							echo "checked=\"true\"";
						}		?>>已婚
					<input type="radio" name="isMarried" value="未婚"<?php if(isset($_SESSION['isMarry'])&&$_SESSION['isMarry']=='未婚')
						{
							echo "checked=\"true\"";
						}		?>>未婚
				</div>
			</div>
			<hr>
			
		
			<div class="row form-group">
				<label for="occupation" class="col-sm-4 control-label">职业</label>
				<div class="col-sm-4">
					<input class="form-control" type="text" name="occupation" <?php
						if(isset($_SESSION['occupation']))
						{
							echo "value=\"".$_SESSION['occupation']."\"";
						} ?>>
				</div>	
			</div>
			<hr>
			<h4>房屋地址</h4>
			<a  class="btn btn-primary" onclick="addHouse()">添加房屋</a>
			<div id="house">
				
			</div>
			<hr>
			<h4>停车位地址</h4>
			<a  class="btn btn-primary" onclick="addParking()">添加车位</a>
			<div id="parking">
				
			</div>
			<hr>
			
		
			<div class="form-group">
				<div class="col-sm-offset-3 col-sm-6">
					<button type="submit" class="btn btn-primary" onclick="add()">确定</button>
				</div>
			</div>
		</form>
	</div>
</div>
</body>
</html>