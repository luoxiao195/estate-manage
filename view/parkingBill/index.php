<?php
	require_once('../../utils/getInformation.php');
	require_once('../estateManager/head.php');
	if(!empty($_GET['parkingId']))
		$_SESSION['parkingId']=$_GET['parkingId'];
	if(isset($_SESSION['parkingId']))
	{
		HttpClient::init($HttpClient, array('userAgent' => $_SERVER['HTTP_USER_AGENT'], 'redirect' => true));
		$HttpClient->get(__PUBLIC__."/control/billControl.php?method=getParkingBill&objectId=".$_SESSION['parkingId']);
		$json=json_decode($HttpClient->buffer,true);
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<title>用户账单</title>
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
		document.getElementById("bill").setAttribute("class","active");
		document.getElementById("newBill").setAttribute("class","active");
	</script>
	<div align="center" class="col-sm-5">
	
	<?php 
		if(isset($json))
		{	
			$year=date('Y');
			$month=date('m');
			if($month[0]=='0')
				$month=$month[1];
				
			$sum=0;
			echo "<h1>".$year."年  ".$month."月</h1>";
			echo "<table class='table table-hover table-bordered table-responsive'>
					<thead>
					<tr>
						<th>类型</th>
						<th>用量</th>
						<th>单价</th>
						<th>总额</th>
						<th>推送</th>
						<th>删除</th>";
			echo	"</tr></thead>";
			echo "<tbody>";
			if(!empty($json['parking']))
				foreach($json['parking'] as $key=>$value)
				{
					echo "<tr>";
					echo "<td>".$value['type']."</td>";
					echo "<td>".$value['usage']."</td>";
					echo "<td>".$value['price']."</td>";
					echo "<td>".$value['total']."</td>";
					if($value['visible'])
					{
						echo "<td>已推送</td>";
					}
					else
						echo "<td><a href=\"../../control/billControl.php?method=parkingVisible&billId=".$value['objectId']."\">推送</a></td>";
					echo "<td><a href=\"../../control/billControl.php?method=deleteParkingBill&billId=".$value['objectId']."\">删除</a></td>";
					echo "</tr>";
					$sum+=$value['total'];
				}
			echo "</tbody>";
			echo "</table>";
			echo "<h4 align='right' style=\"margin-top:4px;margin-left:4px;margin-right:60px;margin-bottom:4px;\"><a href=\"../../control/billControl.php?method=allPassParking&parkingId=".$_SESSION['parkingId']."\" >一键全部推送</a></h4>";
			echo "<h3>总价:".$sum."</h3>";
		}
	?>
	</div>
	<div class="container col-sm-4">
		<div class="jumbotron">
			<h3>用户</h3>
				<?php 
				if(empty($json['userInfo']['name']))
					echo "尚未绑定用户";
				else
					echo $json['userInfo']['name'];?>
			<h3>联系电话</h3>
				<?php 
				if(!empty($json['userInfo']['name']))
					echo $json['userInfo']['mobilePhoneNumber'];?>
			<h3>房屋地址</h3>
				<?php 
				echo $json['parkingInfo'][0]['building']."座 ".$json['parkingInfo'][0]['floor']."层 ".$json['parkingInfo'][0]['unit']."单元";

				?>
		</div>
	</div>
		
	</div>
	</body>
</html>