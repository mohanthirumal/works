<?php
include "header.php";
?>
<div id="cl-wrapper" class="fixed-menu">
<?php
include('sidebar.php');
if(isset($_REQUEST['action']))
	if($_REQUEST['action'] == 'delete')
	{
		$sql = 'DELETE FROM coc_custom_messages WHERE id = '.$_REQUEST['id'];
		mysql_query($sql);
	}
	else if($_REQUEST['action'] == 'add')
	{
		$sql = 'INSERT INTO coc_custom_messages(content, `status`) VALUES(\''.$_REQUEST['msg'].'\', 1)';
		mysql_query($sql);
	}

?>
<h1>Setting</h1>
<form method="post">
	<h2>Custom Message</h2>
	<input type="text" name="msg"/>
	<input type="submit" name="" value="Add"/>
	<input type="hidden" name="action" value="add"/>
</form>
<form action="" name="withdraw_form" method="post">
	<table id="withdraw" border="1" cellpadding="5px" cellspacing="0" align="center">
    	<tr>
        	<td>id</td>
            <td>Content</td>
			 <td>Delete</td>
        </tr>
	<?php
		$sql = "SELECT * from coc_custom_messages";
		$res = mysql_query($sql);
		while($result=mysql_fetch_array($res))
		{
			echo '
				<tr>
					<td>'.$result['id'].'</td>
					<td>'.$result['content'].'</td>
					<td><a href="?id='.$result['id'].'&action=delete">Delete</a></td>
				</tr>
			';
		}
    ?>
    </table>
</form>
</div>
<?php
include "footer.php";
?>