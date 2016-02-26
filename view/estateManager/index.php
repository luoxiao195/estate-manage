<?php
	require_once('head.php');
	$estateManager = $_SESSION['estateManager'];
?>
<!DOCTYPE html>
<html>
<head>
	<title>物业管理后台</title>
	<meta http-equiv="Content-Type" content="text/html;charset=utf-8">
	<meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0,user-scalable=no">
    <link href="http://apps.bdimg.com/libs/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet">
    <script src="http://apps.bdimg.com/libs/jquery/2.0.0/jquery.min.js"></script>
    <script src="http://apps.bdimg.com/libs/bootstrap/3.3.0/js/bootstrap.min.js"></script>
    
</head>
<body>
<div class="container">
<?php require_once('navigation.php');?>
<script type="text/javascript">
   	document.getElementById('index').setAttribute('class','active');
</script>
<p>
	<h1><?php echo $estateManager['name']?></h1>
</p>
<p>
	<h3><?php echo $estateManager['province'];?></h3>	
</p>
<p>
	<h3><?php echo $estateManager['city'];?></h3>
</p>	
<p>
	<h3><?php echo $estateManager['address'];?></h3>
</p>	
</div>
</body>
</html>