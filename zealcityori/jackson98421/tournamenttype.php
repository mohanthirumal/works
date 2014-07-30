<?php
include "header.php";
?>
<div style="float:left; margin-top:10px; width:100%;">
	<?php if(isset($_REQUEST['action']) && strtoupper($_REQUEST['action']) == 'EDIT'): ?>
	<?php
	$id = $_REQUEST['id'];
	$sql = "SELECT * FROM coc_tournament_type WHERE id = ".$id;
	$result = mysql_fetch_array(mysql_query($sql));	
	?>
	<form method="post" action="process.php" enctype="multipart/form-data">
		<table align="center" width="450px" cellpadding="0" cellspacing="0">
			<tr class="bgcolor">
				<td>Name:</td>
				<td><input type="text" name="txttourtype" class="login-txt" value="<?php echo $result['name']; ?>"/></td>
				<td align="right"><input type="submit" value="Update" class="login-submit-btn"/></td>
			</tr>
		</table>
		<input type="hidden" name="id" value="<?php echo $result['id']; ?>"/>
		<input type="hidden" name="action" value="tourntypeedit"/>
	</form>
	<?php else:?>
	<div class="clear"></div>
	<form action="process.php" method="post" enctype="multipart/form-data">
		<div class="add-item-close-btn" onclick="$('.add-items-trans').hide();"></div>
		<table align="center" width="450px" cellpadding="0" cellspacing="0">
			<tr><td colspan="2" align="center"><h2>Add Tournament Name</h2></td></tr>
			<tr class="bgcolor">
				<td>Name:</td>
				<td><input type="text" name="txttourtype" class="login-txt"/></td>			

				<td><input type="submit" value="Submit" class="login-submit-btn"/></td>
			</tr>
		</table>
		<input type="hidden" name="action" value="tourntype"/>
	</form>
	<table width="50%" class="list" border="1" cellpadding="5px" cellspacing="0" align="center" style="margin-top:20px;">
		<tr class="head">
			<td width="50px" class="first">S.No</td>
			<td>Name</td>
			<td width="50px">Edit</td>
			<td width="50px" class="last">Delete</td>
		</tr>
		<?php
			$count = 1;
			$sql = "SELECT * FROM coc_tournament_type";
			$resultResource = mysql_query($sql);
			while($result = mysql_fetch_array($resultResource))
			{
				echo '
				<tr class='.(($count % 2 == 0)?"even":"odd").'>
					<td>'.$count.'</td>
					<td>'.$result['name'].'</td>
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
		<input type="hidden" name="action" value="deletetourntype"/>
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
