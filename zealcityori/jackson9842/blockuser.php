<?php
include "header.php";

if(isset($_REQUEST['action']))
	if($_REQUEST['action'] == 'delete')
	{
		$sql = 'DELETE FROM coc_block_users WHERE id = '.$_REQUEST['id'];
		mysql_query($sql);
	}
	else if($_REQUEST['action'] == 'add')
	{
		$sql = 'INSERT INTO coc_block_users(ip) VALUES(\''.$_REQUEST['ip'].'\')';
		mysql_query($sql);
	}

?>
<h1>Block Users</h1>
<form method="post">
	<h2>Add IP</h2>
	<input type="text" name="ip"/>
	<input type="submit" name="" value="Add"/>
	<input type="hidden" name="action" value="add"/>
</form>
<form action="" name="withdraw_form" method="post">
	<table id="withdraw" border="1" cellpadding="5px" cellspacing="0" align="center">
    	<tr>
        	<td>id</td>
            <td>IP</td>
			 <td>Delete</td>
        </tr>
	<?php
		$sql = "SELECT * from coc_block_users";
		$res = mysql_query($sql);
		while($result=mysql_fetch_array($res))
		{
			echo '
				<tr>
					<td>'.$result['id'].'</td>
					<td>'.$result['ip'].'</td>
					<td><a href="?id='.$result['id'].'&action=delete">Delete</a></td>
				</tr>
			';
		}
    ?>
    </table>
</form>