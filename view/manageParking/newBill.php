<?php
	require_once('../../utils/getInformation.php');
	require_once('../estateManager/head.php');
	if(isset($_GET['objectId']))
		$_SESSION['objectId']=$_GET['objectId'];
	if(isset($_SESSION['objectId']))
	{
		HttpClient::init($HttpClient, array('userAgent' => $_SERVER['HTTP_USER_AGENT'], 'redirect' => true));
		$HttpClient->get(__PUBLIC__."/control/billControl.php?method=getToParking&objectId=".$_SESSION['objectId']);
		$json=json_decode($HttpClient->buffer,true);
	}
	
	
?>
<!DOCTYPE html>
<html>
<head>
	<title>当月停车位账单</title>
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
	document.getElementById('parking').setAttribute('class','dropdown active');
	document.getElementById('lookParking').setAttribute('class','active');
	document.getElementById('newBill').setAttribute('class','active');
</script>

<div class="col-sm-7">
	<div align="center">
		<h3>当月账单</h3>
	</div>
<table class="table table-hover table-bordered table-responsive">
<thead>
	<tr>

	<th>类型</th>
	<th>用量</th>
	<th>单价</th>
	<th>总额</th>
	
	</tr>
</thead>
<tbody>
<?php
$sum=0;
	if(!empty($json['parking']))
	foreach ($json['parking'] as $key => $value) {
		echo '<tr>';
		echo "<td>".$value['type']."</td>";
		echo "<td>".$value['usage']."</td>";
		echo "<td>".$value['price']."</td>";
		echo "<td>".$value['total']."</td>";
		echo '</tr>';
		$sum+=$value['total'];
	}
	echo '<tr>'.
			'<td>总价</td>'.
			'<td colspan=3 align="center">'.$sum.'</td>'.
		 '</tr>';
?>
</tbody>
</table>
<div class="alert alert-info" align="center">
<a role="button" <?php echo "href=\"../../control/billControl.php?method=showParkingBill&parkingId=".$_SESSION['objectId']."\"";?>>点击查看详细账单</a>
</div>
</div>
</div>
</body>
</html>