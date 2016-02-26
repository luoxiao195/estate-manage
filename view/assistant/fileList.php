<?php
require_once('head.php');
$fileList = $_SESSION['fileList'];
?>
<!DOCTYPE html>
<html>
<head>
	<title>用户资料下载</title>
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
		document.getElementById('user').setAttribute('class','dropdown active');
		document.getElementById('userFile').setAttribute('class','active');
	</script>
	<div class="container">
		<table class="table table-hover table-bordered table-responsive">
			<thead>
				<tr>
					<th>文件名</th>
					<th>下载</th>
				</tr>
			</thead>
			<tbody>
				<?php 
					foreach ($fileList as $key => $value) {
						echo "<tr>".
								"<th>".$value['name']."</th>".
								"<th><a href=".$value['url'].">下载</a></th>".
						   	"</tr>";
					}
					
				?>
			</tbody>
		</table>
	</div>
</div>
</body>
</html>