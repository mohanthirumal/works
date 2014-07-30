<?php
include "header.php";
?>
<div id="cl-wrapper" class="fixed-menu">
<?php
include('sidebar.php');
/*$id = $_REQUEST['id'];
$sql = "SELECT run FROM coc_points_system ";
$resulta = mysql_fetch_array(mysql_query($sql));*/
?>

<table align="right" width="200" border="0">
    <tr>
        <td>
        <a class="list-action-btn" href="odi_points.php">ODI</a>
        </td>
        <td>
        <a class="list-action-btn" href="T20_points.php">T20</a>
        </td>
        <td>
        <a class="list-action-btn" href="">TEST</a>
        </td>
    </tr>
</table>

<?php
	$sql="SELECT * FROM coc_points_system where type='TEST'";
	$result=mysql_query($sql);
	$point=array();
	while($result1=mysql_fetch_array($result))
	{
		$point[$result1["key"]]=$result1["run"];
	}
?>
	<form method="post" action="process.php" enctype="multipart/form-data">
		<table align="center" width="450px" cellpadding="0" cellspacing="0" border="0">
        	<tr>
            	<th align="left">KEY</th>
                <th align="left">RUN</th>
            </tr>
			<tr class="bgcolor">
  				<td>Run:</td>
				<td><input type="text" name="RUN" class="login-txt" value="<?php echo $point['RUN']; ?>"/></td>
			</tr>
            <tr>
            	<td>Half-Century:</td>
				<td>
					<input type="text" name="HALF_CENTURY" class="login-txt" value="<?php echo $point['HALF_CENTURY'];?>"/>	
				</td>
			</tr>
            <tr>
				<td>Century:</td>
				<td>
					<input type="text" name="CENTURY" class="login-txt" value="<?php echo $point['CENTURY'];?>"/>
				</td>
			</tr>
            <tr>
				<td>Double Century:</td>
				<td>
					<input type="text" name="DOUBLE_CENTURY" class="login-txt" value="<?php echo $point['DOUBLE_CENTURY'];?>"/>
				</td>
			</tr>		
			<tr>
				<td>Strikerate above 69:</td>
				<td>
					<input type="text" name="STRIKE_RATE_ABOVE 69" class="login-txt" value="<?php echo $point['STRIKE_RATE_ABOVE 69'];?>"/>
				</td>
			</tr>
			<tr>
				<td>Four 5 to 9:</td>
				<td>
					<input type="text" name="FOUR_5_TO_9" class="login-txt" value="<?php echo $point['FOUR_5_TO_9'];?>"/>
				</td>
			</tr>						
			<tr>
				<td>Four 10 to 14:</td>
				<td>
                	<input type="text" name="FOUR_10_TO 14" class="login-txt" value="<?php echo $point['FOUR_10_TO 14'];?>"/>
				</td>
			</tr>
			<tr>
				<td>Four above 15:</td>
				<td>
                	<input type="text" name="FOUR_ABOVE 15" class="login-txt" value="<?php echo $point['FOUR_ABOVE 15'];?>"/>
                </td>
			</tr>
			<tr>
				<td>Four consecutive:</td>
				<td>
                	<input type="text" name="FOUR_CONSECUTIVE" class="login-txt" value="<?php echo $point['FOUR_CONSECUTIVE'];?>"/>
				</td>
			</tr>
			<tr>
				<td>Six 3 to 4:</td>
				<td>
					<input type="text" name="SIX_3_TO_4" class="login-txt" value="<?php echo $point['SIX_3_TO_4'];?>"/>
				</td>
			</tr>
			<tr>
				<td>Six above 5:</td>
				<td>
					<input type="text" name="SIX_ABOVE 5" class="login-txt" value="<?php echo $point['SIX_ABOVE 5'];?>"/>
				</td>
			</tr>
            <tr>
            	<td>Six Consecutive:</td>
                <td>
                	<input type="text" name="SIX_CONSECUTIVE" class="login-txt" value="<?php echo $point['SIX_CONSECUTIVE'];?>"/>
                </td>
			</tr>
            <tr>
            	<td>Maidens:</td>
                <td>
                	<input type="text" name="MAIDENS" class="login-txt" value="<?php echo $point['MAIDENS'];?>"/>
                </td>
			</tr>
            <tr>
            	<td>Wickets:</td>
                <td>
                	<input type="text" name="WICKETS" class="login-txt" value="<?php echo $point['WICKETS'];?>"/>
                </td>
            </tr>
            <tr>
            	<td>Wickets 3 Haul:</td>
                <td>
                	<input type="text" name="WICKET_3_HAUL" class="login-txt" value="<?php echo $point['WICKET_3_HAUL'];?>"/>
                </td>
            </tr>
            <tr>
            	<td>Wickets 5 Haul</td>
                <td>
                	<input type="text" name="WICKET_5_HAUL" class="login-txt" value="<?php echo $point['WICKET_5_HAUL'];?>"/>
                </td>
            </tr>
            <tr>
            	<td>Wides:</td>
                <td>
                	<input type="text" name="WIDES" class="login-txt" value="<?php echo $point['WIDES'];?>"/>
                </td>
            </tr>
            <tr>
            	<td>No Balls:</td>
                <td>
                	<input type="text" name="NO_BALLS" class="login-txt" value="<?php echo $point['NO_BALLS'];?>"/>
                </td>
            </tr>
            <tr>
            	<td>Byes:</td>
                <td>
                	<input type="text" name="BYES" class="login-txt" value="<?php echo $point['BYES'];?>"/>
                </td>
            </tr>
            <tr>
            	<td>Catch:</td>
                <td>
                	<input type="text" name="CATCH" class="login-txt" value="<?php echo $point['CATCH'];?>"/>
                </td>
            </tr>
            <tr>
            	<td>Runout:</td>
                <td>
                	<input type="text" name="RUNOUT" class="login-txt" value="<?php echo $point['RUNOUT'];?>"/>
                </td>
            </tr>
            <tr>
            	<td>Stumping:</td>
                <td>
                	<input type="text" name="STUMPING" class="login-txt" value="<?php echo $point['STUMPING'];?>"/>
                </td>
            </tr>
            <tr>
            	<td>Captian:</td>
                <td>
                	<input type="text" name="CAPTAIN" class="login-txt" value="<?php echo $point['CAPTAIN'];?>"/>
                </td>
            </tr>
            <tr>
            	<td>coach:</td>
                <td>
                	<input type="text" name="COACH" class="login-txt" value="<?php echo $point['COACH'];?>"/>
                </td>
            </tr>
            <tr>
				<td align="right"><input type="submit" value="Update" class="login-submit-btn"/></td>
			</tr>
		</table>
		<input type="hidden" name="id" value="<?php echo $resulta['id'];?>"/>
        <input type="hidden" name="action" value="testpointedit"/>
	</form>
	</div>
<?php
include "footer.php";
?>