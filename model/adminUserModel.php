<?php
  require_once('../leancloud/AV.php');
  require_once('../utils/function.php');
	Class adminUserModel{
		public function login($username,$password){
			    $query = new leancloud\AVQuery('AdminManager');
        	$query->where('username',$username);
        	$user = $query->find();
        	$user = toArray($user);
          if(!empty($user)){
            $user = (array)$user[0];
          }
      		if($user['username']!=""&&$user['password']==$password){
      			return $user;
      		}
          $user = array();
          return $user;
        }
    }
?>