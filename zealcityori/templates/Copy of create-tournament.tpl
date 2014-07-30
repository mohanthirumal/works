<div class="center-container">
	<div class="innercontainer newinnercontainer" style="margin-left:200px;">
		<form method="post" id="createtournament" action="create-tournament.php">
		<div class="innerheader"><div class="tournlobbybutton1">Creating a Tournament</div></div>
		<div id="step1" class="steps">
	        <div class="steps-design">
				<div class="names">Tournament Name</div> <div class="tboxes"><input type="text" name="tournamentName" id="tournamentName" value="" class="tboxsize"/></div>        
            </div>
        <div class="divline"></div>
		<div class="steps-design">
			<div class="names">Entry Fee</div><div class="sboxes">
                <select name="entryfee1" id="entryfee1" class="sboxsize">
                    <option value="0">---- Select -----</option>
                    {foreach from=$entryfee item=entryfee name=entryfee}
                        <option value="{$entryfee.id}">{$entryfee.amount}</option>
                    {/foreach}
                </select><br/>
            </div>
        </div>
		<div class="names">Type</div><div class="sboxes">
             <select name="type" id="type" class="sboxsize" onchange="zeal1.tournament.changeType()">
                    <option value="0">---- Select -----</option>
					<option value="3">Daily</option>
					<option value="7">Weekly</option>
					<option value="8">Series</option>
			</select><br/>
        </div>
		<div class="weekly-container" style="display:none;">
             <select name="weekly" id="weekly" class="sboxsize" onchange="zeal1.tournament.changeWeek()">
                    <option value="0">---- Select -----</option>
					 {foreach from=$weeks item=week name=weeks}
					<option value="{$smarty.foreach.weeks.iteration}">{$week}</option>
					 {/foreach}
			</select>
         </div>
		 <div class="steps-design">
			<div class="names">Select Match</div><div class="sboxes">
			<select name="match" id="match" class="sboxsize" style="width:200px;">
				<option value="0">---- Select ----</option>
				{foreach from=$matches item=match name=matches}
				<option value="{$match.id}">{$match.t1name} Vs {$match.t2name}</option>
				{/foreach}
			</select>
            </div>
         </div>
		<div class="tournament-match-list"></div>
		<div class="steps-design">
            <div class="names">Prize</div>
            <div class="sboxes">			
			<select name="prize" id="prizepool" onchange="zeal1.tournament.updatePrize(this);" class="sboxsize" style="width:130px;">
				<option value="0">---- Select -----</option>
				{foreach from=$prizes item=prize name=prizes}
					<option value="{$prize.id}">{$prize.name}</option>
				{/foreach}
			</select>
            </div>
        </div>  
		<div class="steps-design">
            <div class="names">Series</div>
            <div class="sboxes">			
			<select name="series" id="series" class="sboxsize" style="width:130px;">
				<option value="0">---- Select -----</option>
				{foreach from=$series item=serie name=series}
					<option value="{$serie.id}">{$serie.tournament_name}</option>
				{/foreach}
			</select>
            </div>
        </div> 
        <div class="steps-design hide" id="player-container">
			<div class="names">No. of players</div><div class="sboxes">
              <select name="players" id="players" class="sboxsize"onchange="zeal1.tournament.updatePrizeList(this);">
			</select>
            </div>
 		</div>
		<div class="prize-list-container"></div> 
        <div class="divline"></div>
        
        <div class="divline"></div>
      
        <div class="divline"></div>
         
        <div class="divline"></div>
       	<div id="prize-money"></div>
        <input type="submit" value="Create" class="nextbut"/>
    </div>
		<input type="hidden" name="action" value="createteam"/>
		<input type="hidden" name="inviteresponse" id="inviteresponse" value=""/>
	
		</div>		
		</form>
	</div>
</div>