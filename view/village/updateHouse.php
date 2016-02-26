<?php
require_once('../estateManager/head.php');
?>
<!DOCTYPE html>
<html>
<head>
	<title>房屋修改</title>
	<meta http-equiv="Content-Type" content="text/html;charset=utf-8">
	<meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0,user-scalable=no">
 	<link href="http://apps.bdimg.com/libs/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet">
  	<script src="http://apps.bdimg.com/libs/jquery/2.0.0/jquery.min.js"></script>
  	<script src="http://apps.bdimg.com/libs/bootstrap/3.3.0/js/bootstrap.min.js"></script>
  	<script type="text/javascript">
  		function getBuilding(){
  			$("#content").empty();
  			var building = $("#building").val();
  			var floor = $("#floor").val();
  			var unit = $("#unit").val();
  			var url = '<?php echo __PUBLIC__."/control/villageControl.php?method=getBuilding";?>';
  			if(building!=""){
  				url+=("&building="+building);
  			}
  			if(floor!=""){
  				url+=("&floor="+floor);
  			}
  			if(unit!=""){
  				url+=("&unit="+unit);
  			}
  			$.ajax({
  				type:"GET",
  				url:url,
  				dataType:"json",
  				success:function(data){
  					if(!$.isEmptyObject(data)){
  						$("#content").append('<thead><tr><th>栋</th><th>楼层</th><th>单元</th><th>修改</th><th>删除</th></tr></thead><tbody id="tableBody"></tbody>')
  					}
  					else{
  						alert("查找无结果");
  					}
  					$.each(data,function(i,n){
  						$("#tableBody").append("<tr id="+n["objectId"]+"><th>"+n["building"]+"</th><th>"+n["floor"]+"</th><th>"+n["unit"]+"</th><th><a href='#' data-toggle='modal' data-target='#myModal' onclick='toModal(\""+n["objectId"]+"\",\""+n["building"]+"\",\""+n["floor"]+"\",\""+n["unit"]+"\")'>修改</a></th><th><a href='#' onclick='deleteHouse(\""+n["objectId"]+"\")'>删除</a></th></tr>");
  					  
            });

  				}
  			});
  			return false;
  		};
  		function deleteHouse(objectId){
  			var url = '<?php echo __PUBLIC__."/control/villageControl.php?method=deleteHouse&id=";?>'+objectId;
  			$.ajax({
  				type:"GET",
  				url:url,
  				dataType:"json",
  				success:function(data){
  					
  					$(document.getElementById(objectId)).remove();
  				}
  			});
  			return false;
  		};
      function toModal(objectId,building,floor,unit){
        $("#objId").attr("value",objectId);
        $("#updateBuilding").attr("value",building);
        $("#updateFloor").attr("value",floor);
        $("#updateUnit").attr("value",unit);
      };
      function updateHouse(){
        var objectId = $("#objId").val();
        var building = $("#updateBuilding").val();
        var floor = $("#updateFloor").val();
        var unit = $("#updateUnit").val();
        if(building==""||floor==""||unit==""){
          alert("输入值不能为空");
          return false;
        }
        $.ajax({
          type:"GET",
          url: '<?php echo __PUBLIC__."/control/villageControl.php?method=updateHouse&id=";?>'+objectId+"&building="+building+"&floor="+floor+"&unit="+unit,
          dataType:"json",
          success:function(data){
            $(document.getElementById(objectId)).empty();
            $(document.getElementById(objectId)).append("<th>"+building+"</th><th>"+floor+"</th><th>"+unit+"</th><th><a href='#' data-toggle='modal' data-target='#myModal' onclick='toModal(\""+objectId+"\",\""+building+"\",\""+floor+"\",\""+unit+"\")'>修改</a></th><th><a href='#' onclick='deleteHouse(\""+objectId+"\")'>删除</a></th>");
          }
        });

      };
  	</script>
</head>
<body>
<?php require_once('../estateManager/navigation.php');?>
<script type="text/javascript">
	document.getElementById('village').setAttribute('class','dropdown active');
	document.getElementById('updateHouse').setAttribute('class','active');
</script>
<div class="container">
    <div align="center">
   		<div class='input-group col-sm-6'>
   			<input type='text' class='form-control' id='building'>
   			<span class='input-group-addon'>栋</span>
   			<input type='text' class='form-control' id='floor'>
   			<span class='input-group-addon'>层</span>
   			<input type='text' class='form-control' id='unit'>
   			<span class='input-group-addon'>单元</span>
   		  <button onclick="getBuilding()" class="form-control btn btn-primary">搜索</button>
   		</div>
      <p style="color:#CDC9C9;font-size:8px;">输入需要修改的房屋信息进行查询</p>
    </div>
      <hr>
   		<table class="table table-hover table-bordered table-responsive" id="content">
      <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true" border="thin">
                &times;
              </button>
              <h3 class="modal-title" id="myModalLabel">
                修改
              </h3>
            </div>
            <div class="modal-body">
              
                <input id="objId" type="hidden">
                <div class="row form-group">
                  <label for="updateBuilding" class="col-sm-4 control-label">栋</label>
                  <div class="col-sm-4">
                    <input type="text" class="form-control" id="updateBuilding">
                  </div>
                </div>
                <div class="row form-group">
                  <label for="updateFloor" class="col-sm-4 control-label">楼层</label>
                  <div class="col-sm-4">
                    <input type="text" class="form-control" id="updateFloor">
                  </div>
                </div>
                <div class="row form-group">
                  <label for="updateUnit" class="col-sm-4 control-label">单元</label>
                  <div class="col-sm-4">
                    <input type="text" class="form-control" id="updateUnit">
                  </div>
                </div>
            
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-default" 
                data-dismiss="modal">关闭
            </button>
            <button type="button" class="btn btn-primary" onclick="updateHouse()" data-dismiss="modal">
               提交更改
            </button>
            </div>
          </div><!-- /.modal-content -->
        </div>
      </div><!-- /.modal -->
		</table>
</div>
</body>
</html>