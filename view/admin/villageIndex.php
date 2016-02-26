<?php
require_once('head.php');
?>
<!DOCTYPE html>
<html>
<head>
	<title>小区管理</title>
	<meta http-equiv="Content-Type" content="text/html;charset=utf-8">
	<meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0,user-scalable=no">
    <link href="http://apps.bdimg.com/libs/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet">
    <script src="http://apps.bdimg.com/libs/jquery/2.0.0/jquery.min.js"></script>
    <script src="http://apps.bdimg.com/libs/bootstrap/3.3.0/js/bootstrap.min.js"></script>
</head>
<body>
	<div class='container'>
	<?php require_once('navigation.php');?>
	<script type="text/javascript">
		document.getElementById('village').setAttribute('class','dropdown active');
		document.getElementById('villageList').setAttribute('class','active');
	</script>
	<table class="table table-hover table-bordered table-responsive">
		<thead>
			<tr>
				<th>小区名字</th>
				<th>省份</th>
				<th>城市</th>
				<th>详细地址</th>
				<th>修改</th>
				<th>注册专员账号</th>
				<th>注册管理员账号</th>
			</tr>
		</thead>
		<tbody>
		<?php
		if(isset($_SESSION['villageInfoList'])&&!empty($_SESSION['villageInfoList'])){
			$villageList = $_SESSION['villageInfoList'];
			foreach ($villageList as $key => $value) {
				echo '<tr>';
					echo '<th>'. $value['name'].'</th>';
					echo '<th>'. $value['province'].'</th>';
					echo '<th>'. $value['city'].'</th>';
					echo '<th>'. $value['address'].'</th>';
					echo '<th>'.'<a href="'.__PUBLIC__.'/view/admin/villageUpdate.php?id='.$value['objectId'].'">修改</a>'.'</th>';
					echo '<th>'.'<a href="'.__PUBLIC__.'/control/assistantControl.php?method=register&id='.$value['objectId'].'">注册专员账号</a>'.'</th>';
					echo '<th>'.'<a href="'.__PUBLIC__.'/control/estateManagerControl.php?method=register&id='.$value['objectId'].'">注册管理员账号</a>'.'</th>';
				echo '</tr>';
			}
		}
		?>
		</tbody>
	</table>
</div>
</body>
</html>