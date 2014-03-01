<?php

class Table_Users extends DB
{
	private $tb = 'users';
	function addUser($username, $email, $pass)
	{
		$query = "INSERT INTO " . $this->tb . "(username, email, password, create_date, visit_date, type)
VALUE('" . $this->escape($username) . "', '" . $this->escape($email) . "', '" . $this->escape($pass) . "', NOW(), NOW(), 2)";
		$res = mysql_query($query);

		if ($res) {
			return mysql_insert_id();
		}

		return false;
	}

	function updateUserInfo($array, $id)
	{
		$update = array();
		foreach ($array as $key => $val) {
			$val = $this->escape($val);
			$update[] = "`$key` = '$val'";
		}

		$query ="UPDATE " . $this->tb . " SET " . implode(',', $update) . " WHERE id = " . intval($id);
		return mysql_query($query);
	}

	function delUser($id)
	{
		$query = 'DELETE FROM ' . $this->tb . ' WHERE id=' . intval($id);
		return mysql_query($query);
	}

	function getUserForLogin($login, $pass)
	{
		$login = $this->escape($login);

		$query = "SELECT id, username, email, type, lang FROM " . $this->tb . " WHERE (username='" . $login . "' OR email='" . $login . "') AND password='" . $this->pass($pass) . "' LIMIT 1";
		$res = mysql_query($query);

		if (mysql_num_rows($res)) {
			return mysql_fetch_assoc($res);
		}

		return false;
	}

	function getUserById($id)
	{
		$query = "SELECT id, username, email, type, lang FROM " . $this->tb . " WHERE id=" . intval($id) . " LIMIT 1";
		$res = mysql_query($query);

		if (mysql_num_rows($res)) {
			return mysql_fetch_assoc($res);
		}

		return false;
	}

	function getUserByUsername($username)
	{
		$query = "SELECT id, username, email, type, lang FROM " . $this->tb . " WHERE username='" . $username . "' LIMIT 1";
		$res = mysql_query($query);

		if (mysql_num_rows($res)) {
			return mysql_fetch_assoc($res);
		}

		return false;
	}


	function getUserByEmail($email)
	{
		$query = "SELECT id, username, email, type, lang FROM " . $this->tb . " WHERE email='" . $email . "' LIMIT 1";
		$res = mysql_query($query);

		if (mysql_num_rows($res)) {
			return mysql_fetch_assoc($res);
		}

		return false;
	}

	function getUserByUserKey($username, $key)
	{
		$query = "SELECT id, username, email, type, lang FROM " . $this->tb . " WHERE username='" . $this->escape($username) . "' AND visit_key='" . $this->escape($key) . "' LIMIT 1";
		$res = mysql_query($query);

		if (mysql_num_rows($res)) {
			return mysql_fetch_assoc($res);
		}

		return false;
	}

	function getUserByLoginOrEmail($login=null, $email=null)
	{
		if (empty($email)) {
			$email = $login;
		}
		$login = $this->escape($login);

		$query = "SELECT id, username, email, type, lang FROM " . $this->tb . " WHERE username='" . $login . "' OR email='" . $email . "' LIMIT 1";
		$res = mysql_query($query);

		if (mysql_num_rows($res)) {
			return mysql_fetch_assoc($res);
		}

		return null;
	}

	function verificationPassword($id, $pass)
	{
		$pass = $this->pass($pass);

		$query = "SELECT id FROM " . $this->tb . " WHERE password='" . $pass . "' AND id=" . intval($id) . " LIMIT 1";
		$res = mysql_query($query);

		if (mysql_num_rows($res)) {
			return true;
		}

		return false;
	}

// MYSQL

}
