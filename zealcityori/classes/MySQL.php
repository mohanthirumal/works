<?php
class MySQL extends Db
{
	public function connect()
	{
		if (!defined('_PS_DEBUG_SQL_'))
			define('_PS_DEBUG_SQL_', false);
		if ($this->_link = mysql_connect($this->_server, $this->_user, $this->_password))
		{
			if (!$this->set_db($this->_database))
				die('The database selection cannot be made.');
		}
		else
			die('Link to database cannot be established.');
		/* UTF-8 support */
		if (!mysql_query('SET NAMES \'utf8\'', $this->_link))
			die(Tools::displayError('PrestaShop Fatal error: no utf-8 support. Please check your server configuration.'));
		return $this->_link;
	}
	
	public function getServerVersion(){
		return mysql_get_server_info();
	}
	
	/* do not remove, useful for some modules */
	public function set_db($db_name) {
		return mysql_select_db($db_name, $this->_link);
	}
	
	public function disconnect()
	{
		if ($this->_link)
			@mysql_close($this->_link);
		$this->_link = false;
	}
	
	public function getRow($query, $use_cache = 1)
	{
		$query .= ' LIMIT 1';
		$this->_result = false;
		$this->_lastQuery = $query;
		if ($this->_link)
			if ($this->_result = mysql_query($query, $this->_link))
			{
				$this->_lastCached = false;
				if (_PS_DEBUG_SQL_)
					$this->displayMySQLError($query);
				$result = mysql_fetch_assoc($this->_result);				
				return $result;
			}
		if (_PS_DEBUG_SQL_)
			$this->displayMySQLError($query);
		return false;
	}

	public function getValue($query, $use_cache = 1)
	{
		$query .= ' LIMIT 1';
		$this->_result = false;
		$this->_lastQuery = $query;		
		if ($this->_link AND $this->_result = mysql_query($query, $this->_link) AND is_array($tmpArray = mysql_fetch_assoc($this->_result)))
		{ 
			$this->_lastCached = false;
			$result =  array_shift($tmpArray);
			return $result;
		}
		return false;
	}
	
	public function Execute($query, $use_cache = 1)
	{
		$this->_result = false;
		if ($this->_link)
		{
			$this->_result = mysql_query($query, $this->_link);
			return $this->_result;
		}
		return false;
	}
	
	public function ExecuteS($query, $array = true, $use_cache = 1)
	{
		$this->_result = false;
		$this->_lastQuery = $query;
		if ($this->_link && $this->_result = mysql_query($query, $this->_link))
		{
			$this->_lastCached = false;
			if (_PS_DEBUG_SQL_)
				$this->displayMySQLError($query);
			if (!$array)
				return $this->_result;
			$resultArray = array();
			// Only SELECT queries and a few others return a valid resource usable with mysql_fetch_assoc
			if ($this->_result !== true)
				while ($row = mysql_fetch_assoc($this->_result))
					$resultArray[] = $row;
			return $resultArray;
		}
		if (_PS_DEBUG_SQL_)
			$this->displayMySQLError($query);
		return false;
	}

	public function nextRow($result = false)
	{
		return mysql_fetch_assoc($result ? $result : $this->_result);
	}
	
	public function delete($table, $where = false, $limit = false, $use_cache = 1)
	{
		$this->_result = false;
		if ($this->_link)
		{
			$query  = 'DELETE FROM `'.bqSQL($table).'`'.($where ? ' WHERE '.$where : '').($limit ? ' LIMIT '.(int)($limit) : '');
			$res =  mysql_query($query, $this->_link);
			if ($use_cache AND _PS_CACHE_ENABLED_)
				Cache::getInstance()->deleteQuery($query);
			return $res;
		}
			
		return false;
	}
	
	public function NumRows()
	{
		if (!$this->_lastCached AND $this->_link AND $this->_result)
		{
			$nrows = mysql_num_rows($this->_result);
			return $nrows;
		}		
	}
	
	public function Insert_ID()
	{
		if ($this->_link)
			return mysql_insert_id($this->_link);
		return false;
	}
	
	public function Affected_Rows()
	{
		if ($this->_link)
			return mysql_affected_rows($this->_link);
		return false;
	}

	protected function q($query, $use_cache = 1)
	{
		global $webservice_call;
		$this->_result = false;
		if ($this->_link)
		{
			$result =  mysql_query($query, $this->_link);
			if ($webservice_call)
				$this->displayMySQLError($query);
			return $result;
		}
		return false;
	}
	
	/**
	 * Returns the text of the error message from previous MySQL operation
	 *
	 * @acces public
	 * @return string error
	 */
	public function getMsgError($query = false)
	{
		return mysql_error($this->_link);
	}

	public function getNumberError()
	{
		return mysql_errno($this->_link);
	}

	public function displayMySQLError($query = false)
	{
		global $webservice_call;
		if ($webservice_call && mysql_errno($this->_link))
			WebserviceRequest::getInstance()->setError(500, '[SQL Error] '.mysql_error($this->_link).'. Query was : '.$query, 97);
		elseif (_PS_DEBUG_SQL_ AND mysql_errno($this->_link) AND !defined('PS_INSTALLATION_IN_PROGRESS'))
		{
			if ($query)
				die(Tools::displayError(mysql_error($this->_link).'<br /><br /><pre>'.$query.'</pre>'));
			die(Tools::displayError((mysql_error($this->_link))));
		}
	}
	
	public static function tryToConnect($server, $user, $pwd, $db, $newDbLink = true)
	{
		if (!$link = @mysql_connect($server, $user, $pwd, $newDbLink))
			return 1;
		if (!@mysql_select_db($db, $link))
			return 2;
		@mysql_close($link);
		return 0;
	}

	public static function tryUTF8($server, $user, $pwd)
	{
		$link = @mysql_connect($server, $user, $pwd);
		if (!mysql_query('SET NAMES \'utf8\'', $link))
			$ret = false;
		else
			$ret = true;
		@mysql_close($link);
		return $ret;
	}
}
