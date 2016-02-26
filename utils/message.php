<?php
Class message{
	private $msg;
	public function __construct(){
		$this->msg = array('code'=>200,'data'=>'');
	}
	public function setCode($code){
		$this->msg['code'] = $code;
	}
	public function getCode(){
		return $this->msg['code'];
	}
	public function setData($data){
		$this->msg['data'] = $data;
	}
	public function getData(){
		return $this->msg['data'];
	}
}

?>