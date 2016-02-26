<?php
require_once('../estateManager/head.php');
require_once('../../utils/getInformation.php');
header('Cache-control: private, must-revalidate'); 
if(isset($_GET['billListPage']))
	$_SESSION['billListPage']=$_GET['billListPage'];
else
	$_SESSION['billListPage']=0;
if(!empty($_POST['searchBui'])) $building=$_POST['searchBui'];
else $building="unset";

if(!empty($_POST['searchFlo'])) $floor=$_POST['searchFlo'];
else $floor="unset";

if(!empty($_POST['searchUni'])) $unit=$_POST['searchUni'];
else $unit="unset";

HttpClient::init($HttpClient, array('userAgent' => $_SERVER['HTTP_USER_AGENT'], 'redirect' => true));
$HttpClient->get(__PUBLIC__."/control/billControl.php?method=search&building=".$building."&floor=".$floor."&unit=".$unit."&villageId=".$_SESSION['estateManager']['villageId']."&billListPage=".$_SESSION['billListPage']*100);
$json=json_decode($HttpClient->buffer,true);
?>
<!DOCTYPE html>
<html>
<head>
	<title>账单查询</title>
	<meta http-equiv="Content-Type" content="text/html;charset=utf-8">
	<meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0,user-scalable=no">
    <link href="http://apps.bdimg.com/libs/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet">
    <script src="http://apps.bdimg.com/libs/jquery/2.0.0/jquery.min.js"></script>
    <script src="http://apps.bdimg.com/libs/bootstrap/3.3.0/js/bootstrap.min.js"></script>
</head>
<body>
	<?php require_once('../estateManager/navigation.php');
	?>
	<script type="text/javascript">
		document.getElementById('bill').setAttribute('class','active');
	</script>
	<div class="container">
	<div align="center">
	<form role="form" method="POST" action=<?php echo __PUBLIC__.'/view/bill/search.php';?>>
		<div class="input-group col-sm-6">
         <input type="text" class="form-control" name="searchBui">
         <span class="input-group-addon">栋</span>
         <input type="text" class="form-control" name="searchFlo">
         <span class="input-group-addon">层</span>
         <input type="text" class="form-control" name="searchUni">
         <span class="input-group-addon" >单元</span>
            <span class="input-group-btn">
          	    <button class="btn btn-primary" type="submit" name="findUser">
                    搜索
                </button>
            </span>
          </div>
	</form>
	</div>
	<hr>
	
	<table class="table table-hover table-bordered table-responsive">
		<thead>
			<tr>
				<th>座别</th>
				<th>楼层</th>
				<th>单元</th>
				<th>类型</th>
				<th>查看账单</th>
				
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
	<ul class="pagination">
        <li <?php if($_SESSION['billListPage']==0||empty($_SESSION['billListPage'])) echo "class=\"active\""; ?>><a href="search.php?billListPage=0">1</a></li>
        <li <?php if($_SESSION['billListPage']==1) echo "class=\"active\""; ?>><a href="search.php?billListPage=1">2</a></li>
        <li <?php if($_SESSION['billListPage']==2) echo "class=\"active\""; ?>><a href="search.php?billListPage=2">3</a></li>
        <li <?php if($_SESSION['billListPage']==3) echo "class=\"active\""; ?>><a href="search.php?billListPage=3">4</a></li>
        <li <?php if($_SESSION['billListPage']==4) echo "class=\"active\""; ?>><a href="search.php?billListPage=4">5</a></li>
        <li <?php if($_SESSION['billListPage']==5) echo "class=\"active\""; ?>><a href="search.php?billListPage=5">6</a></li>
        <li <?php if($_SESSION['billListPage']==6) echo "class=\"active\""; ?>><a href="search.php?billListPage=6">7</a></li>
        <li <?php if($_SESSION['billListPage']==7) echo "class=\"active\""; ?>><a href="search.php?billListPage=7">8</a></li>
        <li <?php if($_SESSION['billListPage']==8) echo "class=\"active\""; ?>><a href="search.php?billListPage=8">9</a></li>
        <li <?php if($_SESSION['billListPage']==9) echo "class=\"active\""; ?>><a href="search.php?billListPage=9">10</a></li>
        <li <?php if($_SESSION['billListPage']==10) echo "class=\"active\""; ?>><a href="search.php?billListPage=10">11</a></li>
        <li <?php if($_SESSION['billListPage']==11) echo "class=\"active\""; ?>><a href="search.php?billListPage=11">12</a></li>
        <li <?php if($_SESSION['billListPage']==12) echo "class=\"active\""; ?>><a href="search.php?billListPage=11">13</a></li>
        <li <?php if($_SESSION['billListPage']==13) echo "class=\"active\""; ?>><a href="search.php?billListPage=11">14</a></li>
        <li <?php if($_SESSION['billListPage']==14) echo "class=\"active\""; ?>><a href="search.php?billListPage=11">15</a></li>
    </ul>
	</div>
</body>
</html>