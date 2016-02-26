<?php
require_once('../estateManager/head.php');
?>
<!DOCTYPE html>
<html>
<head>
	<title>编辑通知</title>
	<meta http-equiv="Content-Type" content="text/html;charset=utf-8">
	<meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0,user-scalable=no">
    <link href="http://apps.bdimg.com/libs/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet">
    <script src="http://apps.bdimg.com/libs/jquery/2.0.0/jquery.min.js"></script>
    <script src="http://apps.bdimg.com/libs/bootstrap/3.3.0/js/bootstrap.min.js"></script>

    <link rel="stylesheet" type="text/css" href='/styles/simditor.css'/>

	<script type="text/javascript" src='/scripts/jquery.min.js'></script>
	<script type="text/javascript">
		function filter() {
			var img = document.getElementsByTagName("img");
			for(i=0;i<img.length;i++){
				$(img[i]).removeAttr("width");
				$(img[i]).removeAttr("height");
			}
		};
	</script>
</head>
<body>
<?php require_once('../estateManager/navigation.php');?>
<script type="text/javascript">
	document.getElementById('notice').setAttribute('class','dropdown active');
	document.getElementById('addNotice').setAttribute('class','active');
</script>
	<form class="form-horizontal" role="form" method="post" action=<?php echo __PUBLIC__.'/control/noticeControl.php?method=add'?>>
		<div class="row form-group" align="center">
			<label for="title" class="col-sm-3 control-label">标题</label>
			<div class="col-sm-6">
				<input type="text" class="form-control" name="title">
			</div>
		</div>

		<div class="row form-group">
			<div class="col-sm-3"></div>
			<div class="col-sm-6">
			<textarea class="form-control" id="mycontent" name="mycontent" placeholder="这里输入内容" autofocus></textarea>
			<script type="text/javascript" src='/scripts/module.js'></script>
			<script type="text/javascript" src='/scripts/hotkeys.js'></script>
			<script type="text/javascript" src='/scripts/uploader.js'></script>
			<script type="text/javascript" src='/scripts/simditor.js'></script>
			<script type="text/javascript">
				var editor = new Simditor({
					textarea: $('#mycontent'),
					toolbar: ['title','bold','italic','underline','strikethrough','color','ol','ul','link','image','hr','indent','outdent','alignment'],
					upload : {
            				   url : '../../control/uploadControl.php',
            				   params: null,
            				   fileKey: 'upload_file',
            				   connectionCount: 3,
            				   leaveConfirm: '正在上传文件'
        					 }
				});
				
			</script>
			</div>
		</div>
		<div class="form-group">
			<div class="col-sm-offset-3 col-sm-6" align="center">
				<button type="submit" class="btn btn-primary" onclick="filter()">发布</button>
			</div>
		</div>
	</form>
</body>
</html>