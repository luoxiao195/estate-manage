<?php
require_once('head.php');
?>
<!DOCTYPE html>
<html>
<head>
	<title>修改密码</title>
	<meta http-equiv="Content-Type" content="text/html;charset=utf-8">
	<meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0,user-scalable=no">
    <link href="http://apps.bdimg.com/libs/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet">
    <script src="http://apps.bdimg.com/libs/jquery/2.0.0/jquery.min.js"></script>
    <script src="http://apps.bdimg.com/libs/bootstrap/3.3.0/js/bootstrap.min.js"></script>
    <script type="text/javascript">
    	function checkpassword(){
    		if(document.getElementById('newPassword').value != document.getElementById('newPassword2').value){
    			alert('两次密码不一致');
    			window.event.returnValue = false;
    		}
    	}
    </script>
</head>
<body>
<?php
require_once('navigation.php');
?>
<script type="text/javascript">
	document.getElementById('estateManager').setAttribute('class','navbar-right dropdown active');
	document.getElementById('updatePassword').setAttribute('class','active');
</script>
<div align="center">
	<form class="form-horizontal" role="form" method="post" action=<?php echo __PUBLIC__.'/control/estateManagerControl.php?method=update&id='.$_SESSION['estateManager']['objectId'];?>>
		<div class="row form-group">
			<label for="password" class="col-sm-4 control-label">原密码</label>
			<div class="col-sm-4">
				<input type="password" class="form-control" name="password"></br>
			</div>
		</div>
		<div class="row form-group">
			<label for="newPassword" class="col-sm-4 control-label">新密码</label>
			<div class="col-sm-4">
				<input type="password" class="form-control" name="newPassword" id="newPassword"></br>
			</div>
		</div>
		<div class="row form-group">
			<label for="newPassword2" class="col-sm-4 control-label">确认密码</label>
			<div class="col-sm-4">
				<input type="password" class="form-control" name="newPassword2" id="newPassword2"></br>
			</div>
		</div>
		<div class="form-group">
			<div class="col-sm-offset-3 col-sm-6">
				<button type="submit" class="btn btn-primary" onclick="checkpassword()">提交</button>
			</div>
		</div>
	</form>
</div>
</body>
</html>