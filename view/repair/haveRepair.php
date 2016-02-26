<?php
require_once('../estateManager/head.php');
$haveRepair = $_SESSION['haveRepair'];
?>
<!DOCTYPE html>
<html>
<head>
	<title>已维修</title>
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
	document.getElementById('repair').setAttribute('class','active');
	document.getElementById('have').setAttribute('class','active');
</script>
<div class="col-sm-6" align="center">
	<table class="table table-hover table-bordered table-responsive">
		<thead>
			<tr>
				<th>房屋地址</th>
				<th>内容</th>
				<th>时间</th>
				<th>查看详情</th>
			</tr>
		</thead>
		<tbody>
		<?php
			foreach ($haveRepair as $key => $value) {
				echo '<tr>'.
						'<td>'.$value['address'].'</td>'.
						'<td>'.$value['content'].'</td>'.
						'<td>'.substr($value['createdAt'],0,10).'</td>'.
						'<td><a href='.__PUBLIC__.'/view/repair/detail.php?type=haveRepair&key='.$key.'>查看详情</a></td>'.
					 '</tr>';
			}
		?>
		</tbody>
	</table>
</div>
</div>
</body>
</html>