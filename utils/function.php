<?php 

function toArray($obj,$point=array()){
	$obj = (array)$obj;
	$obj = $obj['results'];
	$return = array();
	foreach ($obj as $key => $value) {
		$temp = array();
		foreach ((array)$value as $key1 => $value1) {		
			if(in_array($key1, $point)){
				if(!empty($value1))							//添加判断是否为空，否则出错
					$value1 = (array)$value1;
					$temp = array_merge($temp,array($key1=>$value1['objectId']));
			}else{
				$temp = array_merge($temp,array($key1=>$value1));
			}
			
		}
		$return = array_merge($return,array($key=>$temp));
	}
	return $return;
}

function getPointer($className,$objectId){
	$pointer = array('__type'=>'Pointer','className'=>$className,'objectId'=>$objectId);
	return $pointer;

}
function test($List)
{
	$result=$List;
	foreach ($result as $key => $value) {
		foreach ($value as $key_1 => $value_1) {
			print_r($key_1.":".$value_1);
		}
	}
}
function ifExit($value)
{
	if(isset($value))
		return $value;
	else
		return "尚未填写";
}
