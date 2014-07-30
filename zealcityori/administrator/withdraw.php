<?php
include "header.php";
?>
<div id="cl-wrapper" class="fixed-menu">
<?php
include('sidebar.php');
$sql="SELECT w.id,w.user_id,w.amount,w.`status`,w.address,w.timestamp,u.username FROM coc_withdraw as w
 		inner join coc_users as u where u.id=w.user_id";
$res=mysql_query($sql);
if(isset($_REQUEST['name']))
if($_REQUEST['name'] && $_REQUEST['name']=='withdraw')
{
	$id=$_REQUEST['id'];
	$sql="SELECT `status` FROM coc_withdraw where id='".$id."'";
	$resulres=mysql_query($sql);
	$rr=mysql_fetch_array($resulres);

	echo'
		<form method="post" action="" onsubmit="upsts();">
			<input type="text" name="txtstatus"/>
			<input type="submit" value="update" onclick=""/>
		</form>
		';
		
}
function upsts()
{
	echo"sdsfsd";
	$sql="UPDATE coc_withdraw SET `status`='".$_REQUEST['txtstatus']."' where id='".$id."'";
	mysql_query($sql);
}

?>
<form action="" name="withdraw_form" method="post">
	<table id="withdraw" border="1" cellpadding="5px" cellspacing="0" align="center">
    	<tr>
        	<td>USERNAME</td>
            <td>AMOUNT</td>
            <td>STATUS</td>
            <td>ADDRESS</td>
            <td>TIMESTAMP</td>
        </tr>
	<?php
		while($result=mysql_fetch_array($res))
		{
			echo '
				<tr>
					<td>'.$result['username'].'</td>
					<td>'.$result['amount'].'</td>
					<td>'.$result['status'].'
						<a href="status.php?id='.$result['id'].'&name=withdraw"><input type="button" value="Edit"/></a>
					</td>
					<td>'.$result['address'].'</td>
					<td>'.$result['timestamp'].'</td>
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