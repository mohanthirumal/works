<?php
class users
{
	var $userid;
	var $username;
	var $email;
	var $avatar;
	var $role;
	var $name;
	
	public function getData()
	{
		if(!isset($_SESSION['users']))
			return false;
		$session = $_SESSION['users'];
		$sql = "SELECT * FROM coc_admin_users WHERE id = '".$session['userId']."'";
		$result = mysql_fetch_array(mysql_query($sql));		
		$this->userid = $result['id'];
		$this->email = $result['email'];
		$this->avatar = $result['avatar'];
		$this->role = $result['role'];
		$this->name = $result['name'];
		return true;
	}
}
?>