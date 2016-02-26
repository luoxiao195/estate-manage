<?php
require_once('../leancloud/AV.php');
require_once('../utils/function.php');
require_once('../utils/function.php');
Class estateManagerModel{
    /**
    *注册管理员账号
    *
    **/
	public function register($estateName,$estatePassword,$villageId){
        $query = new leancloud\AVQuery('EstateManager');
        $query->where('username',$estateName);
        $estateManager = $query->find();
        $estateManager = toArray($estateManager);
        if(empty($estateManager)){                      //注册成功
            $obj = new leancloud\AVObject('EstateManager');
            $obj->username = $estateName;
            $obj->password = $estatePassword;
            $obj->villageId = getPointer('Village',$villageId);
            $obj->save();
            return true;
        }else{                          //注册失败
            return false;
        }
		
	}
    /**
    *获取所有管理员账号信息
    **/
	public function getAll(){
		$query = new leancloud\AVQuery('EstateManager');
        $estateManagerList = $query->find();
        $estateManager = toArray($estateManagerList,array('villageId'));

        return $estateManager;
        // $estateManagerList = (array)
	}
    /**
    *管理员登录处理
    **/
    public function login($username,$password){
        $query = new leancloud\AVQuery('EstateManager');
        $query->where('username',$username);
        $estateManager = $query->find();
        $estateManager = toArray($estateManager,array('villageId'));
        if(!empty($estateManager)){
            if($estateManager[0]['password']==$password){
                return $estateManager[0];
            }
        
        }   
        return array();
    }

    /**
    *管理员密码修改
    **/
    public function update($password,$estateManagerId){
        $obj = new leancloud\AVObject('EstateManager');
        $obj->password = $password;
        $obj->update($estateManagerId);
        return true;
    }

    /**
    *删除管理员账号
    **/
    public function delete($estateManagerId){
        $obj = new leancloud\AVObject('EstateManager');
        $obj->delete($estateManagerId);
        return true;
    }
}

?>