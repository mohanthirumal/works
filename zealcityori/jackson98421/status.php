
<?php
	include "header.php";
	
	$id=$_REQUEST['id'];
	$sql="SELECT * FROM coc_withdraw where id='".$id."'";
	$res=mysql_query($sql);
	$result=mysql_fetch_array($res);
	$status=$result['status'];
	if(isset($_POST['submit']))
	{
		$sql="UPDATE coc_withdraw SET `status`='".$_POST['withdrawstatus']."' where id='".$id."'";
		mysql_query("$sql");
		header("Location: withdraw.php");
	}
	
	
	if($_REQUEST['name']=='withdraw')
	{
?>
    <form action="" method="post">
        <table>
            <tr>
                <td>
                	<select name="withdrawstatus">
                		<option value="pending" <?php echo ($status == "pending") ?  "selected" : '' ?>>pending</option>
                        <option value="approved" <?php echo($status == "approved") ?  "selected" : '' ?>>approved</option>
                        <option value="sent" <?php echo ($status == "sent")?  "selected" : '' ?>>sent</option>
                    </select>
                </td>
                <td><input type="submit" name="submit" value="Update"/></td> 
            </tr>
        </table>
    </form>
<?php
	}
	$id1=$_REQUEST['did'];
	$sql="SELECT * FROM coc_deposit where id='".$id1."'";
	$res1=mysql_query($sql);
	$result1=mysql_fetch_array($res1);
	$status1=$result1['status'];
	if($_REQUEST['name']=='deposit')
	{
?>
	<form action="" method="post">
		<table>
			<tr>
				<td>
                	<select name="depositstatus">
                    	<option value="failure" <?php echo($status1 == "failure") ?  "selected" : '' ?>>failure</option>
                        <option value="success" <?php echo($status1 == "success") ?  "selected" : '' ?>>success</option>
                    </select>                
                </td>
				<td><input type="submit" name="submit1" value="Update"/></td> 
			</tr>
		</table>
	</form>
<?php
	}	
	if(isset($_POST['submit1']))
	{
		echo "sdfsdfs";
		$sql="UPDATE coc_deposit SET `status`='".$_POST['depositstatus']."' where id='".$id1."'";
		mysql_query($sql);
		header("Location: deposit.php");
	}
?>