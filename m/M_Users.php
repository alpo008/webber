<?php

namespace m;

/**
 * Class M_Users
 * @property M_PDO $mpdo
 */
class M_Users
{	
	private static $instance;	
	private $mpdo;				

	public static function Instance()
	{
		if (self::$instance == null) {
			self::$instance = new self;
		}
		return self::$instance;
	}

	public function __construct()
	{
		$this->mpdo = M_PDO::Instance();
	}

	/**
	 * @param $login
	 * @param $password
	 * @return mixed
	 */
	public function Login($login, $password)
	{
		$user = $this->GetByLogin($login);

		if ($user == null || $user['password'] != $password){
			return null;
		}else{
			return $user['id'];
		}
	}

	/**
	 * @param $username
	 * @return mixed
	 */
	public function GetByLogin($username)
	{	
		$t = "SELECT * FROM users WHERE username = '%s'";
		$query = sprintf($t, $username);
		$result = $this->mpdo->Select($query);
		return (isset ($result[0])) ? $result[0] : NULL;
	}
}
