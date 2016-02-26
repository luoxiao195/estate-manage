<?php
require_once('../estateManager/head.php');
$key = $_GET['key'];

$noticeList = $_SESSION['noticeList'];
?>
<!DOCTYPE html>
<html>
<head>
	<title>详细通知</title>
	<meta http-equiv="Content-Type" content="text/html;charset=utf-8">
	<meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0,user-scalable=no">
    <link href="http://apps.bdimg.com/libs/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet">
    <script src="http://apps.bdimg.com/libs/jquery/2.0.0/jquery.min.js"></script>
    <script src="http://apps.bdimg.com/libs/bootstrap/3.3.0/js/bootstrap.min.js"></script>
</head>
<body>
<?php require_once('../estateManager/navigation.php');?>
<script type="text/javascript">
	document.getElementById('notice').setAttribute('class','dropdown active');
	document.getElementById('lookNotice').setAttribute('class','active');
</script>
<div class="container">
	<div align="center">
		<h1><?php echo $noticeList[$key]['title'];?></h1>
	</div>
	<div align="right">
		<h4><?php echo substr($noticeList[$key]['createdAt'],0,10); ?></h4>
	</div>
	<div>
		<?php echo $noticeList[$key]['content'];?>
	</div>
</div>
</body>
</html>