<?php
require_once('../estateManager/head.php');
$key = $_GET['key'];
$type = $_GET['type'];
?>
<!DOCTYPE html>
<html>
<head>
	<title>维修信息</title>
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
	<?php 
	if($type =='waitRepair')
		echo "document.getElementById('wait').setAttribute('class','active')";
	else
		echo "document.getElementById('have').setAttribute('class','active')";
	?>
</script>
<div class="col-sm-9">
	<table class='table table-hover table-bordered table-responsive'>
		<tbody>
			<tr>
				<td>内容</td>
				<td><?php echo $_SESSION[$type][$key]['content'];?></td>
			</tr>
			<tr>
				<td>图片</td>
				<td>
				<?php
					if(!empty($_SESSION[$type][$key]['urls'])){
						$number = count($_SESSION[$type][$key]['urls']);
						$scale = 90/$number;
						foreach ($_SESSION[$type][$key]['urls'] as $value) {
							echo '<img width='.$scale.'% hspace="5" vspace="5" src=http://'.$value.' class="img-rounded"/>';
						}
					}
				?>
				</td>
			</tr>
		</tbody>
	</table>
	<?php
		if($type == 'waitRepair'){
	?>
	<hr>
	<div align="center">
	<a class="btn btn-primary" href=<?php echo __PUBLIC__.'/control/repairControl.php?method=pass&id='.$_SESSION[$type][$key]['objectId'];?>>已受理</a>
	</div>
	<?php }?>
</div>
</div>
</body>
</html>