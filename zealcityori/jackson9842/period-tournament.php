<?php
include "header.php";
?>
<div style="float:left; margin-top:10px; width:100%;">

	<?php 
	if(isset($_REQUEST['action']) && strtoupper($_REQUEST['action']) == 'USERS')
   	{
    	$id = $_REQUEST['id'];
		$sql = "SELECT * FROM `coc_pt_joined` pj
				INNER JOIN coc_users u ON u.id = pj.user_id
				WHERE pt_id = ".$id."";
		$res = mysql_query($sql);
		echo '<table align="center" border="1" cellpadding="5" cellspacing="0" border="0">
				<tr>
					<td>User ID</td>
					<td>User Name</td>
					<td>Tournament Id</td>
				</tr>';
		while($result = mysql_fetch_array($res))
		{
			echo '	<tr>
						<td>'.$result['user_id'].'</td>
						<td>'.$result['username'].'</td>
						<td>'.$result['pt_id'].'</td>
					</tr>
				';
		}
		echo '</table>';
	}
	?>

	<?php if(isset($_REQUEST['action']) && strtoupper($_REQUEST['action']) == 'EDIT'): ?>
	<?php
	$id = $_REQUEST['id'];
	$sql = "SELECT * FROM coc_period_tournament WHERE id = ".$id;
	$resulta = mysql_fetch_array(mysql_query($sql));
	?>
	<form method="post" action="process.php" enctype="multipart/form-data">
		<table align="center" width="450px" cellpadding="0" cellspacing="0" border="0">
			<tr class="bgcolor">
				<td>Tournament Name:</td>
				<td><input type="text" name="txttourname" class="login-txt" value="<?php echo $resulta['name']; ?>"/></td>
                <td>
			</tr>
            <tr>
				<td>Entry Fee:</td>
				<td>
					<select name="txtentryfee" id="txtentryfee1">
						<?php
						$sql = "SELECT * FROM coc_entry_fee ORDER BY (id ='".$resulta['entry_fee_id']."') DESC, id"; 
						$resultResource = mysql_query($sql);
						while($result = mysql_fetch_array($resultResource))
						{
							echo '<option  value="'.$result['id'].'">'.$result['amount'].'</option>';   //value="'.$result['id'].'"
						}
						?>
					</select>
				</td>
			</tr>
            <tr>
				<td>Players:</td>
				<td>
					<select name="txtplayer" id="txtplayer1">
						<?php
						$sql = "SELECT * FROM coc_players ORDER BY (id ='".$resulta['player_id']."') DESC, id";
						$resultResource = mysql_query($sql);
						while($result = mysql_fetch_array($resultResource))
						{
							echo '<option value="'.$result['id'].'">'.$result['player'].'</option>';   //
						}
						?>
					</select>
                    <a href="players.php">Add New</a>
				</td>
			</tr>
			<tr>
				<td>Kitty Percentage:</td>
				<td>
					<select name="txtkitty" id="txtkitty1">
						<?php
						$sql = "SELECT * FROM coc_kitty ORDER BY (id ='".$resulta['kitty_id']."') DESC, id";
						$resultResource = mysql_query($sql);
						while($result = mysql_fetch_array($resultResource))
						{
							echo '<option value="'.$result['id'].'">'.$result['percentage'].'</option>';   //
						}
						?>
					</select>
				</td>
			</tr>
			<tr>
				<td>Prize:</td>
				<td>
					<?php
                    $sql = "SELECT * FROM coc_pt_prize WHERE pt_id = ".$resulta['id']."";
					
                    $resultResource = mysql_query($sql);
                    $result = mysql_fetch_array($resultResource);
                    echo '<input type="text" name="txtprizepool" id="txtprizepool1" value="'.$result['prize'].'"/>';
                    ?>
				</td>                                  
			</tr>
			<tr>
				<td>Type:</td>
				<td>
					<select name="txttourtype" id="tour_type">
						<?php
						$sql = "SELECT * FROM coc_tournament_type ORDER BY (id ='".$resulta['tournament_type_id']."') DESC, id";
						$resultResource = mysql_query($sql);
						while($result = mysql_fetch_array($resultResource))
						{
							echo '<option value="'.$result['id'].'">'.$result['name'].'</option>'; //
						}
						?>
					</select>
				</td>
			</tr>
            
			<!--<tr>
				<td>Weeks:</td>
				<td>
					<select name="txtweek">
						<?php
						
						$sql = "SELECT * FROM coc_tournament_type ORDER BY (id ='".$resulta['tournament_type_id']."') DESC, id";
						$resultResource = mysql_query($sql);
						while($result = mysql_fetch_array($resultResource))
						{
							echo '<option value="'.$result['id'].'">'.$result['name'].'</option>'; //
						}
						?>
					</select>
				</td>
			</tr>-->
			
			<!--<tr>
				<td>Match:</td>
				<td>
					<select name="match">
						<?php
			//			$sql = "SELECT md.id AS id, t1.teamname AS team1, t2.teamname AS team2, md.match_date,match_name FROM match_details md
//								INNER JOIN team_details t1 ON t1.id = md.team1
//								INNER JOIN team_details t2 ON t2.id = md.team2 ORDER BY (md.id ='".$resulta['match_id']."') DESC, md.id";    
//						$resultResource = mysql_query($sql);
//						while($result = mysql_fetch_array($resultResource))
//						{
//							echo '<option value="'.$result['id'].'">'.date('d-m-Y', $result['match_date']).' - '.$result['team1'].' Vs '.$result['team2'].' - '.$result['match_name'].'</option>';   //
//						}
						?>
					</select>   <!--WHERE match_date >= ".strtotime(date('Y-m-d h:i:s'));-->
				</td>
			</tr>		-->				
			<tr>
				<td>No of Changes:</td>
				<td>
					<input type="text" name="txtchanges" value="<?php echo $resulta['no_of_changes'];?>"/>                	
                </td>
			</tr>
			<tr>
				<td>Endtime:</td>
				<td>
                	<input type="text" name="txtendtime" class="login-txt" id="txtendtime" value="<?php echo $resulta['endtime']; ?>"/>
                	<img src="images/cal.gif" onclick="javascript:NewCssCal('txtendtime','yyyyMMdd','dropdown','false','24','false')" style="cursor:pointer"/>
                </td>
			</tr>
			<tr>
				<td>Salary Cap:</td>
				<td><input type="text" name="txtsalarycap" class="login-txt" value="<?php echo $resulta['salary_cap']; ?>"/></td>
			</tr>
			<tr>
				<td>Recreate:</td>
				<td>
					<select name="recreate">
						<option value="0"<?php echo ($resulta['recreate'] == 0)?' selected':''; ?>>False</option>
						<option value="1"<?php echo ($resulta['recreate'] == 1)?' selected':''; ?>>True</option>
					</select>
				</td>
			</tr>
			<tr>
				<td>Status:</td>
				<td>
					<select name="status">
                    <?php
						$sql = "SELECT * FROM coc_status ORDER BY (id ='".$resulta['status']."') DESC, id";
						$res = mysql_query($sql);
						while($result = mysql_fetch_array($res))
						{
							echo '<option value="'.$result['id'].'">'.$result['name'].'</option>	';
						}
					?>
					</select>
				</td>
			</tr>
			<tr>
				<td>Rule:</td>
				<td>
					<select name="rule">
						<option value="1">Rule 1</option>
						<option value="2">Rule 2</option>
					</select>
				</td>
			</tr>
            <tr>
				<td align="right"><input type="submit" value="Update" class="login-submit-btn"/></td>
			</tr>
		</table>
		<input type="hidden" name="id" value="<?php echo $resulta['id'];?>"/>
        <input type="hidden" name="action" value="periodtournamentedit"/>
	</form>
	<?php else:?>
	<div class="clear"></div>
	<form action="process.php" method="post" enctype="multipart/form-data">
		<div class="add-item-close-btn" onclick="$('.add-items-trans').hide();"></div>
        <div id="tourtable" style="float:left; margin-right:20px; margin-bottom:20px;">
		<table align="center" width="550px" cellpadding="0" cellspacing="0" border="0">
			<tr><td colspan="2" align="center"><h2>Add Tournament</h2></td></tr>
			<tr class="bgcolor">
				<td>Tournament Name:</td>
				<td><input type="text" name="txttourname" class="login-txt"/></td>
			</tr>
			<tr>
				<td>Entry Fee:</td>
				<td>
					<select name="txtentryfee" id="txtentryfee1">
						<?php
						$sql = "SELECT * FROM coc_entry_fee";
						$resultResource = mysql_query($sql);
						while($result = mysql_fetch_array($resultResource))
						{
							echo '<option value="'.$result['id'].'">'.$result['amount'].'</option>';   // 
						}
						?>
					</select>
                    <a href="entryfee.php">Add New</a>
				</td>
			</tr>
			<tr>
				<td>Players:</td>
				<td>
					<select name="txtplayer" id="txtplayer1">
						<?php
						$sql = "SELECT * FROM coc_players";
						$resultResource = mysql_query($sql);
						while($result = mysql_fetch_array($resultResource))
						{
							echo '<option value="'.$result['id'].'">'.$result['player'].'</option>';   //
						}
						?>
					</select>
                    <a href="players.php">Add New</a>
				</td>
			</tr>
			<tr>
				<td>Kitty Percentage:</td>
				<td>
					<select name="txtkitty" id="txtkitty1">
						<?php
						$sql = "SELECT * FROM coc_kitty";
						$resultResource = mysql_query($sql);
						while($result = mysql_fetch_array($resultResource))
						{
							echo '<option value="'.$result['id'].'">'.$result['percentage'].'</option>';   //
						}
						?>
					</select>
                    <a href="kitty.php">Add New</a>
				</td>
			</tr>
			<tr>
				<td>Prize:</td>
				<td>
                	<input type="text" name="txtprizepool" id="period-prizes" />
					<!--<select name="txtprizepool" id="txtprizepool1" onchange="calculatePrize();">
                    	<option>Select</option>
						<?php
						//$sql = "SELECT * FROM coc_prize_pool";
//						$resultResource = mysql_query($sql);
//						while($result = mysql_fetch_array($resultResource))
//						{
//							echo '<option value="'.$result['id'].'">'.$result['name'].'</option>';    // 
//						}
						?>
					</select>
                    <a href="prizepool.php">Add New</a>-->
				</td>                                  
			</tr>
			<tr>
				<td>Type:</td>
				<td>
					<select name="txttourtype"  id="tour_type" onchange="tourdDateList();">
						<?php
						$sql = "SELECT * FROM coc_tournament_type";
						$resultResource = mysql_query($sql);
						while($result = mysql_fetch_array($resultResource))
						{
							echo '<option value="'.$result['id'].'">'.$result['name'].'</option>'; //
						}
						?>
					</select>
					<a href="tournamenttype.php">Add New</a>
				</td>
			</tr>
            <tr id ="series-list">
                <td></td>            
                <td id="series-listdata"  style="display:none;">
                    <select  name="series-match-list" class="series-match-list" id="series-match-list">
                        <option value="0">---Select-----</option>
                        <?php 
                            $now = strtotime(date('Y-m-d'));
                            $sql = 'SELECT * FROM tournament_details WHERE end_date > '.$now;
                            $result = mysql_query($sql);
                            while($resultarray = mysql_fetch_array($result))
                            {
                                echo '<option value="'.$resultarray['id'].'">'.$resultarray['tournament_name'].'</option>';
                            }
                            
                        ?>
                    </select>
                </td>
            </tr>
            <tr id="tdaterow">
            	<td></td>
                <td id="tdatedata" style="display:none;">
                	<select name="datelist" id="datelist" onchange="weekMatches(this);">
                    <option value="0">SELECT</option>
                    	<?php 
                    	$weeks[] = date('F jS, Y', strtotime('now')).' - '.date('F jS, Y', strtotime('next Sunday'));
						$weeks[] = date('F jS, Y', strtotime('Monday next week')).' - '.date('F jS, Y', strtotime('Sunday next week'));
						$weeks[] = date('F jS, Y', strtotime('Monday +1 week')).' - '.date('F jS, Y', strtotime('Sunday +2 week'));
						$weeks[] = date('F jS, Y', strtotime('Monday +2 week')).' - '.date('F jS, Y', strtotime('Sunday +3 week'));
						for($i=0;$i<5;$i++)
						{
							echo '<option value="'.($i+1).'">'.$weeks[$i].'</option>';
						}
						?>
                    </select>
                </td>
            </tr>
            <tr id ="week-match-list">
            	<td></td>
            	<td class="tournament-match-list" id="tournament-match-list"></td>
            </tr>
			<!--<tr>
				<td>Match:</td>
				<td>
					<select name="match">
						//<?php
//						$sql = "SELECT md.id AS id, t1.teamname AS team1, t2.teamname AS team2, match_date,match_name FROM match_details md
//								INNER JOIN team_details t1 ON t1.id = md.team1
//								INNER JOIN team_details t2 ON t2.id = md.team2" ;
//						$resultResource = mysql_query($sql);
//						while($result = mysql_fetch_array($resultResource))
//						{
//							echo '<option value="'.$result['id'].'">'.date('d-m-Y', $result['match_date']).' - '.$result['team1'].' Vs '.$result['team2'].' - '.$result['match_name'].'</option>';   //
//						}
//						?>
					</select>   <!--WHERE match_date >= ".strtotime(date('Y-m-d h:i:s'));-->
				</td>
			</tr>		-->				
			<tr>
				<td>No of Changes:</td>
				<td>
                	<!--<input type="text" name="txtchanges" class="login-txt"/>-->
                    <select name="txtchanges" class="login-txt">
                    	<option>1</option>
                        <option>2</option>
                        <option>3</option>
                        <option>4</option>
                        <option>5</option>
                        <option>6</option>
                        <option>7</option>
                        <option>8</option>
                        <option>9</option>
                        <option>10</option>
                        <option>11</option>
                        <option>12</option>
                        <option>13</option>
                        <option>14</option>
                        <option>15</option>
                        <option>16</option>
                        <option>17</option>
                        <option>18</option>
                        <option>19</option>
                        <option>20</option>
                        <option>21</option>
                        <option>22</option>
                        <option>23</option>
                        <option>24</option>
                        <option>25</option>
                        <option>26</option>
                        <option>27</option>
                        <option>28</option>
                        <option>29</option>
                        <option>30</option>
                    </select>
                </td>
			</tr>
			<tr>
				<td>Endtime:</td>
				<td>
                	<input type="text" name="txtendtime" class="login-txt" id="txtendtime"/>
                	<img src="images/cal.gif" onclick="javascript:NewCssCal('txtendtime','yyyyMMdd','dropdown','false','24','false')" style="cursor:pointer"/>
                </td>
			</tr>
			<tr>
				<td>Salary Cap:</td>
				<td><input type="text" name="txtsalarycap" class="login-txt"/></td>
			</tr>
			<tr>
				<td>Recreate:</td>
				<td>
					<select name="recreate">
						<option value="0">False</option>
						<option value="1">True</option>
					</select>
				</td>
			</tr>
			<tr>
				<td>Status:</td>
				<td>
					<select name="status">
						<option value="Open">Open</option>
						<option value="Closed">Closed</option>
					</select>
				</td>
			</tr>
			<tr>
				<td>Rule:</td>
				<td>
					<select name="rule">
						<option value="1">Rule 1</option>
						<option value="2">Rule 2</option>
					</select>
				</td>
			</tr>			
			<tr>
				<td colspan="2"><input type="submit" value="Submit" class="login-submit-btn" id="period-tourSubmit"/></td>
			</tr>
		</table>
       </div> 
        <div id="prizeval" class="prizeshare" style=" float:left; margin:100px 0 0 0 10px; " >
            <p id="priz" style="  text-align:center; width:250px; "></p>
        </div> 
		<input type="hidden" name="action" value="periodtournament"/>
	</form>
   <!-- <?php
		//if(isset($_REQUEST['action']) && $_REQUEST['action'] == 'filter')
//		{
//			$_SESSION['match_id']= $_POST['filtermatch'];
//			//echo $_SESSION['match_id'];
//		}
//		if(isset($_REQUEST['fnam']) && $_REQUEST['fnam'] == 'fcancel')
//		{
//			unset($_SESSION['match_id']);
//		}
	?>
    <div style="clear:both"></div>
    <form action="tournament.php" method="post">
    	
                <select name="filtermatch">
                    <?php
          //          $sql = "SELECT md.id AS id, t1.teamname AS team1, t2.teamname AS team2, match_date,match_name FROM match_details md
//                            INNER JOIN team_details t1 ON t1.id = md.team1
//                            INNER JOIN team_details t2 ON t2.id = md.team2" ;    
//                    $resultResource = mysql_query($sql);
//					while($result = mysql_fetch_array($resultResource))
//                    {
//                        echo '<option value="'.$result['id'].'">'.date('d-m-Y', $result['match_date']).' - '.$result['team1'].' Vs '.$result['team2'].' - '.$result['match_name'].'</option>';   
//                    }
                    ?>
                </select>
			
			<input type="submit" name="filtersubmit" />
			<a href="?fnam=fcancel"> <input type="button" name="filtercancel" value="Cancel"/></a>
			<input type="hidden" name="action" value="filter"/>
    </form>-->
    
	<table width="80%" class="list" border="1" cellpadding="5px" cellspacing="0" align="center" style="margin-top:20px;">
		<tr class="head">
			<td width="50px" class="first">S.No</td>
			<td>Id</td>
			<td>Tournament Name</td>
            <td>Entry fee</td>
            <td>Players</td>
			<td>Join Players</td>
            <td>Kitty</td>
            <td>Prize</td>
            <td>Type</td>
            <td>Match</td>
            <td>No of changes</td>
            <td>Endtime</td>
            <td>Salary Cap</td>
            <td>Recreate</td>
            <td>Status</td>
            <td>Rule</td>
			<td width="50px">Edit</td>
			<td width="50px" class="last">Delete</td>
            <td></td>
		</tr>
		<?php
			$count = 1;
			//$sql = "SELECT *,t.name as tname,k.percentage as kitty FROM coc_tournament t left outer join coc_kitty as k on k.id=t.kitty_id";				
			$sql =	"SELECT *,t.id as id,t.name as tname,k.percentage as kitty,fee.amount as amt,
					(SELECT count(*) AS joined FROM coc_pt_joined jt WHERE jt.pt_id = t.id) AS joined,
					p.player,pp.prize,ttype.name as `type`,s.name AS `status`,t1.team_nickname as team1,t2.team_nickname AS team2 from coc_period_tournament t
					INNER JOIN coc_kitty AS k ON k.id=t.kitty_id
					INNER JOIN coc_entry_fee fee ON fee.id=t.entry_fee_id
          			INNER JOIN coc_players p ON p.id = t.player_id
					INNER JOIN coc_pt_prize pp ON pp.pt_id=t.id
					INNER JOIN coc_tournament_type ttype ON ttype.id=t.tournament_type_id
					INNER JOIN coc_status s ON s.id = t.`status`
          			INNER JOIN coc_pt_matches pm ON pm.pt_id = t.id
					INNER JOIN match_details mdet ON mdet.id=pm.match_id
					INNER JOIN team_details t1 ON t1.id=mdet.team1
					INNER JOIN team_details t2 ON t2.id=mdet.team2 GROUP BY t.id ";
			if(isset($_SESSION['match_id']))
				$sql .= "where t.match_id='".$_SESSION['match_id']."' order by t.id desc";
			else
				$sql .= "order by t.id desc";
			$resultResource = mysql_query($sql);
			while($result = mysql_fetch_array($resultResource))
			{
				echo '
				<tr class='.(($count % 2 == 0)?"even":"odd").'>
					<td>'.$count.'</td>
					<td>'.$result['id'].'</td>
					<td>'.$result['tname'].'</td>
					<td>'.$result['amt'].'</td>
					<td>'.$result['player'].'</td>
					<td>'.$result['joined'].'</td>
					<td>'.$result['kitty'].'</td>
					<td>'.$result['prize'].'</td>
					<td>'.$result['type'].'</td>
					<td>'.$result['team1'].'<br/>vs<br/>'.$result['team2'].'</td>
					<td>'.$result['no_of_changes'].'</td>
					<td>'.$result['endtime'].'</td>
					<td>'.$result['salary_cap'].'</td>
					<td>'.$result['recreate'].'</td>
					<td>'.$result['status'].'</td>
					<td>'.$result['rule_id'].'</td>
					<td><a class="list-action-btn" href="?action=edit&id='.$result['id'].'">Edit</a></td>
					<td><a class="list-action-btn" href="javascript:submitDelete('.$result['id'].')">Delete</a></td>
					<td><a class="list-action-btn" href="?action=users&id='.$result['id'].'">Joined Users</a></td>
				</tr>
				';																									//
				$count++;
			}
			?>
	</table>
	<form action="process.php" method="post" id="deleteform">
		<input type="hidden" name="id" value="" id="deleteid"/>
		<input type="hidden" name="action" value="deleteperiodtournament"/>
	</form>
   
	<script>
	
	function weekMatches(e)
	{
		var week = e.value;
		$.ajax({
				type: 'POST',
				url: 'ajax.php',
				data: 'action=getweekmatch&id=' + week,
				success: function(data)
				{
					var data = JSON.parse(data);
					
					var html = '';
					for(i = 0;i < data.length;i++)
					{
						html += '<div>'+data[i].t1name+' Vs '+data[i].t2name+'</div>'
					}
					document.getElementById('tournament-match-list').innerHTML = html;

				},
				error: function(XMLHttpRequest, textStatus, errorThrown) {
					// in front-office, do not display technical error
					//alert("TECHNICAL ERROR: unable to perform.\n\nDetails:\nError thrown: " + XMLHttpRequest + "\n" + 'Text status: ' + textStatus);
				}
			});
		
	}
	
	function tourdDateList()
	{
		
		var ttype = document.getElementById('tour_type').value;
		if(ttype == 5)
		{	
			document.getElementById('tdatedata').style.display = 'block';
			document.getElementById('series-listdata').style.display = 'none';
		}
		else if(ttype == 6)
		{
			document.getElementById('series-listdata').style.display = 'block';
			document.getElementById('tdatedata').style.display = 'none';
			document.getElementById('week-match-list').style.display = 'none';
			
		}
	}
	
	function calculatePrize()
	{
		var entryfee=document.getElementById("txtentryfee1");
		var entryfeeval = entryfee.options[entryfee.selectedIndex].text;
		var kitty=document.getElementById("txtkitty1");
		var kittyval = kitty.options[kitty.selectedIndex].text;
		var noofplayers=document.getElementById("txtplayer1");
		var nop=noofplayers.options[noofplayers.selectedIndex].text;
		var p=document.getElementById("txtprizepool1").value;
		totamt=Math.round(entryfeeval*nop);
		kittycommision=Math.round((totamt*kittyval)/100);
		playerpri=totamt-kittycommision;
		//alert(playerpri);
		document.getElementById('priz').style.border = "1px solid #000";
		if(p==1)
		{
			//playerpri=entryfeeval-kittycommision;			
			document.getElementById("priz").innerHTML="kittycommision - " + kittycommision + "<br> playerprize - " + playerpri;
		}
		else if(p==2)
		{
			if(nop<=15)
			{
				firstprize=Math.round((playerpri*66)/100);
				secondprize=Math.round((playerpri*33)/100);				
 				document.getElementById("priz").innerHTML="kittycommision - " + kittycommision + "<br/> firstprize - " + firstprize + "<br/>										 				secondprize - " + secondprize;
			}
			else
			{
				firstprize=Math.round((playerpri*50)/100);
				secondprize=Math.round((playerpri*30)/100);
				thirdprize=Math.round((playerpri*20)/100);
				document.getElementById("priz").innerHTML="kittycommision - " + kittycommision + "<br/> firstprize - " + firstprize + "<br/>           		secondprize	- " + secondprize + "<br> thirdprize - " + thirdprize;
			}
		}
		else if(p==3)
		{
			if(nop<=20)
			{
				firstprize=Math.round((playerpri*33)/100);
				secondprize=Math.round((playerpri*22)/100);
				thirdprize=Math.round((playerpri*16)/100);
				fourthprize=Math.round((playerpri*12)/100);
				fifthprize=Math.round((playerpri*10)/100);
				sixthprize=Math.round((playerpri*7)/100);
				document.getElementById("priz").innerHTML="kittycommision - " + kittycommision + "<br> firstprize - " + firstprize + "<br> 									 	    		secondprize - " + secondprize + "<br> thirdprize - " + thirdprize + "<br> fourthprize - " + fourthprize + "<br> fifthprize - " + 						 				fifthprize + "<br> sixthprize - " + sixthprize;
			}
		}
		else
		{
			alert("select any ");
		}
	}
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