<?php
include "header.php";
$sql="SELECT w.id,w.user_id,w.amount,w.`status`,w.address,w.timestamp,u.username,w.`type`, w.pan_no FROM coc_withdraw as w
 		inner join coc_users as u where u.id=w.user_id ORDER BY `timestamp` DESC";
$res=mysql_query($sql);
if(isset($_REQUEST['name']) && strlen($_REQUEST['name']) > 0)
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
	$sql="UPDATE coc_withdraw SET `status`='".$_REQUEST['txtstatus']."' where id='".$id."'";
	mysql_query($sql);
}

if(isset($_REQUEST['wid']) && strlen($_REQUEST['wid']) > 0)
{
	$withdrawId = $_REQUEST['wid'];
	$username = $_REQUEST['uname'];	
	$sql = "SELECT * FROM `coc_online_withdraw` WHERE withdraw_id = ".$withdrawId."";
	$res = mysql_query($sql);
	echo '
		<table border="1" cellpadding="5px" cellspacing="0" align="center">
			<tr>
				<td>Zealcity Username</td>
				<td>ACC NO</td>
				<td>Acc Name</td>
				<td>Bank Name</td>
				<td>IFSC code</td>
				<td>Mobile</td>
			</tr>
	';
	while($result = mysql_fetch_array($res))
	{
		echo '
			<tr>
				<td>'.$username.'</td>
				<td>'.$result['acc_no'].'</td>
				<td>'.$result['acc_name'].'</td>
				<td>'.$result['bank_name'].'</td>
				<td>'.$result['ifsc_code'].'</td>
				<td>'.$result['mobile'].'</td>
			</tr>
		';	
	}
	echo '</table>';
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
            <td>ID Proof</td>
            <td>Withdraw Type</td>
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
					<td>'.$result['pan_no'].'</td>
					<td>'.$result['type'].'</td>';
					if($result['type'] == 'Online Transfer')
						echo'<td><input type="button" value="Transfer Details" onclick="window.location.href=\'?wid='.$result['id'].'&uname='.$result['username'].'\'"</td>	';
			echo'	</tr>
			';
		}
    ?>
    </table>
</form>