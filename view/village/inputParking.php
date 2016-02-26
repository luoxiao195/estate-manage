<?php
	require_once('../estateManager/head.php');
?>
<!DOCTYPE html>
<html>
<head>
	<title>车位录入</title>
	<meta http-equiv="Content-Type" content="text/html;charset=utf-8">
	<meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0,user-scalable=no">
  <link href="http://apps.bdimg.com/libs/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet">
  <script src="http://apps.bdimg.com/libs/jquery/2.0.0/jquery.min.js"></script>
  <script src="http://apps.bdimg.com/libs/bootstrap/3.3.0/js/bootstrap.min.js"></script>
   <script type="text/javascript">
      var i = 0;
      var j = 0;
      var k = 0;
      var building = new Array();
      var floor = new Array();
      var unit = new Array();
      function inArray(arr,num){
        var r = false;
        for (var i = arr.length - 1; i >= 0; i--) {
          if(arr[i]==num){
            r = true;
          }
        };
        return r;
      };
      function addBuilding(){
        var buildingNum = $("#addBuilding").val();
        $("#addBuilding").attr("value","");
        if(buildingNum!=""&&!inArray(building,buildingNum)){
          $("#building").append("<div class='well well-sm col-sm-1' align='center' name="+i+" id=building"+buildingNum+">"+buildingNum+"栋<span class='glyphicon'><a href='#' onclick='deleteBuilding(\"building"+buildingNum+"\")'>&times</a></span></div>")
          building[i]=buildingNum;
          i++;
        }else{
          alert("所填不能为空或已经存在");
        }
      };
      function addFloor(){
        var floorNum = $("#addFloor").val();
        $("#addFloor").attr("value","");
        if(floorNum!=""&&!inArray(floor,floorNum)){
          $("#floor").append("<div class='well well-sm col-sm-1' align='center' name="+j+" id=floor"+floorNum+">"+floorNum+"层<span class='glyphicon'><a href='#' onclick='deleteFloor(\"floor"+floorNum+"\")'>&times</a></span></div>")
          floor[j]=floorNum;
          j++;
        }else{
          alert("所填不能为空或已经存在");
        }
      };
      function addFloors(){
        var floorNum1 = parseInt($("#addFloors1").val());
        var floorNum2 = parseInt($("#addFloors2").val());
        $("#addFloors1").attr("value","");
        $("#addFloors2").attr("value","");
        if(floorNum1!=""&&floorNum2!=""&&floorNum1<floorNum2){
          for (var i = floorNum1; i <= floorNum2; i++) {
            if(inArray(floor,i)){
              alert("所填已经存在");
              abort();
            }
          };
          for (var i = floorNum1; i <=floorNum2; i++) {
            $("#floor").append("<div class='well well-sm col-sm-1' align='center' name="+j+" id=floor"+i+">"+i+"层<span class='glyphicon'><a href='#' onclick='deleteFloor(\"floor"+i+"\")'>&times</a></span></div>")
            floor[j]=i;
            j++;
          };
        }else{
          alert("所填不能为空或输入顺序错误"); 
        }
      };
      function addUnit(){
        var unitNum = parseInt($("#addUnit").val());
        $("#addUnit").attr("value","");
        if(unitNum!=""&&!inArray(unit,unitNum)){
          $("#unit").append("<div class='well well-sm col-sm-1' align='center' name="+k+" id=unit"+unitNum+">"+unitNum+"单元<span class='glyphicon'><a href='#' onclick='deleteUnit(\"unit"+unitNum+"\")'>&times</a></span></div>")
          unit[k]=unitNum;
          k++;
        }else{
          alert("所填不能为空或已经存在");
        }
      };
      function addUnits(){
        var unitNum1 = parseInt($("#addUnits1").val());
        var unitNum2 = parseInt($("#addUnits2").val());
        $("#addUnits1").attr("value","");
        $("#addUnits2").attr("value","");
        if(unitNum1!=""&&unitNum2!=""&&unitNum1<unitNum2){
          for (var i = unitNum1; i <= unitNum2; i++) {
            if(inArray(unit,i)){
              alert("所填已经存在");
              return false;
            }
          };
          for (var i = unitNum1; i <=unitNum2; i++) {
            $("#unit").append("<div class='well well-sm col-sm-1' align='center' name="+k+" id=unit"+i+">"+i+"单元<span class='glyphicon'><a href='#' onclick='deleteUnit(\"unit"+i+"\")'>&times</a></span></div>")
            unit[k]=i;
            k++;
          };
        }else{
          alert("所填不能为空或输入顺序错误"); 
        }
      };
      function deleteBuilding(id){
        var n = $(document.getElementById(id)).attr("name");
        $(document.getElementById(id)).remove();

        building[n]="";
      };
      function deleteFloor(id){
        var n = $(document.getElementById(id)).attr("name");
        
        $(document.getElementById(id)).remove();
        floor[n]="";
      };
      function deleteUnit(id){
        var n = $(document.getElementById(id)).attr("name");
        $(document.getElementById(id)).remove();
        unit[n]="";
      };
      function check(){
        if(building.length==0||floor.length==0||unit.length==0){
          alert("输入不完整");
          return false;
        }else{
          $("#content").append("<input value="+floor+" name=floors type='hidden'/>");
          $("#content").append("<input value="+unit+" name=units type='hidden'/>");
          $("#content").append("<input value="+building+" name=buildings type='hidden'/>");
        }
        
      };
    </script>
</head>
<body>
	
	<?php require_once('../estateManager/navigation.php');?>
	<script type="text/javascript">
		document.getElementById('parking').setAttribute('class','dropdown active');
		document.getElementById('inputParking').setAttribute('class','active');
	</script>

	<div class="container">
        <p style="color:red;font-size:8px;">一次录入操作数量请勿超过1000条</p>
    <table class="table table-hover">
      <form role="form" method="POST" action=<?php echo __PUBLIC__.'/control/villageControl.php?method=inputParking&id='.$_SESSION['estateManager']['villageId'];?> id="content">
        <tbody>
          <col width="20%"></col>
          <col width="80%"></col>
          <tr>
            <td>
              <a class="btn btn-default" data-toggle="modal" data-target="#buildingModal">添加栋</a>
            </td>
            <td id="building">
            
            </td>
          </tr>
          <tr>
            <td>
                <a class='btn btn-default' data-toggle="modal" data-target="#floorModal">添加单个楼层</a><a class='btn btn-default' data-toggle="modal" data-target="#floorsModal">添加多个楼层</a>
            </td>
            <td id="floor">
                
            </td>
          </tr>
              
          <tr>
            <td>
                <a class='btn btn-default' data-toggle="modal" data-target="#unitModal">添加单个单元</a><a class='btn btn-default' data-toggle="modal" data-target="#unitsModal">添加多个单元</a>
            </td>
            <td id="unit">
                
            </td>
          </tr>
          <tr>
            <td colspan="2" align="center"><button type='submit' class='btn btn-primary' onclick='return check();'>确定</button></td>
          </tr>
        </tbody>

       
      </form>

    </table>
    <div class="modal fade" id="buildingModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true" border="thin">
                &times;
              </button>
              <h3 class="modal-title" id="myModalLabel">
                添加栋
              </h3>
            </div>
            <div class="modal-body" align="center">
      
                  
                  <div class="input-group col-sm-4">
                    <input type="text" class="form-control" id="addBuilding">
                    <span class='input-group-addon'>栋</span>
                  </div>
            </div>
            
            <div class="modal-footer">
            <button type="button" class="btn btn-default" 
                data-dismiss="modal">关闭
            </button>
            <button type="button" class="btn btn-primary" onclick="addBuilding()" data-dismiss="modal">
               提交更改
            </button>
            </div>
          </div><!-- /.modal-content -->
        </div>
      </div><!-- /.modal -->

      <div class="modal fade" id="floorModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true" border="thin">
                &times;
              </button>
              <h3 class="modal-title" id="myModalLabel">
                添加单个楼层
              </h3>
            </div>
            <div class="modal-body" align="center">
              
                
                 
                  <div class="col-sm-4 input-group">
                    <input type="text" class="form-control" id="addFloor">
                    <span class='input-group-addon'>层</span>
                  </div>
                
            
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-default" 
                data-dismiss="modal">关闭
            </button>
            <button type="button" class="btn btn-primary" onclick="addFloor()" data-dismiss="modal">
               提交更改
            </button>
            </div>
          </div><!-- /.modal-content -->
        </div>
      </div><!-- /.modal -->

      <div class="modal fade" id="floorsModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true" border="thin">
                &times;
              </button>
              <h3 class="modal-title" id="myModalLabel">
                添加多个楼层
              </h3>
            </div>
            <div class="modal-body" align="center">
              
                
                  <div class="col-sm-5 input-group">
                    <input type="text" class="form-control" id="addFloors1">
                    <span class='input-group-addon'>~</span>
                    <input type="text" class="form-control" id="addFloors2">
                    <span class='input-group-addon'>层</span>
                  </div>
               
            
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-default" 
                data-dismiss="modal">关闭
            </button>
            <button type="button" class="btn btn-primary" onclick="addFloors()" data-dismiss="modal">
               提交更改
            </button>
            </div>
          </div><!-- /.modal-content -->
        </div>
      </div><!-- /.modal -->

      <div class="modal fade" id="unitModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true" border="thin">
                &times;
              </button>
              <h3 class="modal-title" id="myModalLabel">
                添加单个单元
              </h3>
            </div>
            <div class="modal-body" align="center">
              
               
                
                  
                  <div class="col-sm-4 input-group">
                    <input type="text" class="form-control" id="addUnit">
                    <span class='input-group-addon'>单元</span>
                  </div>
                
            
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-default" 
                data-dismiss="modal">关闭
            </button>
            <button type="button" class="btn btn-primary" onclick="addUnit()" data-dismiss="modal">
               提交更改
            </button>
            </div>
          </div><!-- /.modal-content -->
        </div>
      </div><!-- /.modal -->

      <div class="modal fade" id="unitsModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true" border="thin">
                &times;
              </button>
              <h3 class="modal-title" id="myModalLabel">
                添加多个单元
              </h3>
            </div>
            <div class="modal-body" align="center">
              
                
              
                  
                  <div class="col-sm-5 input-group">
                    <input type="text" class="form-control" id="addUnits1">
                    <span class='input-group-addon'>~</span>
                    <input type="text" class="form-control" id="addUnits2">
                    <span class='input-group-addon'>单元</span>
                  </div>
                
            
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-default" 
                data-dismiss="modal">关闭
            </button>
            <button type="button" class="btn btn-primary" onclick="addUnits()" data-dismiss="modal">
               提交更改
            </button>
            </div>
          </div><!-- /.modal-content -->
        </div>
      </div><!-- /.modal -->
        
  </div>
</body>
</html>