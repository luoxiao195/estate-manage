<?php
require_once('head.php');
require_once('../../utils/getInformation.php');
HttpClient::init($HttpClient, array('userAgent' => $_SERVER['HTTP_USER_AGENT'], 'redirect' => true));
$HttpClient->get(__PUBLIC__."/control/estateManagerControl.php?method=getFiles&villageId=".$_SESSION['estateManager']['villageId']);
$json=json_decode($HttpClient->buffer,true); 
?>
<html>
<head>
	<title>上传资料</title>
	<meta http-equiv="Content-Type" content="text/html;charset=utf-8">
	<meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0,user-scalable=no">
    <link href="http://apps.bdimg.com/libs/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet">
    <script src="http://apps.bdimg.com/libs/jquery/2.0.0/jquery.min.js"></script>
    <script src="http://apps.bdimg.com/libs/bootstrap/3.3.0/js/bootstrap.min.js"></script>
</head>
<body>
<?php
require_once('navigation.php');
?>
<script type="text/javascript">
	document.getElementById('estateManager').setAttribute('class','navbar-right dropdown active');
	document.getElementById('upload').setAttribute('class','active');
</script>
<div class="container" align="center">
<form action=<?php echo __PUBLIC__."/control/uploadFileControl.php";?> method="post" enctype="multipart/form-data" role="form">
<div class="row form-group">
	<label for="file" class="control-label">文件</label>
	<div class="input-group">
		<input type="file" name="file" id="file" class="form-control" /> 
	</div>
</div>
<div class="form-group">
	<div class="col-sm-offset-6 col-sm-6">
		<button type="submit" class="btn btn-primary">确定</button>
	</div>
</div>
</form>

<HR style="FILTER: alpha(opacity=100,finishopacity=0,style=3)" width="80%" color=#987cb9 SIZE=3>
<h3>已上传文件</h3>
	<div class="container">
		<table class="table table-hover table-bordered table-responsive">
			<thead>
				<tr>
					<th>文件名</th>
					<th>删除</th>
				</tr>
			</thead>
			<tbody>
				<?php 
					if(!empty($json))
					{
						foreach ($json as $key => $value) {
							echo "<tr>";
								echo "<td>".$value['name']."</td>";
								echo "<td><a href=\"".__PUBLIC__."/control/estateManagerControl.php?method=deleteFile&fileId=".$value['objectId']."\">删除</a></td>";
							echo "</tr>";
						}
					}
				?>
			</tbody>
		</table>
	</div>

</div>
</body>
</html>