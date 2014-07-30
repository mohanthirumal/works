<?php
class Tools
{
	public static function passwdGen($length = 8)
	{
		$str = 'abcdefghijkmnopqrstuvwxyz0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
		for ($i = 0, $passwd = ''; $i < $length; $i++)
			$passwd .= self::substr($str, mt_rand(0, self::strlen($str) - 1), 1);
		return $passwd;
	}
	
	static function strlen($str, $encoding = 'UTF-8')
	{
		if (is_array($str))
			return false;
		$str = html_entity_decode($str, ENT_COMPAT, 'UTF-8');
		if (function_exists('mb_strlen'))
			return mb_strlen($str, $encoding);
		return strlen($str);
	}
	
	static function substr($str, $start, $length = false, $encoding = 'utf-8')
	{
		if (is_array($str))
			return false;
		if (function_exists('mb_substr'))
			return mb_substr($str, (int)($start), ($length === false ? self::strlen($str) : (int)($length)), $encoding);
		return substr($str, $start, ($length === false ? self::strlen($str) : (int)($length)));
	}
	
	public static function encrypt($passwd)
	{
		return md5(pSQL($passwd));
	}
	
	public static function getValue($key, $defaultValue = false)
	{
	 	if (!isset($key) OR empty($key) OR !is_string($key))
			return false;
		$ret = (isset($_POST[$key]) ? $_POST[$key] : (isset($_GET[$key]) ? $_GET[$key] : $defaultValue));

		if (is_string($ret) === true)
			$ret = stripslashes(urldecode(preg_replace('/((\%5C0+)|(\%00+))/i', '', urlencode($ret))));
		elseif (is_array($ret))
            $ret = Tools::getArrayValue($ret);

		return $ret;
	}

    public static function getArrayValue($array)
    {
        foreach ($array as &$row)
        {
            if (is_array($row))
                $row = Tools::getArrayValue($row);
            else
                $row = stripslashes(urldecode(preg_replace('/((\%5C0+)|(\%00+))/i', '', urlencode($row))));
        }

        return $array;
    }
	
	public static function getHttpHost($http = false, $entities = false)
	{
		$host = (isset($_SERVER['HTTP_X_FORWARDED_HOST']) ? $_SERVER['HTTP_X_FORWARDED_HOST'] : $_SERVER['HTTP_HOST']);
		if ($entities)
			$host = htmlspecialchars($host, ENT_COMPAT, 'UTF-8');
		if ($http)
			$host = (Configuration::get('PS_SSL_ENABLED') ? 'https://' : 'http://').$host;
		return $host;
	}
	
	public static function redirect($url)
	{		
		header('Location: '.$url);
		exit;
	}
	
	public static function isSubmit($submit)
	{
		return (
			isset($_POST[$submit]) OR isset($_POST[$submit.'_x']) OR isset($_POST[$submit.'_y'])
			OR isset($_GET[$submit]) OR isset($_GET[$submit.'_x']) OR isset($_GET[$submit.'_y'])
		);
	}
	
	public static function jsonEncode($data)
	{
		if (function_exists('json_encode'))
			return json_encode($data);
		else
		{
			include_once('tools/json/json.php');
			$pearJson = new Services_JSON();
			return $pearJson->encode($data);
		}
	}
	
	public static function addJS($js_uri)
	{
		global $js_files;
		if (!isset($js_files))
			$js_files = array();
		// avoid useless operation...
		if (in_array($js_uri, $js_files))
			return true;

		// detect mass add
		if (!is_array($js_uri) && !in_array($js_uri, $js_files))
			$js_uri = array($js_uri);
		else
			foreach ($js_uri as $key => $js)
				if (in_array($js, $js_files))
					unset($js_uri[$key]);		

		// adding file to the big array...
		$js_files = array_merge($js_files, $js_uri);

		return true;
	}
	
	public static function addCSS($css_uri, $css_media_type = 'all')
	{
		global $css_files;

		if (is_array($css_uri))
		{
			foreach ($css_uri as $file => $media_type)
				self::addCSS($file, $media_type);
			return true;
		}		

		// detect mass add
		$css_uri = array($css_uri => $css_media_type);

		// adding file to the big array...
		if (is_array($css_files))
			$css_files = array_merge($css_files, $css_uri);
		else
			$css_files = $css_uri;

		return true;
	}
	
	public static function dateYears()
	{
		for ($i = date('Y') - 10; $i >= 1900; $i--)
			$tab[] = $i;
		return $tab;
	}
	
	public static function dateDays()
	{
		for ($i = 1; $i != 32; $i++)
			$tab[] = $i;
		return $tab;
	}
	
	public static function dateMonths()
	{
		for ($i = 1; $i != 13; $i++)
			$tab[$i] = date('F', mktime(0, 0, 0, $i, date('m'), date('Y')));
		return $tab;
	}
	
	    public static function minifyHTML($html_content)
    {
		if (strlen($html_content) > 0)
		{
			//set an alphabetical order for args
			$html_content = preg_replace_callback(
				'/(<[a-zA-Z0-9]+)((\s?[a-zA-Z0-9]+=[\"\\\'][^\"\\\']*[\"\\\']\s?)*)>/'
				,array('Tools', 'minifyHTMLpregCallback')
				,$html_content);

			require_once('tools/minify_html/minify_html.class.php');
			$html_content = str_replace(chr(194) . chr(160), '&nbsp;', $html_content);
			$html_content = Minify_HTML::minify($html_content, array('xhtml', 'cssMinifier', 'jsMinifier'));

				//$html_content = preg_replace('/"([^\>\s"]*)"/i', '$1', $html_content);//FIXME create a js bug
				$html_content = preg_replace('/<!DOCTYPE \w[^\>]*dtd\">/is', '', $html_content);
				$html_content = preg_replace('/\s\>/is', '>', $html_content);
				$html_content = str_replace('</li>', '', $html_content);
				$html_content = str_replace('</dt>', '', $html_content);
				$html_content = str_replace('</dd>', '', $html_content);
				$html_content = str_replace('</head>', '', $html_content);
				$html_content = str_replace('<head>', '', $html_content);
				$html_content = str_replace('</html>', '', $html_content);
				$html_content = str_replace('</body>', '', $html_content);
				//$html_content = str_replace('</p>', '', $html_content);//FIXME doesnt work...
				$html_content = str_replace("</option>\n", '', $html_content);//TODO with bellow
				$html_content = str_replace('</option>', '', $html_content);
				$html_content = str_replace('<script type=text/javascript>', '<script>', $html_content);//Do a better expreg
				$html_content = str_replace("<script>\n", '<script>', $html_content);//Do a better expreg

			return $html_content;
		}
		return false;
	}
	
	public static function minifyHTMLpregCallback($preg_matches)
	{
		$args = array();
		preg_match_all('/[a-zA-Z0-9]+=[\"\\\'][^\"\\\']*[\"\\\']/is', $preg_matches[2], $args);
		$args = $args[0];
		sort($args);
		// if there is no args in the balise, we don't write a space (avoid previous : <title >, now : <title>)
		if (empty($args))
			$output = $preg_matches[1].'>';
		else
			$output = $preg_matches[1].' '.implode(' ', $args).'>';
		return $output;
	}
	
	public static function packJSinHTML($html_content)
	{
		if (strlen($html_content) > 0)
		{
			$htmlContentCopy = $html_content;
			$html_content = preg_replace_callback(
				'/\\s*(<script\\b[^>]*?>)([\\s\\S]*?)(<\\/script>)\\s*/i'
				,array('Tools', 'packJSinHTMLpregCallback')
				,$html_content);

			// If the string is too big preg_replace return null: http://php.net/manual/en/function.preg-replace-callback.php
			// In this case, we don't compress the content
			if ($html_content === null)
			{
				error_log('Error occured in function packJSinHTML');
				return $htmlContentCopy;
			}
			return $html_content;
		}
		return false;
	}

	public static function packJSinHTMLpregCallback($preg_matches)
	{
		$preg_matches[1] = $preg_matches[1].'/* <![CDATA[ */';
		$preg_matches[2] = self::packJS($preg_matches[2]);
		$preg_matches[count($preg_matches)-1] = '/* ]]> */'.$preg_matches[count($preg_matches)-1];
		unset($preg_matches[0]);
		$output = implode('', $preg_matches);
		return $output;
	}


	public static function packJS($js_content)
	{
		if (strlen($js_content) > 0)
		{
			require_once('tools/js_minify/jsmin.php');
			return JSMin::minify($js_content);
		}
		return false;
	}
	public function getRemoteAddr()
	{
		// This condition is necessary when using CDN, don't remove it.
		if (isset($_SERVER['HTTP_X_FORWARDED_FOR']) AND $_SERVER['HTTP_X_FORWARDED_FOR'] AND (!isset($_SERVER['REMOTE_ADDR']) OR preg_match('/^127\..*/i', trim($_SERVER['REMOTE_ADDR'])) OR preg_match('/^172\.16.*/i', trim($_SERVER['REMOTE_ADDR'])) OR preg_match('/^192\.168\.*/i', trim($_SERVER['REMOTE_ADDR'])) OR preg_match('/^10\..*/i', trim($_SERVER['REMOTE_ADDR']))))
		{
			if (strpos($_SERVER['HTTP_X_FORWARDED_FOR'], ','))
			{
				$ips = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
				return $ips[0];
			}
			else
				return $_SERVER['HTTP_X_FORWARDED_FOR'];
		}
		return $_SERVER['REMOTE_ADDR'];
	}
	
	public function getCustomMessage()
	{
		global $smarty;
		$sql = 'SELECT content FROM coc_custom_messages WHERE `status` = 1 LIMIT 1';
		$message = Db::getInstance()->ExecuteS($sql);
		if(count($message) > 0)
			$smarty->assign('usermessage', $message[0]['content']);
	}
	
	public function getWeeks($count, $format = 'F jS, Y')
	{
		$timestamp = strtotime('now');
		$weeks = array();
		$weekCount = 1;
		if(date('D', $timestamp) !== 'Sun')
		{
			$weeks[$weekCount] = date($format, $timestamp).' - '.date($format, strtotime('next Sunday'));
			$weekCount++;
		}
		$weeks[$weekCount] = date($format, strtotime('next Monday')).' - '.date($format, strtotime('Sunday +1 week'));
		for($i = 1;$weekCount < $count;$i++)
		{
			$weekCount++;
			if(date('D', $timestamp) !== 'Mon')
				$weeks[$weekCount] = date($format, strtotime('Monday +'.$i.' week')).' - '.date($format, strtotime('Sunday +'.($i+1).' week'));
			else
				$weeks[$weekCount] = date($format, strtotime('Monday +'.($i+1).' week')).' - '.date($format, strtotime('Sunday +'.($i+1).' week'));
		}
		return $weeks;
	}
	
	public function getWeeksDate($week)
	{
		$tools = new Tools();
		$weeks = $tools->getWeeks(5, 'Y/m/d');
		return $weeks[$week];
	}
}