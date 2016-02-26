<?php
	 echo '<ul class="nav nav-pills">'.
         '<li id="index"><a href='.__PUBLIC__.'/view/admin/index.php'.'>首页</a></li>'.
         '<li class="dropdown" id="village"><a class="dropdown-toggle" data-toggle="dropdown" href="#">小区管理<span class="caret"></span></a>'.
               '<ul class="dropdown-menu">'.
                  '<li id="villageList"><a href='.__PUBLIC__.'/control/villageControl.php?method=getAll'.'>小区列表</a></li>'.
                  '<li id="addVillage"><a href='.__PUBLIC__.'/control/villageControl.php?method=add'.'>添加小区</a></li>'.
               '</ul>'.
            '</li>'.
         '<li id="estateManager"><a href='.__PUBLIC__.'/control/estateManagerControl.php?method=getAll'.'>小区管理员账号管理</a></li>'.
         '<li id="assistant"><a href='.__PUBLIC__.'/control/assistantControl.php?method=getAll'.'>专员账号管理</a></li>'.
         '<li><a href='.__PUBLIC__.'/control/adminLoginControl.php'.'>退出</a></li>'.
   '</ul>'.
   '<hr>';
?>
  