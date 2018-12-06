<?php
class Salt {
	public static function generateSalt($password) {
		$datas = ['1','2','3','4','5','6','7','8','9','0','a','b','c','d','e','f','j','h','i','j','g','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z','A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z'];
		$saltKeys = array_rand($datas, 10);
		$salt = '';
		foreach($saltKeys as $keyVal) {
			$salt .= $datas[$keyVal];
		}
		$hash          	= md5($password);
		$salt_hash     	= md5($salt.$hash);
		return $result	= array('salt'=>$salt, 'password'=>$salt_hash);
	}

	public static function vertifySalt($password, $salt) {
		$hash 		= md5($password);
		$salt_hash 	= md5($salt.$hash);
		return $salt_hash;
	}
}


?>