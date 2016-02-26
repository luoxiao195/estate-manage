<?php
	require_once('../estateManager/head.php');
	require ('../../utils/getInformation.php');
	require ('../../utils/function.php');
	if(isset($_GET['parkingListPage']))
		$_SESSION['parkingListPage']=$_GET['parkingListPage'];
	else
		$_SESSION['parkingListPage']=0;
	HttpClient::init($HttpClient, array('userAgent' => $_SERVER['HTTP_USER_AGENT'], 'redirect' => true));
	$HttpClient->get(__PUBLIC__."/control/manageParkingControl.php?getMethod=getInformation&objectId=".$_SESSION['estateManager']['villageId']."&parkingListPage=".$_SESSION['parkingListPage']*150);
	$json=json_decode($HttpClient->buffer,true);
?>
<!DOCTYPE html>
<html>
<head>
	<title>停车位列表</title>
	<meta http-equiv="Content-Type" content="text/html;charset=utf-8">
	<meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0,user-scalable=no">
    <link href="http://apps.bdimg.com/libs/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet">
    <script src="http://apps.bdimg.com/libs/jquery/2.0.0/jquery.min.js"></script>
    <script src="http://apps.bdimg.com/libs/bootstrap/3.3.0/js/bootstrap.min.js"></script>
</head>
<body>
	<?php require_once('../estateManager/navigation.php');?>
	<script type="text/javascript">
		document.getElementById('parking').setAttribute('class','dropdown active');
		document.getElementById('lookParking').setAttribute('class','active');
	</script>
	<div class="container">
	<table class="table table-hover table-bordered table-responsive">
		<thead>
			<tr>
				<th>座别</th>
				<th>楼层</th>
				<th>单元</th>
				<th>用户信息</th>
			</tr>
		</thead>
		<tbody>
		<?php
			foreach ($json as $key => $value) {
				if(!empty($value['user']))
					{
						echo "<tr>";
						if(empty($value['building']))
							echo "<td>未知</td>";
						else
							echo "<td>".$value['building']."</td>";
						if(empty($value['floor']))
							echo "<td>未知</td>";
						else
							echo "<td>".$value['floor']."</td>";
						if(empty($value['unit']))
							echo "<td>未知</td>";
						else
							echo "<td>".$value['unit']."</td>";

						echo "<td><a href=\"detail.php?getMethod=toDetail&objectId=".$value['objectId']."\">查看用户</a></td>";
						echo "</tr>";
					}
			}
			foreach ($json as $key => $value) {
				if(empty($value['user']))
					{
						echo "<tr>";
						if(empty($value['building']))
							echo "<td>未知</td>";
						else
							echo "<td>".$value['building']."</td>";
						if(empty($value['floor']))
							echo "<td>未知</td>";
						else
							echo "<td>".$value['floor']."</td>";
						if(empty($value['unit']))
							echo "<td>未知</td>";
						else
							echo "<td>".$value['unit']."</td>";

						echo "<td>尚未绑定用户</td>";
						echo "</tr>";
					}
			}
		?>
		</tbody>
	</table>
	<ul class="pagination">
        <li <?php if($_SESSION['parkingListPage']==0||empty($_SESSION['parkingListPage'])) echo "class=\"active\""; ?>><a href="index.php?parkingListPage=0">1</a></li>
        <li <?php if($_SESSION['parkingListPage']==1) echo "class=\"active\""; ?>><a href="index.php?parkingListPage=1">2</a></li>
        <li <?php if($_SESSION['parkingListPage']==2) echo "class=\"active\""; ?>><a href="index.php?parkingListPage=2">3</a></li>
        <li <?php if($_SESSION['parkingListPage']==3) echo "class=\"active\""; ?>><a href="index.php?parkingListPage=3">4</a></li>
        <li <?php if($_SESSION['parkingListPage']==4) echo "class=\"active\""; ?>><a href="index.php?parkingListPage=4">5</a></li>
        <li <?php if($_SESSION['parkingListPage']==5) echo "class=\"active\""; ?>><a href="index.php?parkingListPage=5">6</a></li>
        <li <?php if($_SESSION['parkingListPage']==6) echo "class=\"active\""; ?>><a href="index.php?parkingListPage=6">7</a></li>
        <li <?php if($_SESSION['parkingListPage']==7) echo "class=\"active\""; ?>><a href="index.php?parkingListPage=7">8</a></li>
        <li <?php if($_SESSION['parkingListPage']==8) echo "class=\"active\""; ?>><a href="index.php?parkingListPage=8">9</a></li>
        <li <?php if($_SESSION['parkingListPage']==9) echo "class=\"active\""; ?>><a href="index.php?parkingListPage=9">10</a></li>
        <li <?php if($_SESSION['parkingListPage']==10) echo "class=\"active\""; ?>><a href="index.php?parkingListPage=10">11</a></li>
        <li <?php if($_SESSION['parkingListPage']==11) echo "class=\"active\""; ?>><a href="index.php?parkingListPage=11">12</a></li>
        <li <?php if($_SESSION['parkingListPage']==12) echo "class=\"active\""; ?>><a href="index.php?parkingListPage=12">13</a></li>
        <li <?php if($_SESSION['parkingListPage']==13) echo "class=\"active\""; ?>><a href="index.php?parkingListPage=13">14</a></li>
        <li <?php if($_SESSION['parkingListPage']==14) echo "class=\"active\""; ?>><a href="index.php?parkingListPage=14">15</a></li>
    </ul>
	</div>
</body>
</html>
