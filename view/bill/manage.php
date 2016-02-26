<?php
require_once('../estateManager/head.php');
require_once('../../utils/getInformation.php');
header('Cache-control: private, must-revalidate'); 
if(isset($_POST['searchBui'])||isset($_POST['searchFlo'])||isset($_POST['searchUni']))
{
	if(!empty($_POST['searchBui'])) $building=$_POST['searchBui'];
	else $building="unset";
	if(!empty($_POST['searchFlo'])) $floor=$_POST['searchFlo'];
	else $floor="unset";
	if(!empty($_POST['searchUni'])) $unit=$_POST['searchUni'];
	else $unit="unset";
	HttpClient::init($HttpClient, array('userAgent' => $_SERVER['HTTP_USER_AGENT'], 'redirect' => true));
	$HttpClient->get(__PUBLIC__."/control/billControl.php?method=search&building=".$building."&floor=".$floor."&unit=".$unit."&villageId=".$_SESSION['estateManager']['villageId']);
	$json=json_decode($HttpClient->buffer,true);
	
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>尚未推送的账单</title>
	<meta http-equiv="Content-Type" content="text/html;charset=utf-8">
	<meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0,user-scalable=no">
    <link href="http://apps.bdimg.com/libs/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet">
    <script src="http://apps.bdimg.com/libs/jquery/2.0.0/jquery.min.js"></script>
    <script src="http://apps.bdimg.com/libs/bootstrap/3.3.0/js/bootstrap.min.js"></script>
</head>
<body>
	<?php require_once('../estateManager/navigation.php');
	?>

	
	
	<table class="table table-hover table-bordered table-responsive">
		<thead>
			<tr>
				<th>用户名</th>
				<th>地址</th>
				<th>类型</th>
				<th>用量</th>
				<th>单价</th>
				<th>总额</th>
				<th>删除</th>
				<th>推送</th>
				
			</tr>
		</thead>
		<tbody>
			<?php
			if(!empty($json))
			{
				foreach ($json['house'] as $key => $value) {
					//if(!empty($value['user']))
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

						echo "<td>房屋</td>";
						echo "<td><a href=\"../../control/billControl.php?method=showUserBill&houseId=".$value['objectId']."\">查看账单</a></td>";
						echo "</tr>";
					}
					
				}
				foreach ($json['parking'] as $key => $value) {
					//if(!empty($value['user']))
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
						echo "<td>停车位</td>";
						
						echo "<td><a href=\"../../control/billControl.php?method=showParkingBill&parkingId=".$value['objectId']."\">查看账单</a></td>";
						echo "</tr>";
					}
					
				}
			}
			
		?>
		</tbody>
	</table>
	</div>
	<hr>
	<h3 align='right' style="margin-top:4px;margin-left:4px;margin-right:60px;margin-bottom:4px;"><a href="#" >一键全部推送</a></h3>
</body>
</html>