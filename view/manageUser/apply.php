<?php
require_once('../estateManager/head.php');
require ('../../utils/getInformation.php');
require ('../../utils/function.php');
HttpClient::init($HttpClient, array('userAgent' => $_SERVER['HTTP_USER_AGENT'], 'redirect' => true));
$HttpClient->get(__PUBLIC__."/control/manageUserControl.php?getMethod=getInformationApply&objectId=".$_SESSION['estateManager']['villageId']);
$json=json_decode($HttpClient->buffer,true);
?>
<!DOCTYPE html>
<html>
<head>
	<title>申请名单</title>
	<meta http-equiv="Content-Type" content="text/html;charset=utf-8">
	<meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0,user-scalable=no">
    <link href="http://apps.bdimg.com/libs/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet">
    <script src="http://apps.bdimg.com/libs/jquery/2.0.0/jquery.min.js"></script>
    <script src="http://apps.bdimg.com/libs/bootstrap/3.3.0/js/bootstrap.min.js"></script>
</head>
<body>
	<?php require_once('../estateManager/navigation.php');?>
	<script type="text/javascript">
		document.getElementById('user').setAttribute('class','dropdown active');
		document.getElementById('userApply').setAttribute('class','active');
	</script>

	<table class="table table-hover table-bordered table-responsive">
		<thead>
			<tr>
				<th>用户姓名</th>
				<th>性别</th>
				<th>联系电话</th>
				<th>座别</th>
				<th>楼层</th>
				<th>单元</th>
				<th>通过</th>
				<th>拒绝</th>
			</tr>
		</thead>
		<tbody>
		<?php
		foreach ($json as $key => $value) {
			if(($value['isConfirm'])&&!$value['isConfirm'])
			{
				echo "<tr>";
				echo "<td>".$value['name']."</td>";
				if($value['gender']==0)
						echo "<td>未知</td>";
					else if($value['gender']==0)
						echo "<td>男</td>";
					else
						echo "<td>女</td>";
				echo "<td>".ifExit($value['mobilePhoneNumber'])."</td>";
				echo "<td>".ifExit($value['building'])."</td>";
				echo "<td>".ifExit($value['floor'])."</td>";
				echo "<td>".ifExit($value['unit'])."</td>";
				echo "<td><a href=\"../../control/manageUserControl.php?getMethod=getConfirm&isPass=true&objectId=".$value['objectId']."\">通过</a></td>";
				echo "<td><a href=\"../../control/manageUserControl.php?getMethod=getConfirm&isPass=false&objectId=".$value['objectId']."\">拒绝</a></td>";
				echo "</tr>";
			}
		}
	?>
		</tbody>
	</table>
</body>
</html>