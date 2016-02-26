<?php
	require_once('../estateManager/head.php');
	require ('../../utils/getInformation.php');
	require ('../../utils/function.php');
	if(isset($_GET['houseListPage']))
	{
		$_SESSION['houseListPage']=$_GET['houseListPage'];
	}
	else
		$_SESSION['houseListPage']=0;
	if(!empty($_SESSION['houseListPage'])||$_SESSION['houseListPage']==0)
	{
		HttpClient::init($HttpClient, array('userAgent' => $_SERVER['HTTP_USER_AGENT'], 'redirect' => true));
		$HttpClient->get(__PUBLIC__."/control/manageUserControl.php?getMethod=getInformation&objectId=".$_SESSION['estateManager']['villageId']."&houseListPage=".$_SESSION['houseListPage']*150);
		$json=json_decode($HttpClient->buffer,true);
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>用户列表</title>
	<meta http-equiv="Content-Type" content="text/html;charset=utf-8">
	<meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0,user-scalable=no">
    <link href="http://apps.bdimg.com/libs/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet">
    <script src="http://apps.bdimg.com/libs/jquery/2.0.0/jquery.min.js"></script>
    <script src="http://apps.bdimg.com/libs/bootstrap/3.3.0/js/bootstrap.min.js"></script>
</head>
<body>
	<?php require_once('../estateManager/navigation.php');?>
	<script type="text/javascript">
		document.getElementById('village').setAttribute('class','dropdown active');
		document.getElementById('lookHouse').setAttribute('class','active');
	</script>
	<div class="container">
	<table class="table table-hover table-bordered table-responsive">
		<thead>
			<tr>
				<th>座别</th>
				<th>楼层</th>
				<th>单元</th>
				<th>住户信息</th>
			</tr>
		</thead>
		<tbody>
		<?php
		if(!empty($json))
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

						echo "<td><a href=\"detail.php?getMethod=toDetail&objectId=".$value['objectId']."\">查看住户</a></td>";
						echo "</tr>";
					}
			}
		if(!empty($json))
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
        <li <?php if($_SESSION['houseListPage']==0||empty($_SESSION['houseListPage'])) echo "class=\"active\""; ?>><a href="index.php?houseListPage=0">1</a></li>
        <li <?php if($_SESSION['houseListPage']==1) echo "class=\"active\""; ?>><a href="index.php?houseListPage=1">2</a></li>
        <li <?php if($_SESSION['houseListPage']==2) echo "class=\"active\""; ?>><a href="index.php?houseListPage=2">3</a></li>
        <li <?php if($_SESSION['houseListPage']==3) echo "class=\"active\""; ?>><a href="index.php?houseListPage=3">4</a></li>
        <li <?php if($_SESSION['houseListPage']==4) echo "class=\"active\""; ?>><a href="index.php?houseListPage=4">5</a></li>
        <li <?php if($_SESSION['houseListPage']==5) echo "class=\"active\""; ?>><a href="index.php?houseListPage=5">6</a></li>
        <li <?php if($_SESSION['houseListPage']==6) echo "class=\"active\""; ?>><a href="index.php?houseListPage=6">7</a></li>
        <li <?php if($_SESSION['houseListPage']==7) echo "class=\"active\""; ?>><a href="index.php?houseListPage=7">8</a></li>
        <li <?php if($_SESSION['houseListPage']==8) echo "class=\"active\""; ?>><a href="index.php?houseListPage=8">9</a></li>
        <li <?php if($_SESSION['houseListPage']==9) echo "class=\"active\""; ?>><a href="index.php?houseListPage=9">10</a></li>
        <li <?php if($_SESSION['houseListPage']==10) echo "class=\"active\""; ?>><a href="index.php?houseListPage=10">11</a></li>
        <li <?php if($_SESSION['houseListPage']==11) echo "class=\"active\""; ?>><a href="index.php?houseListPage=11">12</a></li>
        <li <?php if($_SESSION['houseListPage']==12) echo "class=\"active\""; ?>><a href="index.php?houseListPage=12">13</a></li>
        <li <?php if($_SESSION['houseListPage']==13) echo "class=\"active\""; ?>><a href="index.php?houseListPage=13">14</a></li>
        <li <?php if($_SESSION['houseListPage']==14) echo "class=\"active\""; ?>><a href="index.php?houseListPage=14">15</a></li>
    </ul>
	</div>
	
</body>
</html>
