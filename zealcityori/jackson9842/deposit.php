<?php
include "header.php";


$sql="SELECT d.id,d.user_id,d.amount,d.`status`,d.payment_id,d.timestamp,u.username FROM coc_deposit as d
 		inner join coc_users as u where u.id=d.user_id";
$res=mysql_query($sql);

?>
<form action="" name="deposit_form" method="post">
	<table id="deposit" border="1" cellpadding="5px" cellspacing="0" align="center">
    	<tr>
        	<td>USERNAME</td>
            <td>AMOUNT</td>
            <td>STATUS</td>
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
						<a href="status.php?did='.$result['id'].'&name=deposit"><input type="button" value="Edit"/></a>
					</td>
					<td>'.$result['timestamp'].'</td>
				</tr>
			';
		}
    ?>
    </table>
</form>