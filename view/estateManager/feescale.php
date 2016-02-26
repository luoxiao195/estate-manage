<?php
require_once('../estateManager/head.php');
?>
<!DOCTYPE html>
<html>
<head>
	<title>收费标准</title>
	<meta http-equiv="Content-Type" content="text/html;charset=utf-8">
	<meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0,user-scalable=no">
    <link href="http://apps.bdimg.com/libs/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet">
    <script src="http://apps.bdimg.com/libs/jquery/2.0.0/jquery.min.js"></script>
    <script src="http://apps.bdimg.com/libs/bootstrap/3.3.0/js/bootstrap.min.js"></script>
    <script type="text/javascript">
    	function water(){
    		document.getElementById('name').innerText = '水费';
    		document.getElementById('unit').innerText = "/吨";
    		document.getElementById('form').setAttribute('action','/control/estateManagerControl.php?method=waterPrice');
    		document.getElementById('waterPrice').setAttribute('class','active');
    		document.getElementById('powerPrice').setAttribute('class','');
    		
    	}
    	function power(){
    		document.getElementById('name').innerText = "电费";
    		document.getElementById('unit').innerText = "/度";
    		document.getElementById('form').setAttribute('action','/control/estateManagerControl.php?method=powerPrice');
    		document.getElementById('waterPrice').setAttribute('class','');
    		document.getElementById('powerPrice').setAttribute('class','active');
    	}
    	
    </script>
</head>
<body onload="water()">
<?php
require_once('navigation.php');
?>
<script type="text/javascript">
	document.getElementById('estateManager').setAttribute('class','navbar-right dropdown active');
	document.getElementById('feescale').setAttribute('class','active');
</script>
<div class="container">
<div class="col-sm-3">
	<ul class="nav nav-pills nav-stacked">
		<li id="waterPrice"><a onclick="water()">水费设置</a></li>
		<li id="powerPrice"><a onclick="power()">电费设置</a></li>
	</ul>
</div>
<div class="col-sm-6">
	<div align="center" class="col-sm-8">
	<form class="form-horizontal" role="form" method="post" id="form">
		<div class="row form-group">
			<label for="fee" class="col-sm-6 control-label" id="name"></label>
			<div class="col-sm-6 input-group">
				<input type="text" class="form-control" name="fee" id="fee">
				<span class="input-group-addon" id="unit"></span>
			</div>
			
		</div>
		<div class="form-group">
			<div class="col-sm-offset-6 col-sm-6">
				<button type="submit" class="btn btn-primary">确定</button>
			</div>
		</div>
	</form>
</div>
<div>
	
</div>
</div>
</body>
</html>