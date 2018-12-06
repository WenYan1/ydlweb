<?php
class Upload {
	private static $_path = 'uploads/';

	private static function _getPath() {
		return dirname(dirname(__FILE__)).'/web/';
	}

	public static function getPath($dir, $ext) {
		if(!is_dir(self::_getPath().self::$_path.$dir)) {
			mkdir(self::_getPath().self::$_path.$dir, 0777, true);
		}
		return array(
			'newName' => time() .'_'. rand(10000, 99999) . "." . $ext,
			'savePath' => self::_getPath().self::$_path.$dir
			); 
	}
}


?>