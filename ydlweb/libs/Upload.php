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

	public static function get_file_thumbnail($file_path = ''){
		if (!empty($file_path)){
			$path_info = pathinfo($file_path);

			if(!empty($path_info['extension'])){
				if(in_array($path_info['extension'],array('doc','docx'))){
					return '/images/file_extension/doc.png';
				}
				if(in_array($path_info['extension'],array('xls','xlsx'))){
					return '/images/file_extension/xlxs.png';
				}
				if(in_array($path_info['extension'],array('ppt','pptx'))){
					return '/images/file_extension/ppt.png';
				}
				if(in_array($path_info['extension'],array('pdf'))){
					return '/images/file_extension/pdf.png';
				}
				if(in_array($path_info['extension'],array('zip'))){
					return '/images/file_extension/zip.png';
				}
				if(in_array($path_info['extension'],array('rar'))){
					return '/images/file_extension/rar.png';
				}
				if(in_array($path_info['extension'],array('jpg','jpeg','png','gif'))){
					return $file_path;
				}
			}
			return '/images/file_extension/all.png';
		}
		return '';
	}
}


?>