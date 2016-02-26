<?php
require_once('head.php');
?>
<!DOCTYPE html>
<html>
<head>
	<title>添加小区</title>
	<meta http-equiv="Content-Type" content="text/html;charset=utf-8">
	<meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0,user-scalable=no">
    <link href="http://apps.bdimg.com/libs/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet">
    <script src="http://apps.bdimg.com/libs/jquery/2.0.0/jquery.min.js"></script>
    <script src="http://apps.bdimg.com/libs/bootstrap/3.3.0/js/bootstrap.min.js"></script>
</head>
<body>
	<div class='container'>
	<?php require_once('navigation.php'); ?>
	<script type="text/javascript">
		document.getElementById('village').setAttribute('class','dropdown active');
		document.getElementById('addVillage').setAttribute('class','active');
	</script>
	<div align="center">
		<form class="form-horizontal" role="form" method="POST" action=<?php echo __PUBLIC__.'/control/villageControl.php?method=add';?>>
			<div class="row form-group">
				<label for="villageName" class="col-sm-4">小区名字</label>
				<div class="col-sm-4">
					<input type='text' name='villageName' class="form-control">
				</div>
			</div>
			<div class="row form-group">
				<label class="col-sm-4" for="province">省份</label>
				<div class="col-sm-4">
					<input class="form-control" type='text' name='province'>
				</div>
			</div>
			<div class="row form-group">
				<label class="col-sm-4" for="city">城市</label>
				<div class="col-sm-4">
					<input class="form-control" type='text' name='city'>
				</div>
			</div>
			<div class="row form-group">
				<label class="col-sm-4" for="address">详细地址</label>
				<div class="col-sm-4">
					<input class="form-control" type='text' name='address'>
				</div>
			</div>
			<div class="form-group">
				<div class="col-sm-offset-3 col-sm-6">
					<button type="submit" class="btn btn-primary">添加</button>
				</div>
			</div>
		</div>
		</form>
	</div>
</body>
</html>