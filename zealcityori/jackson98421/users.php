
<?php
include "header.php";

$sql="select username,email,firstname,lastname,cash,coin,`date_add`,`date_upd`,`ip` from coc_users";
$res=mysql_query($sql);

echo '
	<table id="users" border="1" cellpadding="5px" cellspacing="0" align="center">
		<tr>
			<td>S.No</td>
			<td>USERNAME</td>
			<td>MAIL ID</td>
			<td>CASH</td>
			<td>COIN</td>
			<td>DATE ADD</td>
			<td>DATE LAST LOGIN</td>
			<td>IP</td>
		</tr>
';
$count = 1;
while($result=mysql_fetch_array($res))
{
	echo '
		<tr>
			<td>'.$count.'</td>
			<td>'.$result['username'].'</td>
			<td>'.$result['email'].'</td>
			<td>'.$result['cash'].'</td>
			<td>'.$result['coin'].'</td>
			<td>'.$result['date_add'].'</td>
			<td>'.$result['date_upd'].'</td>
			<td>'.$result['ip'].'</td>
		</tr>
		
	';
	$count++;
}
?>
</table>