<?php
if (file_exists('../include/config.php'))
	include_once('../include/config.php');

abstract class Db
{
	/** @var string Server (eg. localhost) */
	protected $_server;

	/** @var string Database user (eg. root) */
	protected $_user;

	/** @var string Database password (eg. can be empty !) */
	protected $_password;

	/** @var string Database type (MySQL, PgSQL) */
	protected $_type;

	/** @var string Database name */
	protected $_database;

	/** @var mixed Ressource link */
	protected $_link;

	/** @var mixed SQL cached result */
	protected $_result;

	/** @var mixed ? */
	protected static $_db;

	/** @var mixed Object instance for singleton */
	protected static $_instance = array();

	protected static $_servers = array(	
	array('server' => _DB_SERVER_, 'user' => _DB_USER_, 'password' => _DB_PASSWD_, 'database' => _DB_NAME_), /* MySQL Master server */
	/* Add here your slave(s) server(s)*/
	/*array('server' => '192.168.0.15', 'user' => 'rep', 'password' => '123456', 'database' => 'rep'),
	array('server' => '192.168.0.3', 'user' => 'myuser', 'password' => 'mypassword', 'database' => 'mydatabase'),
	*/
	);
	
	protected $_lastQuery;
	protected $_lastCached;
	
	protected static $_idServer;

	/**
	 * Get Db object instance (Singleton)
	 *
	 * @param boolean $master Decides wether the connection to be returned by the master server or the slave server
	 * @return object Db instance
	 */
	public static function getInstance($master = 1)
	{
		if ($master OR ($nServers = sizeof(self::$_servers)) == 1)
			$idServer = 0;
		else
			$idServer = ($nServers > 2 AND ($id = ++self::$_idServer % (int)$nServers) !== 0) ? $id : 1;

		if (!isset(self::$_instance[$idServer]))
			self::$_instance[(int)($idServer)] = new MySQL(self::$_servers[(int)($idServer)]['server'], self::$_servers[(int)($idServer)]['user'], self::$_servers[(int)($idServer)]['password'], self::$_servers[(int)($idServer)]['database']);
		
		return self::$_instance[(int)($idServer)];
	}
	
	public function getRessource() { return $this->_link;}
	
	public function __destruct()
	{
		$this->disconnect();
	}

	/**
	 * Build a Db object
	 */
	public function __construct($server, $user, $password, $database)
	{
		$this->_server = $server;
		$this->_user = $user;
		$this->_password = $password;
		$this->_type = _DB_TYPE_;
		$this->_database = $database;

		$this->connect();
	}
	
	public function	autoExecute($table, $values, $type, $where = false, $limit = false, $use_cache = 1)
	{
		if (!sizeof($values))
			return true;

		if (strtoupper($type) == 'INSERT')
		{
			$query = 'INSERT INTO `'.$table.'` (';
			foreach ($values AS $key => $value)
				$query .= '`'.$key.'`,';
			$query = rtrim($query, ',').') VALUES (';
			foreach ($values AS $key => $value)
				$query .= '\''.(is_bool($value) ? (int)$value : $value).'\',';
			$query = rtrim($query, ',').')';
			if ($limit)
				$query .= ' LIMIT '.(int)($limit);
			return $this->q($query, $use_cache);
		}
		elseif (strtoupper($type) == 'UPDATE')
		{
			$query = 'UPDATE `'.$table.'` SET ';
			foreach ($values AS $key => $value)
				$query .= '`'.$key.'` = \''.(is_bool($value) ? (int)$value : $value).'\',';
			$query = rtrim($query, ',');
			if ($where)
				$query .= ' WHERE '.$where;
			if ($limit)
				$query .= ' LIMIT '.(int)($limit);
			return $this->q($query, $use_cache);
		}
		
		return false;
	}
	
	public function	autoExecuteWithNullValues($table, $values, $type, $where = false, $limit = false)
	{
		if (!sizeof($values))
			return true;

		if (strtoupper($type) == 'INSERT')
		{
			$query = 'INSERT INTO `'.$table.'` (';
			foreach ($values AS $key => $value)
				$query .= '`'.$key.'`,';
			$query = rtrim($query, ',').') VALUES (';
			foreach ($values AS $key => $value)
				$query .= (($value === '' || $value === null) ? 'NULL' : '\''.(is_bool($value) ? (int)$value : $value).'\'').',';
			$query = rtrim($query, ',').')';
			if ($limit)
				$query .= ' LIMIT '.(int)($limit);
			return $this->q($query);
		}
		elseif (strtoupper($type) == 'UPDATE')
		{
			$query = 'UPDATE `'.$table.'` SET ';
			foreach ($values AS $key => $value)
				$query .= '`'.$key.'` = '.(($value === '' || $value === null) ? 'NULL' : '\''.(is_bool($value) ? (int)$value : $value).'\'').',';
			$query = rtrim($query, ',');
			if ($where)
				$query .= ' WHERE '.$where;
			if ($limit)
				$query .= ' LIMIT '.(int)($limit);
			return $this->q($query);
		}
		
		return false;
	}

	/*********************************************************
	 * ABSTRACT METHODS
	 *********************************************************/
	
	/**
	 * Open a connection
	 */
	abstract public function connect();

	/**
	 * Get the ID generated from the previous INSERT operation
	 */
	abstract public function Insert_ID();

	/**
	 * Get number of affected rows in previous databse operation
	 */
	abstract public function Affected_Rows();

	/**
	 * Gets the number of rows in a result
	 */
	abstract public function NumRows();

	/**
	 * Delete
	 */
	abstract public function delete ($table, $where = false, $limit = false, $use_cache = 1);
	/**
	 * Fetches a row from a result set
	 */
	abstract public function Execute ($query, $use_cache = 1);

	/**
	 * Fetches an array containing all of the rows from a result set
	 */
	abstract public function ExecuteS($query, $array = true, $use_cache = 1);
	
	/*
	 * Get next row for a query which doesn't return an array 
	 */
	abstract public function nextRow($result = false);
	
	/*
	 * return sql server version.
	 * used in Order.php to allow or not subquery in update
	 */
	abstract public function getServerVersion();

	public static function s($query, $use_cache = 1)
	{
		return Db::getInstance()->ExecuteS($query, true, $use_cache);
	}
	
	public static function ps($query, $use_cache = 1)
	{
		$ret = Db::s($query, $use_cache);
		p($ret);
		return $ret;
	}
	
	public static function ds($query, $use_cache = 1)
	{
		Db::s($query, $use_cache);
		die();
	}
	
	abstract public function getRow($query, $use_cache = 1);
	
	abstract public function getValue($query, $use_cache = 1);
	
	abstract public function getMsgError();
}

function pSQL($string, $htmlOK = false)
{
	if (!is_numeric($string))
	{
		$link = Db::getInstance()->getRessource();
		$string = addslashes($string);
		if (!$htmlOK)
			$string = strip_tags(nl2br2($string));
	}
		
	return $string;
}

function bqSQL($string)
{
	return str_replace('`', '\`', pSQL($string));
}

function nl2br2($string)
{
	return str_replace(array("\r\n", "\r", "\n"), '<br />', $string);
}