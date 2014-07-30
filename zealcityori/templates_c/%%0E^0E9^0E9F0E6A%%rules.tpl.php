<?php /* Smarty version 2.6.27, created on 2014-04-15 10:41:26
         compiled from rules.tpl */ ?>
<div class="rules-mainpage" style="font-size:14px;">
	<div class="live-score-menu">
		<ul style="margin-left:20px;">
			<li class="active" onclick="zeal.index.showContent('match-rules', 'matchtype',1,this,'live-score-menu')">T20</li>
		</ul>
   		<ul style="margin-left:20px;">
			<li onclick="zeal.index.showContent('match-rules', 'matchtype', 2, this, 'live-score-menu')">ODI</li>
		</ul>
   		<ul style="margin-left:20px;">
			<li onclick="zeal.index.showContent('match-rules', 'matchtype', 3, this, 'live-score-menu')">TEST</li>
		</ul>
	</div>
    <div class="match-rules" id="matchtype3">
		<div class="ruleshead" style="font-size:15px; font-weight:bold; text-align:center;">Test Points System</div>
	    <div class="batting-container">
    		<div class="batting-head-title">Batting</div>
            <div class="bat-menu-bg">
                <div class="particulars" style="line-height:19px;">Particulars</div>
                <div class="particulars particulars1" style="width:150px; line-height:19px;">COC Points</div>
            </div>
        <!-- Test Match Batting rules Start -->
            <div class="parti-values extra-height">
                <div class="particulars">1-Runs</div>
                <div class="particulars particulars1">1</div>
            </div>
            <div class="d-line"></div>
            <div class="parti-values extra-height">
                <div class="particulars">Half century Bonus</div>
                <div class="particulars particulars1">5</div>
            </div>
            <div class="d-line"></div>
            <div class="parti-values extra-height">
                <div class="particulars">Century Bonus</div>
                <div class="particulars particulars1">20</div>
            </div>
            <div class="d-line"></div>
            <div class="parti-values extra-height">
                <div class="particulars">Double Century Bonus</div>
                <div class="particulars particulars1">50</div>
            </div>
            <div class="d-line"></div>        
            <div class="parti-values extra-height">
                <div class="particulars">Strike rate - Above 69</div>
                <div class="particulars particulars1">10</div>
            </div>
            <div class="d-line"></div>
            <div class="parti-values extra-height">
                <div class="particulars">*5 - 9 FOURS</div>
                <div class="particulars particulars1">10</div>
            </div>
            <div class="d-line"></div>
            <div class="parti-values extra-height">
                <div class="particulars">*10 - 14 FOURS</div>
                <div class="particulars particulars1">15</div>
            </div>
            <div class="d-line"></div>
            <div class="parti-values extra-height">
                <div class="particulars">*15 Fours and Above</div>
                <div class="particulars particulars1">20</div>
            </div>
            <div class="d-line"></div>
            <div class="parti-values extra-height">
                <div class="particulars">*Consecutive Fours</div>
                <div class="particulars particulars1">10</div>
            </div>
            <div class="d-line"></div>
            <div class="parti-values extra-height">
                <div class="particulars">*3-4 sixes</div>
                <div class="particulars particulars1">15</div>
            </div>
            <div class="d-line"></div>
            <div class="parti-values extra-height">
                <div class="particulars">*5 and Above sixes</div>
                <div class="particulars particulars1">20</div>
            </div>
            <div class="d-line"></div>
            <div class="parti-values extra-height">
                <div class="particulars">*Consecutive sixes</div>
                <div class="particulars particulars1">20</div>
            </div>
            <div class="d-line"></div>
		</div>    
            <!-- Test Match Batting rules End -->
            <!--Test match bowling rules Start-->    
		<div class="batting-container">
            <div class="batting-head-title">Bowling & Fielding</div>
            <div class="bat-menu-bg">
                <div class="particulars" style="line-height:19px;">Particulars</div>
                <div class="particulars particulars1" style="width:150px; line-height:19px;">COC Points</div>
            </div>
			<div class="parti-values extra-height">
                <div class="particulars">Maidens</div>
                <div class="particulars particulars1">2</div>
            </div>
            <div class="d-line"></div>
            <div class="parti-values extra-height">
                <div class="particulars">Wickets</div>
                <div class="particulars particulars1">25</div>
            </div>
            <div class="d-line"></div>
            <div class="parti-values extra-height">
                <div class="particulars">3 wkt haul</div>
                <div class="particulars particulars1">15</div>
            </div>
            <div class="d-line"></div>
            <div class="parti-values extra-height">
                <div class="particulars">5 wkt haul</div>
                <div class="particulars particulars1">25</div>
            </div>
            <div class="d-line"></div>
            <div class="parti-values extra-height">
                <div class="particulars">Wides</div>
                <div class="particulars particulars1">-2</div>
            </div>
            <div class="d-line"></div>
            <div class="parti-values extra-height">
                <div class="particulars">No ball</div>
                <div class="particulars particulars1">-3</div>
            </div>
            <div class="d-line"></div>
            <div class="parti-values extra-height">
                <div class="particulars">Byes</div>
                <div class="particulars particulars1">-1</div>
            </div>
            <div class="d-line"></div>
            <div class="parti-values extra-height">
                <div class="particulars">*Catch</div>
                <div class="particulars particulars1">10</div>
            </div>
            <div class="d-line"></div>
            <div class="parti-values extra-height">
                <div class="particulars">*Runout</div>
                <div class="particulars particulars1">15</div>
            </div>
            <div class="d-line"></div>
            <div class="parti-values extra-height">
                <div class="particulars">*Stumping</div>
                <div class="particulars particulars1">15</div>
            </div>
            <div class="d-line"></div>
            <div class="parti-values extra-height">
                <div class="particulars" style="width:230px;">if coach is part of the winning team</div>
            <div class="particulars particulars1">20</div>
            </div>
            <div class="d-line"></div>
        </div>
		<div class="captainpts" style="float:left; margin:-180px 1px 5px 50px;"><b>Note :</b> Captain gets double the points</div>
        <div class="asteriknote" style="float:left; margin:-160px 1px 5px 50px;"> The categories that have been marked (*) will be displayed as bonus in your scorecard when you play a tournament</div>
	</div>

	<div class="match-rules" id="matchtype2"> 
    	<div class="ruleshead" style="font-size:15px; font-weight:bold; text-align:center;">ODI Points System</div> 
   		<div class="batting-container">
            <div class="batting-head-title">Batting</div>
            <div class="bat-menu-bg">
                <div class="particulars" style=" line-height:19px;">Particulars</div>
                <div class="particulars particulars1" style="width:150px; line-height:19px;">COC Points</div>
            </div>
            <div class="parti-values extra-height">
                <div class="particulars">1-Runs</div>
                <div class="particulars particulars1">1</div>
            </div>
            <div class="d-line"></div>
            <div class="parti-values extra-height">
                <div class="particulars">Half century Bonus</div>
                <div class="particulars particulars1">5</div>
            </div>
            <div class="d-line"></div>
            <div class="parti-values extra-height">
                <div class="particulars">Century Bonus</div>
                <div class="particulars particulars1">20</div>
            </div>
            <div class="d-line"></div>
            <div class="parti-values extra-height">
                <div class="particulars">Strike rate - Below 50</div>
                <div class="particulars particulars1">-5</div>
            </div>
            <div class="d-line"></div>
            <div class="parti-values extra-height">
                <div class="particulars">Strike rate - 100-120</div>
                <div class="particulars particulars1">5</div>
            </div>
            <div class="d-line"></div>
            <div class="parti-values extra-height">
                <div class="particulars">Strike rate - 121 and above</div>
                <div class="particulars particulars1">10</div>
            </div>
            <div class="d-line"></div>
            <div class="parti-values extra-height">
                <div class="particulars">*3 - 5 FOURS</div>
                <div class="particulars particulars1">5</div>
            </div>
            <div class="d-line"></div>
            <div class="parti-values extra-height">
                <div class="particulars">*6 - 9 FOURS</div>
                <div class="particulars particulars1">10</div>
            </div>
            <div class="d-line"></div>
            <div class="parti-values extra-height">
                <div class="particulars">*10 Fours and Above</div>
                <div class="particulars particulars1">15</div>
            </div>
            <div class="d-line"></div>
            <div class="parti-values extra-height">
                <div class="particulars">*Consecutive Fours</div>
                <div class="particulars particulars1">10</div>
            </div>
            <div class="d-line"></div>
            <div class="parti-values extra-height">
                <div class="particulars">*2-3 sixes</div>
                <div class="particulars particulars1">10</div>
            </div>
            <div class="d-line"></div>
            <div class="parti-values extra-height">
                <div class="particulars">*4-5 sixes</div>
                <div class="particulars particulars1">15</div>
            </div>
            <div class="d-line"></div>
            <div class="parti-values extra-height">
                <div class="particulars">*6 Sixes or more</div>
                <div class="particulars particulars1">20</div>
            </div>
            <div class="d-line"></div>
            <div class="parti-values extra-height">
                <div class="particulars">*Consecutive sixes</div>
                <div class="particulars particulars1">20</div>
            </div>
            <div class="d-line"></div>
    	</div>

		<div class="batting-container">
            <div class="batting-head-title">Bowling & Fielding</div>
            <div class="bat-menu-bg">
                <div class="particulars" style=" line-height:19px;">Particulars</div>
                <div class="particulars particulars1" style="width:150px; line-height:19px;">COC Points</div>
            </div> 
           <div class="parti-values extra-height">
                <div class="particulars">Maidens</div>
                <div class="particulars particulars1">6</div>
            </div>
            <div class="d-line"></div>
            <div class="parti-values extra-height">
                <div class="particulars">Wickets</div>
                <div class="particulars particulars1">25</div>
            </div>
            <div class="d-line"></div>
            <div class="parti-values extra-height">
                <div class="particulars">3 wkt haul</div>
                <div class="particulars particulars1">10</div>
            </div>
            <div class="d-line"></div>
            <div class="parti-values extra-height">
                <div class="particulars">5 wkt haul</div>
                <div class="particulars particulars1">20</div>
            </div>
            <div class="d-line"></div>
            <div class="parti-values extra-height">
                <div class="particulars">Economy rate - Above 7.5</div>
                <div class="particulars particulars1">-10</div>
            </div>
            <div class="d-line"></div>
            <div class="parti-values extra-height">
                <div class="particulars">Economy rate - below 5</div>
                <div class="particulars particulars1">10</div>
            </div>
            <div class="d-line"></div>
            <div class="parti-values extra-height">
                <div class="particulars">Wides</div>
                <div class="particulars particulars1">-2</div>
            </div>
            <div class="d-line"></div>
            <div class="parti-values extra-height">
                <div class="particulars">No ball</div>
                <div class="particulars particulars1">-3</div>
            </div>
            <div class="d-line"></div>
            <div class="parti-values extra-height">
                <div class="particulars">Byes</div>
                <div class="particulars particulars1">-1</div>
            </div>
            <div class="d-line"></div>
            <div class="parti-values extra-height">
                <div class="particulars">*Catch</div>
                <div class="particulars particulars1">10</div>
            </div>
            <div class="d-line"></div>
            <div class="parti-values extra-height">
                <div class="particulars">*Runout</div>
                <div class="particulars particulars1">15</div>
            </div>
            <div class="d-line"></div>
            <div class="parti-values extra-height">
                <div class="particulars">*Stumping</div>
                <div class="particulars particulars1">15</div>
            </div>
            <div class="d-line"></div>
            <div class="parti-values extra-height">
                <div class="particulars" >if coach is part of the winning team</div>
                    <div class="particulars particulars1" >20</div>
            </div>
            <div class="d-line"></div>
		</div> 
        <div class="captainpts" style="float:left; margin:-120px 1px 5px 50px;"><b>Note :</b> Captain gets double the points</div>
        <div class="asteriknote" style="float:left; margin:-100px 1px 5px 50px;"> The categories that have been marked (*) will be displayed as bonus in your scorecard when you play a tournament</div>
    </div>
    
  	<div class="match-rules" id="matchtype1"> 
    	<div class="ruleshead" style="font-size:15px; font-weight:bold; text-align:center;">T20 Points System</div> 
   		<div class="batting-container">
            <div class="batting-head-title">Batting</div>
            <div class="bat-menu-bg">
                <div class="particulars" style=" line-height:19px;">Particulars</div>
                <div class="particulars particulars1" style="width:150px; line-height:19px;">COC Points</div>
            </div>
            <div class="parti-values extra-height">
                <div class="particulars">1-Runs</div>
                <div class="particulars particulars1">1</div>
            </div>
            <div class="d-line"></div>
            <div class="parti-values extra-height">
                <div class="particulars">Half Century</div>
                <div class="particulars particulars1">10</div>
            </div>
            <div class="d-line"></div>
            <div class="parti-values extra-height">
                <div class="particulars">Century</div>
                <div class="particulars particulars1">20</div>
            </div>
            <div class="d-line"></div>
            <div class="parti-values extra-height">
                <div class="particulars">30 Runs</div>
                <div class="particulars particulars1">5</div>
            </div>
            <div class="d-line"></div>
            <div class="parti-values extra-height">
                <div class="particulars">Strike rate - Below 100</div>
                <div class="particulars particulars1">-10</div>
            </div>
            <div class="d-line"></div>
            <div class="parti-values extra-height">
                <div class="particulars">Strike rate - 100.01-120.00</div>
                <div class="particulars particulars1">5</div>
            </div>
            <div class="d-line"></div>
            <div class="parti-values extra-height">
                <div class="particulars">Strike rate - 121-140</div>
                <div class="particulars particulars1">10</div>
            </div>
            <div class="d-line"></div>
            <div class="parti-values extra-height">
                <div class="particulars">Strike rate - 141 and above</div>
                <div class="particulars particulars1">15</div>
            </div>
            <div class="d-line"></div>
            <div class="parti-values extra-height">
                <div class="particulars">Strike rate - 200 and above</div>
                <div class="particulars particulars1">25</div>
            </div>
            <div class="d-line"></div>
            <div class="parti-values extra-height">
                <div class="particulars">*3 - 5 FOURS</div>
                <div class="particulars particulars1">5</div>
            </div>
            <div class="d-line"></div>
            <div class="parti-values extra-height">
                <div class="particulars">*6 - 9 FOURS</div>
                <div class="particulars particulars1">10</div>
            </div>
            <div class="d-line"></div>
            <div class="parti-values extra-height">
                <div class="particulars">*10 Fours and Above</div>
                <div class="particulars particulars1">20</div>
            </div>
            <div class="d-line"></div>
            <div class="parti-values extra-height">
                <div class="particulars">*Consecutive Fours</div>
                <div class="particulars particulars1">15</div>
            </div>
            <div class="d-line"></div>
            <div class="parti-values extra-height">
                <div class="particulars">*2-3 sixes</div>
                <div class="particulars particulars1">10</div>
            </div>
            <div class="d-line"></div>
            <div class="parti-values extra-height">
                <div class="particulars">*4-5 sixes</div>
                <div class="particulars particulars1">20</div>
            </div>
            <div class="d-line"></div>
            <div class="parti-values extra-height">
                <div class="particulars">*6 Sixes or more</div>
                <div class="particulars particulars1">30</div>
            </div>
            <div class="d-line"></div>
            <div class="parti-values extra-height">
                <div class="particulars">*Consecutive sixes</div>
                <div class="particulars particulars1">25</div>
            </div>
            <div class="d-line"></div>
        </div>

      	<div class="batting-container">
            <div class="batting-head-title">Bowling & Fielding</div>
            <div class="bat-menu-bg">
                <div class="particulars" style=" line-height:19px;">Particulars</div>
                <div class="particulars particulars1" style="width:150px; line-height:19px;">COC Points</div>
            </div>
            <div class="parti-values extra-height">
                <div class="particulars">Maidens</div>
                <div class="particulars particulars1">10</div>
            </div>
            <div class="d-line"></div>
            <div class="parti-values extra-height">
                <div class="particulars">Wickets</div>
                <div class="particulars particulars1">25</div>
            </div>
            <div class="d-line"></div>
            <div class="parti-values extra-height">
                <div class="particulars">3 wkt haul</div>
                <div class="particulars particulars1">15</div>
            </div>
            <div class="d-line"></div>
            <div class="parti-values extra-height">
                <div class="particulars">5 wkt haul</div>
                <div class="particulars particulars1">30</div>
            </div>
            <div class="d-line"></div>
            <div class="parti-values extra-height">
                <div class="particulars">Economy rate - Above 10</div>
                <div class="particulars particulars1">-15</div>
            </div>
            <div class="d-line"></div>
            <div class="parti-values extra-height">
                <div class="particulars">Economy rate - 9.01-9.99</div>
                <div class="particulars particulars1">-10</div>
            </div>
            <div class="d-line"></div>
            <div class="parti-values extra-height">
                <div class="particulars">Economy rate - 8.01-9.00</div>
                <div class="particulars particulars1">-5</div>
            </div>
            <div class="d-line"></div>
            <div class="parti-values extra-height">
                <div class="particulars">Economy rate - 7.01-8.00</div>
                <div class="particulars particulars1">0</div>
            </div>
            <div class="d-line"></div>
            <div class="parti-values extra-height">
                <div class="particulars">Economy rate - 6.01-7.00</div>
                <div class="particulars particulars1">10</div>
            </div>
            <div class="d-line"></div>
            <div class="parti-values extra-height">
                <div class="particulars">Economy rate - 6.00 and below</div>
                <div class="particulars particulars1">15</div>
            </div>
            <div class="d-line"></div>
            <div class="parti-values extra-height">
                <div class="particulars">Wides</div>
                <div class="particulars particulars1">-2</div>
            </div>
            <div class="d-line"></div>
            <div class="parti-values extra-height">
                <div class="particulars">No ball</div>
                <div class="particulars particulars1">-3</div>
            </div>
            <div class="d-line"></div>
            <div class="parti-values extra-height">
                <div class="particulars">Byes</div>
                <div class="particulars particulars1">-1</div>
            </div>
            <div class="d-line"></div>
            <div class="parti-values extra-height">
                <div class="particulars">*Catch</div>
                <div class="particulars particulars1">10</div>
            </div>
            <div class="d-line"></div>
            <div class="parti-values extra-height">
                <div class="particulars">*Runout</div>
                <div class="particulars particulars1">15</div>
            </div>
            <div class="d-line"></div>
            <div class="parti-values extra-height">
                <div class="particulars">*Stumping</div>
                <div class="particulars particulars1">15</div>
            </div>
            <div class="d-line"></div>
            <div class="parti-values extra-height">
                <div class="particulars" style="width:230px;">if coach is part of the winning team</div>
                <div class="particulars particulars1" >20</div>
            </div>
            <div class="d-line"></div>   
        </div> 
        <div class="captainpts" style="float:left; margin:-30px 1px 5px 50px;"><b>Note :</b> Captain gets double the points</div>
        <div class="asteriknote" style="float:left; margin:-10px 1px 5px 50px;"> The categories that have been marked (*) will be displayed as bonus in your scorecard when you play a tournament</div>
	</div>       
</div>