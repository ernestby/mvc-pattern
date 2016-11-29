<?php

class Model
{
	protected $_link;
	protected $_host = 'localhost';
	protected $_user = 'root';
	protected $_password = '';
	protected $_port = '3306';
	protected $_database = 'mvc';

	private function _connect()
	{
		$this->_link = mysqli_init();
		
		if (!$this->_link)
		{
			die('mysqli_init failed.');
		}

		if (!mysqli_options($this->_link, MYSQLI_OPT_CONNECT_TIMEOUT, 5))
		{
			die('Setting MYSQLI_OPT_CONNECT_TIMEOUT failed.');
		}

		mysqli_real_connect($this->_link, $this->_host, $this->_user, $this->_password, $this->_database, $this->_port);
	}

	public function query($sql)
	{
		if (!$this->_link)
		{
			$this->_connect();
		}

		return mysqli_query($this->_link, $sql); 
	}

	public function getAll($sql = null, $start = 0, $limit = null)
	{
		$result = array();

		if (!$this->_link)
		{
			$this->_connect();
		}

		if ($limit != 0)
		{
			$sql .= sprintf(' LIMIT %d, %d', $start, $limit);
		}

		$query = $this->query($sql);		

		while ($row = mysqli_fetch_assoc($query))
		{
			$result[] = $row;
		}

		return $result;
	}

	public function insertUser($data)
	{
		if (!$this->_link)
		{
			$this->_connect();
		}

		$sql = "INSERT INTO users (`login`, `email`, `country_id`, `password`) " .
				"VALUES ('" . 
				mysqli_real_escape_string($this->_link, $data['username']) . "','" . 
				mysqli_real_escape_string($this->_link, $data['email']) . "','" . 
				mysqli_real_escape_string($this->_link, $data['country_id']) . "','" . 
				mysqli_real_escape_string($this->_link, $data['password']) . "')";

		$query = $this->query($sql);
	}

	public function getTotalCount($table_name)
	{
		$sql = "SELECT * FROM {$table_name}";

		$query = $this->query($sql);

		while ($row = mysqli_fetch_assoc($query))
		{
			$result[] = $row;
		}

		return count($result);
	}

	static function generateToken()
	{
		session_start();
		$token = md5(uniqid(mt_rand() . microtime()));
		$_SESSION['token'] = $token;

		return $_SESSION['token'];
	}

	static function checkToken()
	{
		session_start();
		$token = $_POST['token'];

		if ($_SESSION['token'] == $token)
		{
			return true;
		}

		return false;
	}
}