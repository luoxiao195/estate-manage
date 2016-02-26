<?php
require_once('../estateManager/head.php');
$noticeList = $_SESSION['noticeList'];
?>
<!DOCTYPE html>
<html>
<head>
	<title>通知首页</title>
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
	<table class="table table-hover table-bordered table-responsive">
		<thead>
			<tr>
				<th>标题</th>
				<th>时间</th>
				<th>查看内容</th>
			</tr>
		</thead>
		<tbody>
		<?php
		foreach ($noticeList as $key => $value) {
			echo '<tr>'.
					'<th>'.$value['title'].'</th>'.
					'<th>'.substr($value['createdAt'], 0,10).'</th>'.
					'<th><a href="'.__PUBLIC__.'/view/notice/noticeDetail.php?key='.$key.'">查看详情</a></th>'.
			 	 '</tr>';
		}
	
		?>
		</tbody>
	</table>
</div>
</body>
</html>