<?php

class Tool
{
	public static function outputError($message)
	{
		$message = urlencode($message);
		$datas = array(
			'code'    => 200,
			'status'  => false,
			'message' => $message
		);
		$jsonData = json_encode($datas);
		return urldecode($jsonData);
	}

	public static function outputSuccess($message)
	{
		$message = urlencode($message);
		$datas = array(
			'code'    => 200,
			'status'  => true,
			'message' => $message
		);
		$jsonData = json_encode($datas);
		return urldecode($jsonData);
	}

	public static function outputData($data)
	{
		//$data = urlencode($data);
		$datas = array(
			'code'    => 200,
			'status'  => true,
			'message' => 'SUCCESS',
			'data'    => $data
		);
		$jsonData = json_encode($datas);
		//return urldecode($jsonData);
		return $jsonData;
	}

	public static function getVerifyCode()
	{
		$datas = ['1', '2', '3', '4', '5', '6', '7', '8', '9', '0', 'a', 'b', 'c', 'd', 'e', 'f', 'j', 'h', 'i', 'j', 'g', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z', 'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z'];
		$randKeys = array_rand($datas, 10);
		$randStr = '';
		foreach ($randKeys as $keyVal) {
			$randStr .= $datas[$keyVal];
		}
		$verifyCode = $randStr . time();
		return md5($verifyCode);
	}

	public static function convert2Array($objects)
	{
		if (!is_array($objects) || !is_object(current($objects))) {
			return $objects;
		}
		$array = array();
		foreach ($objects as $obj) {
			$array[] = $obj->attributes;
		}
		return $array;
	}

	public static function array2Json($array)
	{
		if (!is_array($array)) {
			return $array;
		}
		return json_encode($array);
	}

	public static function cacheKeyFormat($key)
	{
		return md5($key, true);
	}

	public static function getCurrency($key)
	{
		$result = '';
		if (!empty($key)) {
			switch ($key) {
				case 1:
					$result = '(RMB)人民币';
					break;
				case 2:
					$result = '(USD)美元';
					break;
				default:
					break;
			}
		}
		return $result;
	}

}


?>