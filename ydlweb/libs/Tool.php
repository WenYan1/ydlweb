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


	public static function getUnitList(){
		return array(
			'001' => '台',
			'002' => '座',
			'003' => '辆',
			'004' => '艘',
			'005' => '架',
			'006' => '套',
			'007' => '个',
			'008' => '只',
			'009' => '头',
			'010' => '张',
			'011' => '件',
			'012' => '支',
			'013' => '枝',
			'014' => '根',
			'015' => '条',
			'016' => '把',
			'017' => '块',
			'018' => '卷',
			'019' => '副',
			'020' => '片',
			'021' => '组',
			'022' => '份',
			'023' => '幅',
			'025' => '双',
			'026' => '对',
			'027' => '棵',
			'028' => '株',
			'029' => '井',
			'030' => '米',
			'031' => '盘',
			'032' => '平方米',
			'033' => '立方米',
			'034' => '筒',
			'035' => '千克',
			'036' => '克',
			'037' => '盆',
			'038' => '万个',
			'039' => '具',
			'040' => '百副',
			'041' => '百支',
			'042' => '百把',
			'043' => '百个',
			'044' => '百片',
			'045' => '刀',
			'046' => '疋',
			'047' => '公担',
			'048' => '扇',
			'049' => '百枝',
			'050' => '千只',
			'051' => '千块',
			'052' => '千盒',
			'053' => '千枝',
			'054' => '千个',
			'055' => '亿支',
			'056' => '亿个',
			'057' => '万套',
			'058' => '千张',
			'059' => '万张',
			'060' => '千伏安',
			'061' => '千瓦',
			'062' => '千瓦时',
			'063' => '千升',
			'067' => '英尺',
			'070' => '吨',
			'071' => '长吨',
			'072' => '短吨',
			'073' => '司马担',
			'074' => '司马斤',
			'075' => '斤',
			'076' => '磅',
			'077' => '担',
			'078' => '英担',
			'079' => '短担',
			'080' => '两',
			'081' => '市担',
			'083' => '盎司',
			'084' => '克拉',
			'085' => '市尺',
			'086' => '码',
			'088' => '英寸',
			'089' => '寸',
			'095' => '升',
			'096' => '毫升',
			'097' => '英加仑',
			'098' => '美加仑',
			'099' => '立方英尺',
			'101' => '立方尺',
			'110' => '平方码',
			'111' => '平方英尺',
			'112' => '平方尺',
			'115' => '英制马力',
			'116' => '公制马力',
			'118' => '令',
			'120' => '箱',
			'121' => '批',
			'122' => '罐',
			'123' => '桶',
			'124' => '扎',
			'125' => '包',
			'126' => '箩',
			'127' => '打',
			'128' => '筐',
			'129' => '罗',
			'130' => '匹',
			'131' => '册',
			'132' => '本',
			'133' => '发',
			'134' => '枚',
			'135' => '捆',
			'136' => '袋',
			'139' => '粒',
			'140' => '盒',
			'141' => '合',
			'142' => '瓶',
			'143' => '千支',
			'144' => '万双',
			'145' => '万粒',
			'146' => '千粒',
			'147' => '千米',
			'148' => '千英尺',
			'149' => '百万贝可',
			'163' => '部',
			'164' => '樘',
			'165' => '面',
			'166' => '颗',
			'167' => '道'
		);
	}

	/**
	 * 获取产品单位
	 *
	 * @param int $key
	 *
	 * @return mixed|string
	 */
	public static function getGoodsUnit($key = 0)
	{
		if (!empty($key)) {
			$arr = Tool::getUnitList();

			return !empty($arr[$key]) ? $arr[$key] : '';
		}

		return '';
	}

	public static function build_order_no()
	{
		$year_code = array(
			'A',
			'B',
			'C',
			'D',
			'E',
			'F',
			'G',
			'H',
			'I',
			'J'
		);
		return $order_sn = $year_code [intval(date('Y')) - 2010] . strtoupper(dechex(date('m'))) . date('d') . substr(time(), -5) . substr(microtime(), 2, 5) . sprintf('%d', rand(10, 99));
	}

	public static function force_download($filename = '', $data = '', $set_mime = FALSE)
	{
		if ($filename === '' OR $data === '')
		{
			return;
		}
		elseif ($data === NULL)
		{
			if ( ! @is_file($filename) OR ($filesize = @filesize($filename)) === FALSE)
			{
				return;
			}

			$filepath = $filename;
			$filename = explode('/', str_replace(DIRECTORY_SEPARATOR, '/', $filename));
			$filename = end($filename);
		}
		else
		{
			$filesize = strlen($data);
		}

		// Set the default MIME type to send
		$mime = 'application/octet-stream';

		$x = explode('.', $filename);
		$extension = end($x);

		if ($set_mime === TRUE)
		{
			if (count($x) === 1 OR $extension === '')
			{
				/* If we're going to detect the MIME type,
				 * we'll need a file extension.
				 */
				return;
			}

			// Load the mime types
			$mimes =& get_mimes();

			// Only change the default MIME if we can find one
			if (isset($mimes[$extension]))
			{
				$mime = is_array($mimes[$extension]) ? $mimes[$extension][0] : $mimes[$extension];
			}
		}

		/* It was reported that browsers on Android 2.1 (and possibly older as well)
		 * need to have the filename extension upper-cased in order to be able to
		 * download it.
		 *
		 * Reference: http://digiblog.de/2011/04/19/android-and-the-download-file-headers/
		 */
		if (count($x) !== 1 && isset($_SERVER['HTTP_USER_AGENT']) && preg_match('/Android\s(1|2\.[01])/', $_SERVER['HTTP_USER_AGENT']))
		{
			$x[count($x) - 1] = strtoupper($extension);
			$filename = implode('.', $x);
		}

		if ($data === NULL && ($fp = @fopen($filepath, 'rb')) === FALSE)
		{
			return;
		}

		// Clean output buffer
		if (ob_get_level() !== 0 && @ob_end_clean() === FALSE)
		{
			@ob_clean();
		}

		// Generate the server headers
		header('Content-Type: '.$mime);
		header('Content-Disposition: attachment; filename="'.$filename.'"');
		header('Expires: 0');
		header('Content-Transfer-Encoding: binary');
		header('Content-Length: '.$filesize);
		header('Cache-Control: private, no-transform, no-store, must-revalidate');

		// If we have raw data - just dump it
		if ($data !== NULL)
		{
			exit($data);
		}

		// Flush 1MB chunks of data
		while ( ! feof($fp) && ($data = fread($fp, 1048576)) !== FALSE)
		{
			echo $data;
		}

		fclose($fp);
		exit;
	}

}


?>