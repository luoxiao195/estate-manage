<?php
require_once('head.php');
?>
<!DOCTYPE html>
<html>
<head>
	<title>查看小区</title>
	<meta http-equiv="Content-Type" content="text/html;charset=utf-8">
	<meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0,user-scalable=no">
    <link href="http://apps.bdimg.com/libs/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet">
    <script src="http://apps.bdimg.com/libs/jquery/2.0.0/jquery.min.js"></script>
    <script src="http://apps.bdimg.com/libs/bootstrap/3.3.0/js/bootstrap.min.js"></script>
</head>
<body>
	<div class='container'>
	<?php require_once('navigation.php');?>
	<table class="table table-hover table-bordered table-responsive">
		<thead>
			<tr>
				<th>小区名字</th>
				<th>省份</th>
				<th>城市</th>
				<th>详细地址</th>
			</tr>
		</thead>
		<tbody>
		<?php
			if(isset($_SESSION['villageInfo'])){
				$villageInfo = $_SESSION['villageInfo'];
				echo '<tr>'.
  						'<td>'.$villageInfo['name'].'</td>'.
  						'<td>'.$villageInfo['province'].'</td>'.
  						'<td>'.$villageInfo['city'].'</td>'.
    					'<td>'.$villageInfo['address'].'</td>'.
    				 '</tr>';
				
			}
		?>
		</tbody>
	</table>
</div>
</body>
</html>