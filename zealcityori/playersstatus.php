<?php
include('include/config.php');

?>
<html>
<head>
</head>
<title></title>
<body>
<div class="playerStatusContainnor">
<?php
$sql="SELECT *,players.id AS playerid,batstyle.player_style AS battingstyle,bowlingstyle.player_style AS bowlingstyle FROM players
		LEFT JOIN country ON country.id=player_country
		LEFT JOIN players_type ON players_type.id=players.player_type
		LEFT JOIN players_style batstyle ON batstyle.id=players.bat_style
		LEFT JOIN players_style bowlingstyle ON bowlingstyle.id=players.bow_style
		LEFT JOIN main_role ON main_role.id=players.main_role WHERE players.id='".$_REQUEST['playerId']."'" ;
$result=$result=Db::getInstance()->getRow($sql);
?>
<div class="imagesContainnor">
	<div class="imagesContainnorinner">
    <img style="width:160px; height:160px; margin:10px 0 0 10px; border-radius:8px;-moz- border-radius:8px;-webkit- border-radius:8px;" src="<?php echo FLAG_URL;?>players/<?php echo $result['photo_url'];  ?>" />
    <div class="playernameClass" style="margin-top:5px;"><?php echo  $result['player_name']; ?></div>
    <div class="playernameClass" style="font-size:12px;color:#4B4B4B; font-weight:none;"><?php echo  $result['country_name']; ?></div>
    </div>
</div>
<div class="profiledetailsContainnor">
	<div class="containorClass">Full Name :</div>
    <div class="containorClass1"><?php echo  $result['full_player_name']; ?></div>
	<div class="containorClass" style="margin-top:10px; ">Born:</div>
    <div class="containorClass1" style="margin-top:10px;"><?php echo date('F j, Y,' ,$result['dob']).$result['birth_place']; ?></div>
	<div class="containorClass" style="margin-top:10px; ">Current age:</div>
    <div class="containorClass1" style="margin-top:10px; ">
	<?php 
			date_default_timezone_set('Asia/Calcutta');
			$localtime = getdate();
			
			$dob = date('d-m-Y',$result['dob']) ;  
			//$today = date("d-m-Y");
			$today = $localtime['mday']."-".$localtime['mon']."-".$localtime['year'];
			
			$dob_a = explode("-", $dob);
			$today_a = explode("-", $today);
			
			$dob_d = $dob_a[0];
			$dob_m = $dob_a[1];
			$dob_y = $dob_a[2];
			
			$today_d = $today_a[0];
			$today_m = $today_a[1];
			$today_y = $today_a[2];
			
			$years = $today_y - $dob_y;
			$months = $today_m - $dob_m;
			$days=$dob_d-$today_d;
			
			if ($today_m.$today_d < $dob_m.$dob_d) {
			$years--;
			$months = 12 + $today_m - $dob_m;
			
			}
			
			if ($today_d < $dob_d) {
			$months--;
			}
			
			$firstMonths=array(1,3,5,7,8,10,12);
			$secondMonths=array(4,6,9,11);
			$thirdMonths=array(2);
			
			if($today_m - $dob_m == 1) 
			{
			if(in_array($dob_m, $firstMonths)) 
			{
			array_push($firstMonths, 0);
			}
			elseif(in_array($dob_m, $secondMonths)) 
			{
			array_push($secondMonths, 0);
			}
			elseif(in_array($dob_m, $thirdMonths)) 
			{
			array_push($thirdMonths, 0);
			}
			}
			echo $years."&nbsp;years&nbsp;".$months."&nbsp;months&nbsp;".$days."&nbsp;days" ;	
		 ?>
	</div>
	<div class="containorClass" style="margin-top:10px;">major Team:</div>
    <div class="containorClass1" style="margin-top:10px;">
    <?php
	echo $result['major_teams'];
	?>
    </div>
    <?php if($result['nick_name'] !=''){ ?>
	<div class="containorClass" style="margin-top:10px;">Nick name :</div>
    <div class="containorClass1" style="margin-top:10px;">
	<?php echo $result['nick_name'];?>
    </div>
    <?php }?>
    <?php if($result['main_role'] !=''){ ?>
	<div class="containorClass" style="margin-top:10px">Playing role :</div>
    <div class="containorClass1" style="margin-top:10px;">
    <?php echo $result['main_role'];?>
    </div>
    <?php } ?>
    <?php if($result['battingstyle'] !=''){ ?>
	<div class="containorClass" style="margin-top:10px; ">Batting style :</div>
    <div class="containorClass1" style="margin-top:10px;">
    <?php
	echo $result['battingstyle'];
	?>
    </div>
    <?php } ?>
    
    <?php if($result['bowlingstyle'] !=''){ ?>
	<div class="containorClass" style="margin-top:10px;">Bowling style :</div>
    <div class="containorClass1" style="margin:10px 0 10px 0;">
    <?php
	echo $result['bowlingstyle'];
	?>
    </div>
    <?php } ?>
</div>
<div class="secondClasscontainnor1">Batting and fielding details</div>
    <div class="secondClasscontainnor1" style="background:#D7D7D7; width:98%; height:25px;">
        <!--<div class="t-20Class t-20ClassActive" id="mainContain1" onClick="displyContain(1);">T-20i</div>
        <div class="interclassContainnor"></div>-->
        <div class="t-20Class  t-20ClassActive" id="mainContain2" onClick="displyContain(2);">50-50</div>
        <div class="interclassContainnor"></div>
       <!-- <div class="t-20Class" id="mainContain3"  onclick="displyContain(3);">Test</div>
        <div class="interclassContainnor"></div>
        <div class="t-20Class" id="mainContain4" style="width:90px;"  onclick="displyContain(4);">First-class</div>
        <div class="interclassContainnor"></div>
        <div class="t-20Class" id="mainContain5" style="width:80px;"  onclick="displyContain(5);">List-A</div>
        <div class="interclassContainnor"></div>-->
        <div class="t-20Class" id="mainContain6" style="width:140px;"  onclick="displyContain(6);">Indian T-20 League </div>
    </div>
    <div class="secondClasscontainnor1" style="background:#EFEFEF; width:98%; height:20px; margin-top:3px;">
        <div class="innerclassContainnor">Mat</div>
        <div class="innerclassContainnor" id="2">Inns</div>
        <div class="innerclassContainnor">NO</div>
        <div class="innerclassContainnor" id="battingrunsId" style="width:60px">Runs</div>
        <div class="innerclassContainnor">HS</div>
        <div class="innerclassContainnor">BF</div>
        <div class="innerclassContainnor" id="7">Avg</div>
        <div class="innerclassContainnor">SR</div>
        <div class="innerclassContainnor">100's</div>
        <div class="innerclassContainnor">50's</div>
        <div class="innerclassContainnor">4's</div>
        <div class="innerclassContainnor">6's</div>
        <div class="innerclassContainnor">Cts</div>
        <div class="innerclassContainnor">st</div>
    </div>
    <div  class="border-bottom-containnor"></div>
    <?php
		$sql="SELECT *,ifnull(ROUND(total_runs/ball_face*100,2) ,'') AS SR FROM t_20_players WHERE player_id='".$_REQUEST['playerId']."'";
		$result=$result=Db::getInstance()->getRow($sql);
	?>
    
    
    <div class="secondClasscontainnor" id="displyContain1"  style="background:#FFF; width:98%; height:20px; margin-top:3px;display:none;" >
        <div class="innerclassContainnor"><?php echo $result['total_match']; ?></div>
        <div class="innerclassContainnor" ><?php echo $result['total_bat_inning']; ?></div>
        <div class="innerclassContainnor"><?php echo $result['not_out']; ?></div>
        <div class="innerclassContainnor" style="width:90px;"><?php echo $result['total_runs']; ?></div>
        <div class="innerclassContainnor"><?php echo $result['high_runs']; ?></div>
        <div class="innerclassContainnor"><?php echo $result['ball_face']; ?></div>
       	<div class="innerclassContainnor"><?php echo $result['SR']; ?></div>
        <div class="innerclassContainnor"><?php echo $result['hundereds']; ?></div>
        <div class="innerclassContainnor"><?php echo $result['fifty']; ?></div>
        <div class="innerclassContainnor"><?php echo $result['total_fours']; ?></div>
        <div class="innerclassContainnor"><?php echo $result['total_sixs']; ?></div>
        <div class="innerclassContainnor"><?php echo $result['catches']; ?></div>
        <div class="innerclassContainnor"><?php echo $result['total_stumped']; ?></div>
    </div>

    <?php
		$sql="SELECT *,ifnull(ROUND(total_runs/ball_face*100,2) ,'') AS SR FROM oneday_players WHERE player_id='".$_REQUEST['playerId']."'";
		$result=$result=Db::getInstance()->getRow($sql);
	?>
    
    
    <div class="secondClasscontainnor" id="displyContain2"  style="background:#FFF; width:98%; height:20px; margin-top:3px; display:block;">
        <div class="innerclassContainnor"><?php echo $result['total_match']; ?></div>
        <div class="innerclassContainnor"><?php echo $result['total_bat_inning']; ?></div>
        <div class="innerclassContainnor"><?php echo $result['not_out']; ?></div>
        <div class="innerclassContainnor" style="width:60px;"><?php echo $result['total_runs']; ?></div>
        <div class="innerclassContainnor"><?php echo $result['high_runs']; ?></div>
        <div class="innerclassContainnor"><?php echo $result['ball_face']; ?></div>
        <div class="innerclassContainnor"><?php 
		$test=$result['total_bat_inning']-$result['not_out'];
		if($result['total_bat_inning'] > 0 && $result['not_out'] > 0 && $test !=0)
		{  echo round($result['total_runs']/($result['total_bat_inning']-$result['not_out']),2);
		}
		else 
		{ echo '-';
		}
		?></div>
        <div class="innerclassContainnor"><?php echo $result['SR']; ?></div>
        <div class="innerclassContainnor"><?php echo $result['hundereds']; ?></div>
        <div class="innerclassContainnor"><?php echo $result['fifty']; ?></div>
        <div class="innerclassContainnor"><?php echo $result['total_fours']; ?></div>
        <div class="innerclassContainnor"><?php echo $result['total_sixs']; ?></div>
        <div class="innerclassContainnor"><?php echo $result['catches']; ?></div>
        <div class="innerclassContainnor"><?php echo $result['total_stumped']; ?></div>
     </div>
    
    <?php
		$sql="SELECT *,ifnull(ROUND(total_runs/ball_face*100,2) ,'') AS SR FROM test_players WHERE player_id='".$_REQUEST['playerId']."'";
		$result=$result=Db::getInstance()->getRow($sql);
	?>
    
    
    <div class="secondClasscontainnor" id="displyContain3"  style="background:#FFF; width:98%; height:20px; margin-top:3px; display:none;">
        <div class="innerclassContainnor"><?php echo $result['total_match']; ?></div>
        <div class="innerclassContainnor"><?php echo $result['total_bat_inning']; ?></div>
        <div class="innerclassContainnor"><?php echo $result['not_out']; ?></div>
        <div class="innerclassContainnor" style="width:90px"><?php echo $result['total_runs']; ?></div>
        <div class="innerclassContainnor"><?php echo $result['high_runs']; ?></div>
        <div class="innerclassContainnor"><?php echo $result['ball_face']; ?></div>
        <div class="innerclassContainnor"><?php echo $result['SR']; ?></div>
        <div class="innerclassContainnor"><?php echo $result['hundereds']; ?></div>
        <div class="innerclassContainnor"><?php echo $result['fifty']; ?></div>
        <div class="innerclassContainnor"><?php echo $result['total_fours']; ?></div>
        <div class="innerclassContainnor"><?php echo $result['total_sixs']; ?></div>
        <div class="innerclassContainnor"><?php echo $result['catches']; ?></div>
        <div class="innerclassContainnor"><?php echo $result['total_stumped']; ?></div>
    </div>
    
    
    <?php
		$sql="SELECT *,ifnull(ROUND(total_runs/ball_face*100,2) ,'') AS SR FROM first_class_players WHERE player_id='".$_REQUEST['playerId']."'";
		$result=$result=Db::getInstance()->getRow($sql);
	?>
    
    
    <div class="secondClasscontainnor" id="displyContain4"  style="background:#FFF; width:98%; height:20px; margin-top:3px; display:none;">
        <div class="innerclassContainnor"><?php echo $result['total_match']; ?></div>
        <div class="innerclassContainnor"><?php echo $result['total_bat_inning']; ?></div>
        <div class="innerclassContainnor"><?php echo $result['not_out']; ?></div>
        <div class="innerclassContainnor" style="width:90px"><?php echo $result['total_runs']; ?></div>
        <div class="innerclassContainnor"><?php echo $result['high_runs']; ?></div>
        <div class="innerclassContainnor"><?php echo $result['ball_face']; ?></div>
        <div class="innerclassContainnor"><?php echo $result['SR']; ?></div>
        <div class="innerclassContainnor"><?php echo $result['hundereds']; ?></div>
        <div class="innerclassContainnor"><?php echo $result['fifty']; ?></div>
        <div class="innerclassContainnor"><?php echo $result['total_fours']; ?></div>
        <div class="innerclassContainnor"><?php echo $result['total_sixs']; ?></div>
        <div class="innerclassContainnor"><?php echo $result['catches']; ?></div>
        <div class="innerclassContainnor"><?php echo $result['total_stumped']; ?></div>
    </div>
    
    <?php
		$sql="SELECT *,ifnull(ROUND(total_runs/ball_face*100,2) ,'') AS SR FROM list_a_players WHERE player_id='".$_REQUEST['playerId']."'";
		$result=$result=Db::getInstance()->getRow($sql);
	?>
    
    
    <div class="secondClasscontainnor" id="displyContain5"  style="background:#FFF; width:98%; height:20px; margin-top:3px; display:none;">
        <div class="innerclassContainnor"><?php echo $result['total_match']; ?></div>
        <div class="innerclassContainnor"><?php echo $result['total_bat_inning']; ?></div>
        <div class="innerclassContainnor"><?php echo $result['not_out']; ?></div>
        <div class="innerclassContainnor" style="width:90px"><?php echo $result['total_runs']; ?></div>
        <div class="innerclassContainnor"><?php echo $result['high_runs']; ?></div>
        <div class="innerclassContainnor"><?php echo $result['ball_face']; ?></div>
        <div class="innerclassContainnor"><?php echo $result['SR']; ?></div>
        <div class="innerclassContainnor"><?php echo $result['hundereds']; ?></div>
        <div class="innerclassContainnor"><?php echo $result['fifty']; ?></div>
        <div class="innerclassContainnor"><?php echo $result['total_fours']; ?></div>
        <div class="innerclassContainnor"><?php echo $result['total_sixs']; ?></div>
        <div class="innerclassContainnor"><?php echo $result['catches']; ?></div>
        <div class="innerclassContainnor"><?php echo $result['total_stumped']; ?></div>
    </div>

    <?php
		$sql="SELECT *,ifnull(ROUND(total_runs/ball_face*100,2) ,'') AS SR FROM twenty20_players WHERE player_id='".$_REQUEST['playerId']."'";
		$result=$result=Db::getInstance()->getRow($sql);
	?>
    
    
    <div class="secondClasscontainnor" id="displyContain6"  style="background:#FFF; width:98%; height:20px; margin-top:3px; display:none;">
        <div class="innerclassContainnor"><?php echo $result['total_match']; ?></div>
       <!-- <div class="innerclassContainnor"><?php echo $result['total_bat_inning']; ?></div>-->
        <div class="innerclassContainnor"><?php echo $result['not_out']; ?></div>
        <div class="innerclassContainnor" style="width:90px"><?php echo $result['total_runs']; ?></div>
        <div class="innerclassContainnor"><?php echo $result['high_runs']; ?></div>
        <div class="innerclassContainnor"><?php echo $result['ball_face']; ?></div>
        <div class="innerclassContainnor"><?php echo $result['SR']; ?></div>
        <div class="innerclassContainnor"><?php echo $result['hundereds']; ?></div>
        <div class="innerclassContainnor"><?php echo $result['fifty']; ?></div>
        <div class="innerclassContainnor"><?php echo $result['total_fours']; ?></div>
        <div class="innerclassContainnor"><?php echo $result['total_sixs']; ?></div>
        <div class="innerclassContainnor"><?php echo $result['catches']; ?></div>
        <div class="innerclassContainnor"><?php echo $result['total_stumped']; ?></div>
    </div>
	<div  class="border-bottom-containnor"></div>
    
    
    
    
    
	<div class="secondClasscontainnor1">Bowling averages</div>
    <div class="secondClasscontainnor1" style="background:#EFEFEF; width:98%; height:20px; margin-top:3px;">
        <div class="innerclassContainnor">Mat</div>
        <div class="innerclassContainnor" id="inngingsIds">Inns</div>
        <div class="innerclassContainnor">Balls</div>
        <div class="innerclassContainnor" style="width:90px">Runs</div>
        <div class="innerclassContainnor">Wkts</div>
        <div class="innerclassContainnor">BBI</div>
        <div class="innerclassContainnor">BBM</div>
        <div class="innerclassContainnor">Ave</div>
        <div class="innerclassContainnor">Econ</div>
        <div class="innerclassContainnor">SR</div>
        <div class="innerclassContainnor" id ="threewickets" style="display:none">3w</div>
        <div class="innerclassContainnor">5w</div>
        <div class="innerclassContainnor">10w</div>
    </div>
    <div  class="border-bottom-containnor"></div>


    <?php
		$sql="SELECT *,ifnull(ROUND(over_runs/total_wickets,2) ,'-') AS AVg,ifnull(ROUND(total_overs/total_wickets,2) ,'-') AS SR,ifnull(ROUND(over_runs*6/total_overs,2) ,'-') AS EC FROM t_20_players WHERE player_id='".$_REQUEST['playerId']."'";
		$result=$result=Db::getInstance()->getRow($sql);
	?>
    
    
    <div class="secondClasscontainnor2" id="displyContain11"  style="background:#FFF; width:98%; height:20px; margin-top:3px;display:none;">
        <div class="innerclassContainnor"><?php echo $result['total_match']; ?></div>
        <div class="innerclassContainnor"><?php echo $result['total_bowl_inning']; ?></div>
        <div class="innerclassContainnor"><?php echo $result['total_overs']; ?></div>
        <div class="innerclassContainnor" style="width:90px"><?php echo $result['over_runs']; ?></div>
        <div class="innerclassContainnor"><?php echo $result['total_wickets']; ?></div>
        <div class="innerclassContainnor"><?php echo $result['bbiwickets'].'/'.$result['bbiruns']; ?></div>
        <div class="innerclassContainnor"><?php echo $result['bbmwickets'].'/'.$result['bbmruns']; ?></div>
        <div class="innerclassContainnor"><?php echo $result['AVg']; ?></div>
        <div class="innerclassContainnor"><?php echo $result['EC']; ?></div>
        <div class="innerclassContainnor"><?php echo $result['SR']; ?></div>
        <div class="innerclassContainnor" ><?php echo isset($result['three_wickets'])?$result['three_wickets']:'-'; ?></div>
        <div class="innerclassContainnor"><?php echo isset($result['five_wickets'])?$result['five_wickets']:'-'; ?></div>
        <div class="innerclassContainnor"><?php echo isset($result['ten_wickets'])?$result['ten_wickets']:'-'; ?></div>
    </div>
    <?php
		$sql="SELECT *,ifnull(ROUND(over_runs/total_wickets,2) ,'-') AS AVg,ifnull(ROUND(total_overs/total_wickets,2) ,'-') AS SR,ifnull(ROUND(over_runs*6/total_overs,2) ,'-') AS EC FROM oneday_players WHERE player_id='".$_REQUEST['playerId']."'";
		$result=$result=Db::getInstance()->getRow($sql);
	?>
    
    
    <div class="secondClasscontainnor2" id="displyContain12"  style="background:#FFF; width:98%; height:20px; margin-top:3px; display:block;">
        <div class="innerclassContainnor"><?php echo $result['total_match']; ?></div>
        <div class="innerclassContainnor"><?php echo $result['total_bowl_inning']; ?></div>
        <div class="innerclassContainnor"><?php echo $result['total_overs']; ?></div>
        <div class="innerclassContainnor" style="width:90px"><?php echo $result['over_runs']; ?></div>
        <div class="innerclassContainnor"><?php echo $result['total_wickets']; ?></div>
        <div class="innerclassContainnor"><?php echo $result['bbiwickets'].'/'.$result['bbiruns']; ?></div>
        <div class="innerclassContainnor"><?php echo $result['bbmwickets'].'/'.$result['bbmruns']; ?></div>
        <div class="innerclassContainnor"><?php echo $result['AVg']; ?></div>
        <div class="innerclassContainnor"><?php echo $result['EC']; ?></div>
        <div class="innerclassContainnor"><?php echo $result['SR']; ?></div>
        <div class="innerclassContainnor" id ="threewicketsdetails" style="display:none"><?php echo isset($result['three_wickets'])?$result['three_wickets']:'-'; ?></div>
        <div class="innerclassContainnor"><?php echo isset($result['five_wickets'])?$result['five_wickets']:'-'; ?></div>
        <div class="innerclassContainnor"><?php echo isset($result['ten_wickets'])?$result['ten_wickets']:'-'; ?></div>
    </div>
    
    
    
    <?php
		$sql="SELECT *,ifnull(ROUND(over_runs/total_wickets,2) ,'-') AS AVg,ifnull(ROUND(total_overs/total_wickets,2) ,'-') AS SR,ifnull(ROUND(over_runs*6/total_overs,2) ,'-') AS EC FROM test_players WHERE player_id='".$_REQUEST['playerId']."'";
		$result=$result=Db::getInstance()->getRow($sql);
	?>
    
    
    <div class="secondClasscontainnor2" id="displyContain13"  style="background:#FFF; width:98%; height:20px; margin-top:3px; display:none;">
        <div class="innerclassContainnor"><?php echo $result['total_match']; ?></div>
        <div class="innerclassContainnor"><?php echo $result['total_bowl_inning']; ?></div>
        <div class="innerclassContainnor"><?php echo $result['total_overs']; ?></div>
        <div class="innerclassContainnor" style="width:90px"><?php echo $result['over_runs']; ?></div>
        <div class="innerclassContainnor"><?php echo $result['total_wickets']; ?></div>
        <div class="innerclassContainnor"><?php echo $result['bbiwickets'].'/'.$result['bbiruns']; ?></div>
        <div class="innerclassContainnor"><?php echo $result['bbmwickets'].'/'.$result['bbmruns']; ?></div>
        <div class="innerclassContainnor"><?php echo $result['AVg']; ?></div>
        <div class="innerclassContainnor"><?php echo $result['EC']; ?></div>
        <div class="innerclassContainnor"><?php echo $result['SR']; ?></div>
        <div class="innerclassContainnor"><?php echo isset($result['three_wickets'])?$result['three_wickets']:'-'; ?></div>
        <div class="innerclassContainnor"><?php echo isset($result['five_wickets'])?$result['five_wickets']:'-'; ?></div>
        <div class="innerclassContainnor"><?php echo isset($result['ten_wickets'])?$result['ten_wickets']:'-'; ?></div>
    </div>



    <?php
		$sql="SELECT *,ifnull(ROUND(over_runs/total_wickets,2) ,'-') AS AVg,ifnull(ROUND(total_overs/total_wickets,2) ,'-') AS SR,ifnull(ROUND(over_runs*6/total_overs,2) ,'-') AS EC FROM first_class_players WHERE player_id='".$_REQUEST['playerId']."'";
		$result=$result=Db::getInstance()->getRow($sql);
	?>
    
    
    <div class="secondClasscontainnor2" id="displyContain14"  style="background:#FFF; width:98%; height:20px; margin-top:3px; display:none;">
        <div class="innerclassContainnor"><?php echo $result['total_match']; ?></div>
        <div class="innerclassContainnor"><?php echo $result['total_bowl_inning']; ?></div>
        <div class="innerclassContainnor"><?php echo $result['total_overs']; ?></div>
        <div class="innerclassContainnor" style="width:90px"><?php echo $result['over_runs']; ?></div>
        <div class="innerclassContainnor"><?php echo $result['total_wickets']; ?></div>
        <div class="innerclassContainnor"><?php echo $result['bbiwickets'].'/'.$result['bbiruns']; ?></div>
        <div class="innerclassContainnor"><?php echo $result['bbmwickets'].'/'.$result['bbmruns']; ?></div>
        <div class="innerclassContainnor"><?php echo $result['AVg']; ?></div>
        <div class="innerclassContainnor"><?php echo $result['EC']; ?></div>
        <div class="innerclassContainnor"><?php echo $result['SR']; ?></div>
        <div class="innerclassContainnor"><?php echo isset($result['three_wickets'])?$result['three_wickets']:'-'; ?></div>
        <div class="innerclassContainnor"><?php echo isset($result['five_wickets'])?$result['five_wickets']:'-'; ?></div>
        <div class="innerclassContainnor"><?php echo isset($result['ten_wickets'])?$result['ten_wickets']:'-'; ?></div>
    </div>

    <?php
		$sql="SELECT *,ifnull(ROUND(over_runs/total_wickets,2) ,'-') AS AVg,ifnull(ROUND(total_overs/total_wickets,2) ,'-') AS SR,ifnull(ROUND(over_runs*6/total_overs,2) ,'-') AS EC  FROM list_a_players WHERE player_id='".$_REQUEST['playerId']."'";
		$result=$result=Db::getInstance()->getRow($sql);
	?>
    
    
    <div class="secondClasscontainnor2" id="displyContain15"  style="background:#FFF; width:98%; height:20px; margin-top:3px; display:none;">
        <div class="innerclassContainnor"><?php echo $result['total_match']; ?></div>
        <div class="innerclassContainnor"><?php echo $result['total_bowl_inning']; ?></div>
        <div class="innerclassContainnor"><?php echo $result['total_overs']; ?></div>
        <div class="innerclassContainnor" style="width:90px"><?php echo $result['over_runs']; ?></div>
        <div class="innerclassContainnor"><?php echo $result['total_wickets']; ?></div>
        <div class="innerclassContainnor"><?php echo $result['bbiwickets'].'/'.$result['bbiruns']; ?></div>
        <div class="innerclassContainnor"><?php echo $result['bbmwickets'].'/'.$result['bbmruns']; ?></div>
        <div class="innerclassContainnor"><?php echo $result['AVg']; ?></div>
        <div class="innerclassContainnor"><?php echo $result['EC']; ?></div>
        <div class="innerclassContainnor"><?php echo $result['SR']; ?></div>
        <div class="innerclassContainnor"><?php echo isset($result['three_wickets'])?$result['three_wickets']:'-'; ?></div>
        <div class="innerclassContainnor"><?php echo isset($result['five_wickets'])?$result['five_wickets']:'-'; ?></div>
        <div class="innerclassContainnor"><?php echo isset($result['ten_wickets'])?$result['ten_wickets']:'-'; ?></div>
    </div>



    <?php
		$sql="SELECT *,ifnull(ROUND(over_runs/total_wickets,2) ,'-') AS AVg,ifnull(ROUND(total_overs/total_wickets,2) ,'-') AS SR,ifnull(ROUND(over_runs*6/total_overs,2) ,'-') AS EC  FROM twenty20_players WHERE player_id='".$_REQUEST['playerId']."'";
		$result=$result=Db::getInstance()->getRow($sql);
	?>
    
    
    <div class="secondClasscontainnor2" id="displyContain16"  style="background:#FFF; width:98%; height:20px; margin-top:3px; display:none;">
        <div class="innerclassContainnor"><?php echo $result['total_match']; ?></div>
       <!-- <div class="innerclassContainnor"><?php echo $result['total_bowl_inning']; ?></div>-->
        <div class="innerclassContainnor"><?php echo $result['total_overs']; ?></div>
        <div class="innerclassContainnor" style="width:90px"><?php echo $result['over_runs']; ?></div>
        <div class="innerclassContainnor"><?php echo $result['total_wickets']; ?></div>
        <div class="innerclassContainnor"><?php echo $result['bbiwickets'].'/'.$result['bbiruns']; ?></div>
        <div class="innerclassContainnor"><?php echo $result['bbmwickets'].'/'.$result['bbmruns']; ?></div>
        <div class="innerclassContainnor"><?php echo $result['AVg']; ?></div>
        <div class="innerclassContainnor"><?php echo $result['EC']; ?></div>
        <div class="innerclassContainnor"><?php echo $result['SR']; ?></div>
        <div class="innerclassContainnor"><?php echo isset($result['three_wickets'])?$result['three_wickets']:'-'; ?></div>
        <div class="innerclassContainnor"><?php echo isset($result['five_wickets'])?$result['five_wickets']:'-'; ?></div>
        <div class="innerclassContainnor"><?php echo isset($result['ten_wickets'])?$result['ten_wickets']:'-'; ?></div>
    </div>

    <div  class="border-bottom-containnor"></div>

</div>

<script type="text/javascript">
function displyContain(id)
{
	if(id == 6)
	{
		$('#inngingsIds').hide();
		$('#2').hide();
		$('#7').hide();
		$('#inngingsIds').hide();
		$('#threewickets').show();
		$('#battingrunsId').css('width','90px');
	}
	else
	{
		$('#inngingsIds').show();
		$('#2').show();
		$('#7').show();
		$('#inngingsIds').show();
		$('#threewickets').hide();
		$('#battingrunsId').css('width','60px');;

	}
	$('.secondClasscontainnor').hide();
	$('#displyContain'+id).show();
	$('.secondClasscontainnor2').hide();
	$('#displyContain1'+id).show();
	$('.t-20Class').removeClass('t-20ClassActive');
	$('#mainContain'+id).addClass('t-20ClassActive');
}
</script>



</body>
</html>