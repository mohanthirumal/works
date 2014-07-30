
<?php
include "header.php";
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
        <a class="list-action-btn" href="">T20</a>
        </td>
        <td>
        <a class="list-action-btn" href="test_points.php">TEST</a>
        </td>
    </tr>
</table>
<?php
	$sql="SELECT * FROM coc_points_system where type='T20'";
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
				<td><input type="text" name="RUN" class="login-txt" value="<?php echo $point['RUN']; ?>"/>
				</td>
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
				<td>30 Runs:</td>
				<td>
					<input type="text" name="30 RUNS" class="login-txt" value="<?php echo $point['30 RUNS'];?>"/>
				</td>
			</tr>
            <tr>
				<td>Strikerate below 100:</td>
				<td>
					<input type="text" name="STRIKE_RATE_BELOW_100" class="login-txt" value="<?php echo $point['STRIKE_RATE_BELOW_100'];?>"/>
				</td>
			</tr>
			<tr>
				<td>Strikerate 100 to 120:</td>
				<td>
					<input type="text" name="STRIKE_RATE_100_TO_120" class="login-txt" value="<?php echo $point['STRIKE_RATE_100_TO_120'];?>"/>
				</td>
			</tr>
			<tr>
				<td>Strikerate 121 to 140:</td>
				<td>
					<input type="text" name="STRIKE_RATE_121_to 140" class="login-txt" value="<?php echo $point['STRIKE_RATE_121_to 140'];?>"/>
				</td>                                  
			</tr>
            <tr>
				<td>Strikerate 141 to 199:</td>
				<td>
					<input type="text" name="STRIKE_RATE_141_to 199" class="login-txt" value="<?php echo $point['STRIKE_RATE_141_to 199'];?>"/>
				</td>                                  
			</tr>
			<tr>
				<td>Strikerate 200 above:</td>
				<td>
					<input type="text" name="STRIKE_RATE_200_AND ABOVE" class="login-txt" value="<?php echo $point['STRIKE_RATE_200_AND ABOVE'];?>"/>
				</td>
			</tr>
			<tr>
				<td>Four 3 to 5:</td>
				<td>
					<input type="text" name="FOUR_3_TO_5" class="login-txt" value="<?php echo $point['FOUR_3_TO_5'];?>"/>
				</td>
			</tr>						
			<tr>
				<td>Four 6 to 9:</td>
				<td>
                	<input type="text" name="FOUR_6_TO_9" class="login-txt" value="<?php echo $point['FOUR_6_TO_9'];?>"/>
				</td>
			</tr>
			<tr>
				<td>Four above 10:</td>
				<td>
                	<input type="text" name="FOUR_10_ABOVE" class="login-txt" value="<?php echo $point['FOUR_10_ABOVE'];?>"/>
                </td>
			</tr>
			<tr>
				<td>Four consecutive:</td>
				<td>
                	<input type="text" name="FOUR_CONSECUTIVE" class="login-txt" value="<?php echo $point['FOUR_CONSECUTIVE'];?>"/>
				</td>
			</tr>
			<tr>
				<td>Six 2 to 3:</td>
				<td>
					<input type="text" name="SIX_2_TO_3" class="login-txt" value="<?php echo $point['SIX_2_TO_3'];?>"/>
				</td>
			</tr>
			<tr>
				<td>Six  4 to 5:</td>
				<td>
					<input type="text" name="SIX_4_TO_5" class="login-txt" value="<?php echo $point['SIX_4_TO_5'];?>"/>
				</td>
			</tr>
			<tr>
				<td>Six above 6:</td>
				<td>
					<input type="text" name="SIX_6_ABOVE" class="login-txt" value="<?php echo $point['SIX_6_ABOVE'];?>"/>
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
            	<td>Economy Above 10:</td>
                <td>
                	<input type="text" name="ECONOMY_RATE_ABOVE_10" class="login-txt" value="<?php echo $point['ECONOMY_RATE_ABOVE_10'];?>"/>
                </td>
            </tr>
            <tr>
            	<td>Economy 9.01 to 9.99:</td>
                <td>
                	<input type="text" name="ECONOMY_RATE_9.01 TO 9.99" class="login-txt" value="<?php echo $point['ECONOMY_RATE_9.01 TO 9.99'];?>"		 					/>
                </td>
            </tr>
            <tr>
            	<td>Economy 8.01 to 9.00:</td>
                <td>
                	<input type="text" name="ECONOMY_RATE_8.01 TO 8.99" class="login-txt" value="<?php echo $point['ECONOMY_RATE_8.01 TO 8.99'];?>"/>
                </td>
            </tr>
            <tr>
            	<td>Economy 7.01 to 8.00:</td>
                <td>
                	<input type="text" name="ECONOMY_RATE_7.01 TO 8.00" class="login-txt" value="<?php echo $point['ECONOMY_RATE_7.01 TO 8.00'];?>"/>
                </td>
            </tr>
            <tr>
            	<td>Economy 6.01 to 7.00:</td>
                <td>
                	<input type="text" name="ECONOMY_RATE_6.01 TO 7.00" class="login-txt" value="<?php echo $point['ECONOMY_RATE_6.01 TO 7.00'];?>"/>
                </td>
            </tr>
            <tr>
            	<td>Economy Below 6:</td>
                <td>
                	<input type="text" name="ECONOMY_RATE_BELOW 6.00" class="login-txt" value="<?php echo $point['ECONOMY_RATE_BELOW 6.00'];?>"/>
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
        <input type="hidden" name="action" value="ttwentyedit"/>
	</form>