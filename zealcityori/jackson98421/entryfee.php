<?php
include "header.php";
?>
<div style="float:left; margin-top:10px; width:100%;">
	<?php if(isset($_REQUEST['action']) && strtoupper($_REQUEST['action']) == 'EDIT'): ?>
	<?php
	$id = $_REQUEST['id'];
	$sql = "SELECT * FROM coc_entry_fee WHERE id = ".$id;
	$result = mysql_fetch_array(mysql_query($sql));	
	?>
	<form method="post" action="process.php" enctype="multipart/form-data">
		<table align="center" width="450px" cellpadding="0" cellspacing="0">
			<tr class="bgcolor">
				<td>Amount:</td>
				<td><input type="text" name="txtamount" class="login-txt" value="<?php echo $result['amount']; ?>"/></td>
           	</tr>
            <tr>
            	<td>Winner Coin</td>
                <td><input type="text" name="txtwinnercoin" class="login-txt" value="<?php echo $result['winner_coin']; ?>" /></td>
            </tr>
            <tr>
            	<td>Participate Coin</td>
                <td><input type="text" name="txtparticipatecoin" class="login-txt" value="<?php echo $result['participent_coin']; ?>"/></td>
            </tr>
            <tr>
            	<td>Show in create tournament</td>
                <td>
                	<select name="txtusertype">
                    	<option value="0"><?php if($result['user_type'] == 0)echo'No';else echo'Yes'; ?></option>
                        <option value="1"><?php if($result['user_type'] == 0)echo'Yes';else echo'No'; ?></option>
                    </select>
                </td>
            </tr>
            <tr>     
				<td align="right"><input type="submit" value="Update" class="login-submit-btn"/></td>
			</tr>
		</table>
		<input type="hidden" name="id" value="<?php echo $result['id']; ?>"/>
		<input type="hidden" name="action" value="feeedit"/>
	</form>
	<?php else:?>
	<div class="clear"></div>
	<form action="process.php" method="post" enctype="multipart/form-data">
		<div class="add-item-close-btn" onclick="$('.add-items-trans').hide();"></div>
		<table align="center" width="450px" cellpadding="0" cellspacing="0">
			<tr><td colspan="2" align="center"><h2>Add Entry Fee</h2></td></tr>
			<tr class="bgcolor">
				<td>Amount:</td>
				<td><input type="text" name="txtamount" class="login-txt"/></td>			
			</tr>
            <tr>
            	<td>Winner Coin</td>
                <td><input type="text" name="txtwinnercoin" class="login-txt" /></td>
            </tr>
            <tr>
            	<td>Participate Coin</td>
                <td><input type="text" name="txtparticipatecoin" class="login-txt" /></td>
            </tr>
            <tr>
            	<td>Show in create tournament</td>
                <td>
                	<select name="txtusertype">
                    	<option value="">--Select--</option>
                    	<option value="0">No</option>
                        <option value="1">Yes</option>
                    </select>
                </td>
            </tr>
			<tr>	
				<td><input type="submit" value="Submit" class="login-submit-btn"/></td>
			</tr>
		</table>
		<input type="hidden" name="action" value="fee"/>
	</form>
	<table width="50%" class="list" border="1" cellpadding="5px" cellspacing="0" align="center" style="margin-top:20px;">
		<tr class="head">
			<td width="50px" class="first">S.No</td>
			<td>Amount</td>
			<td width="50px">Edit</td>
			<td width="50px" class="last">Delete</td>
		</tr>
		<?php
			$count = 1;
			$sql = "SELECT * FROM coc_entry_fee";
			$resultResource = mysql_query($sql);
			while($result = mysql_fetch_array($resultResource))
			{
				echo '
				<tr class='.(($count % 2 == 0)?"even":"odd").'>
					<td>'.$count.'</td>
					<td>'.$result['amount'].'</td>
					<td><a class="list-action-btn" href="?action=edit&id='.$result['id'].'">Edit</a></td>
					<td><a class="list-action-btn" href="javascript:submitDelete('.$result['id'].')">Delete</a></td>
				</tr>
				';
				$count++;
			}
			?>
	</table>
	<form action="process.php" method="post" id="deleteform">
		<input type="hidden" name="id" value="" id="deleteid"/>
		<input type="hidden" name="action" value="deletefee"/>
	</form>
	<script>
	function submitDelete(id)
	{
		document.getElementById('deleteid').value = id;
		if(confirm('Are you sure!'))
			document.getElementById('deleteform').submit();
	}
	</script>
	<?php endif; ?>
</div>
<?php
include "footer.php";
?>