<?php
require_once('../../config/config.php');
session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title>后台登陆</title>
	<meta http-equiv="Content-Type" content="text/html;charset=utf-8">
	<meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0,user-scalable=no">
    <link href="http://apps.bdimg.com/libs/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet">
    <script src="http://apps.bdimg.com/libs/jquery/2.0.0/jquery.min.js"></script>
    <script src="http://apps.bdimg.com/libs/bootstrap/3.3.0/js/bootstrap.min.js"></script>
</head>
<body>
	<h1 align="center">登录</h1>
	<div align="center">
	<form class="form-horizontal" role="form" method="post" action=<?php echo __PUBLIC__.'/control/adminLoginControl.php'?>>
		<div class="row form-group">
			<label for="adminName" class="col-sm-4 control-label">账号</label>
			<div class="col-sm-4">
				<input type="text" class="form-control" name="adminName"></br>
			</div>
		</div>
		<div class="row form-group">
			<label for="adminPassword" class="col-sm-4 control-label">密码</label>
			<div class="col-sm-4">
				<input type="password" class="form-control" name="adminPassword"></br>
				<p style="color:red;font-size:12px;"><?php 
				if(isset($_SESSION['adminCookie']))
				{
					if($_SESSION['adminCookie']=='301')
					{
						echo "用户名不存在或密码错误";
						$_SESSION['adminCookie']=null;
					}
				}
			?></p>
			</div>
		</div>
		<div class="form-group">
			<div class="col-sm-offset-3 col-sm-6">
				<button type="submit" class="btn btn-primary">登录</button>
			</div>
		</div>
	</form>
	</div>
</body>
</html>