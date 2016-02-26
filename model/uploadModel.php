<?php
require_once('../vendor/autoload.php');
require_once('../config/qiniu.php');
use Qiniu\Auth;
use Qiniu\Storage\BucketManager;
use Qiniu\Storage\UploadManager;
use Qiniu\Processing\Operation;
Class uploadModel{
	 public function postDoupload($name,$filePath,$type){
        $qiniu = new qiniu();
        $token=$this->getToken();
        $uploadManager=new UploadManager();
        list($ret,$err)=$uploadManager->putFile($token,$name,$filePath,null,$type,false);
        if($err){//上传失败
            var_dump($err);
            return $err;//返回错误信息到上传页面
        }else{//成功
            //添加信息到数据库
            $accessKey=$qiniu::accessKey;
            $secretKey=$qiniu::secretKey;
            $auth=new Auth($accessKey, $secretKey);
            $baseUrl = $qiniu::domain."/".$ret['key'];
            $authUrl = $auth->privateDownloadUrl($baseUrl);
            return $authUrl;//返回结果到上传页面
        }
    }
	private function getToken(){
        $qiniu = new qiniu();
        $accessKey=$qiniu::accessKey;
        $secretKey=$qiniu::secretKey;
        $auth=new Auth($accessKey, $secretKey);
        $bucket=$qiniu::bucket;//上传空间名称
        //设置put policy的其他参数
        //$opts=['callbackUrl'=>'http://www.callback.com/','callbackBody'=>'name=$(fname)&hash=$(etag)','returnUrl'=>"http://www.baidu.com"];
        return $auth->uploadToken($bucket);//生成token      
    }
}

?>