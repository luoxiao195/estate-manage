<?php
	
	echo '<div class="col-sm-3">'.
			'<ul class="nav nav-pills nav-stacked">'.
				'<li id="detail"><a href='.__PUBLIC__.'/view/manageParking/detail.php?objectId='.$_SESSION['objectId'].'>查看信息</a></li>'.
				'<li id="update"><a href='.__PUBLIC__.'/control/manageParkingControl.php?getMethod=modify&objectId='.$_SESSION['objectId'].'>修改信息</a></li>'.
				'<li id="newBill"><a href='.__PUBLIC__.'/view/manageParking/newBill.php?objectId='.$_SESSION['objectId'].'>当月账单</a></li>'.
			'</ul>'.
		 '</div>';
?>
