<?php
require_once('head.php');
require_once('../../utils/getInformation.php');
if(isset($_GET['id']))
{
	$_SESSION['villageId']=$_GET['id'];
}
if(isset($_SESSION['villageId']))				//获取要修改小区的信息，显示与form表单上
{
	HttpClient::init($HttpClient, array('userAgent' => $_SERVER['HTTP_USER_AGENT'], 'redirect' => true));
	$HttpClient->get(__PUBLIC__."/control/villageControl.php?method=getUpdateVillageInfo&villageId=".$_SESSION['villageId']);
	$json=json_decode($HttpClient->buffer,true);
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>小区修改</title>
	<meta http-equiv="Content-Type" content="text/html;charset=utf-8">
	<meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0,user-scalable=no">
    <link href="http://apps.bdimg.com/libs/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet">
    <script src="http://apps.bdimg.com/libs/jquery/2.0.0/jquery.min.js"></script>
    <script src="http://apps.bdimg.com/libs/bootstrap/3.3.0/js/bootstrap.min.js"></script>
</head>
<body>
	<div class='container'>
<Script Language="JavaScript">
<?php 
	if(isset($_SESSION['code'])&&$_SESSION['code']=='302')
	{
		echo "alert(\"信息不能为空\")";
		$_SESSION['code']=null;
	}
		
?>
</Script>
<?php
require_once('navigation.php');
?>
<div align="center">
		<form class="form-horizontal" role="form" method="POST" action=<?php echo __PUBLIC__.'/control/villageControl.php?method=update&id='.$_SESSION['villageId']; ?>>
			<div class="row form-group">
				<label for="villageName" class="col-sm-4">小区名字</label>
				<div class="col-sm-4">
					<input type='text' name='villageName' class="form-control" <?php 
						if(!empty($json))
						{
							echo "value=\"".$json['villageInfo']['name']."\"";
						}
					?>>
				</div>
			</div>
			<div class="row form-group">
				<label class="col-sm-4" for="province">省份</label>
				<div class="col-sm-4">
					<input class="form-control" type='text' name='province'<?php 
						if(!empty($json))
						{
							echo "value=\"".$json['villageInfo']['province']."\"";
						}
					?>>
				</div>
			</div>
			<div class="row form-group">
				<label class="col-sm-4" for="city">城市</label>
				<div class="col-sm-4">
					<input class="form-control" type='text' name='city'
					<?php 
						if(!empty($json))
						{
							echo "value=\"".$json['villageInfo']['city']."\"";
						}
					?>
					>
				</div>
			</div>
			<div class="row form-group">
				<label class="col-sm-4" for="address">详细地址</label>
				<div class="col-sm-4">
					<input class="form-control" type='text' name='address'
					<?php 
						if(!empty($json))
						{
							echo "value=\"".$json['villageInfo']['address']."\"";
						}
					?>
					>
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