<?php /* Smarty version 2.6.27, created on 2014-04-28 15:42:20
         compiled from my-tournament.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'truncate', 'my-tournament.tpl', 30, false),array('modifier', 'date_format', 'my-tournament.tpl', 211, false),)), $this); ?>
<?php if (! isset ( $this->_tpl_vars['tour_id'] )): ?>
<h1 style="color:#fff;">Not Allowed</h1>
<?php else: ?>
<!-------------------------------- My Tournament -------------------------------->
<div class="my-tournament-container">
	<div class="left-container" style="margin-top:1px;">
		<div class="live-score-menu">
			<ul>
				<li class="active">Teams</li>
			</ul>
		</div>
		<div class="mytournament-filter">
			<input type="checkbox" name="filter" class="checkbox" id="filterteam1" onclick="zeal.players.filter(this, 'team1')"/><label for="filterteam1" class="checkname"><?php echo $this->_tpl_vars['team1']->teamname; ?>
</label>
			<input type="checkbox" name="filter" class="checkbox" id="filterteam2" onclick="zeal.players.filter(this, 'team2')"/><label for="filterteam2" class="checkname"><?php echo $this->_tpl_vars['team2']->teamname; ?>
</label>
		</div>
        <div class="mytournament-playermenu">
        	<div class="playermame">Player Name</div>
            <div class="role">Role</div>
            <div class="team">Team</div>
            <div class="runs">Runs</div>
            <div class="salary">Salary</div>
            <div class="addbut">Add</div>
        </div>
		<div class="mytournament-players">
			<ul id="team1">
				<?php $_from = $this->_tpl_vars['team1players']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['team1players'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['team1players']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['player']):
        $this->_foreach['team1players']['iteration']++;
?>
				<?php if (isset ( $this->_tpl_vars['myTeamPlayersId'] ) && in_array ( $this->_tpl_vars['player']['id'] , $this->_tpl_vars['myTeamPlayersId'] )): ?>
				<?php else: ?>
				<li class="player-indi team1" rel="team1" id="player<?php echo $this->_tpl_vars['player']['id']; ?>
">
					<div style="width:150px;" class="playername"><img src="<?php echo $this->_tpl_vars['tourimageurl']; ?>
players/<?php echo $this->_tpl_vars['player']['photo_url']; ?>
" alt=""/><?php echo ((is_array($_tmp=$this->_tpl_vars['player']['player_name'])) ? $this->_run_mod_handler('truncate', true, $_tmp, 18, '...') : smarty_modifier_truncate($_tmp, 18, '...')); ?>
</div>
					<div><?php echo $this->_tpl_vars['player']['player_type']; ?>
</div>
					<div class="small"><img src="<?php echo $this->_tpl_vars['tourimageurl']; ?>
teamsflags/<?php echo $this->_tpl_vars['team1']->flag_url; ?>
" alt=""/></div>
					<div class="small run">0</div>
					<div class="small"><?php echo $this->_tpl_vars['player']['coc_salary']; ?>
</div>
					<div class="small"><input type="button" value="Add" onclick="zeal.players.add(<?php echo $this->_tpl_vars['player']['id']; ?>
);" class="addfunds"/></div>
					<input type="hidden" name="players[]" value="<?php echo $this->_tpl_vars['player']['id']; ?>
"/>
					<input type="hidden" name="playerssalary" id="salary<?php echo $this->_tpl_vars['player']['id']; ?>
" value="<?php echo $this->_tpl_vars['player']['coc_salary']; ?>
"/>
				</li>
				<?php endif; ?>
				<?php endforeach; endif; unset($_from); ?>
			</ul>
			<ul id="team2">
				<?php $_from = $this->_tpl_vars['team2players']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['team1players'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['team1players']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['player']):
        $this->_foreach['team1players']['iteration']++;
?>
				<?php if (isset ( $this->_tpl_vars['myTeamPlayersId'] ) && in_array ( $this->_tpl_vars['player']['id'] , $this->_tpl_vars['myTeamPlayersId'] )): ?>
				<?php else: ?>
				<li class="player-indi team2" rel="team2" id="player<?php echo $this->_tpl_vars['player']['id']; ?>
">
					<div style="width:150px;" class="playername"><img src="<?php echo $this->_tpl_vars['tourimageurl']; ?>
players/<?php echo $this->_tpl_vars['player']['photo_url']; ?>
" alt=""/><?php echo ((is_array($_tmp=$this->_tpl_vars['player']['player_name'])) ? $this->_run_mod_handler('truncate', true, $_tmp, 15, '...') : smarty_modifier_truncate($_tmp, 15, '...')); ?>
</div>
					<div><?php echo $this->_tpl_vars['player']['player_type']; ?>
</div>
					<div class="small"><img src="<?php echo $this->_tpl_vars['tourimageurl']; ?>
teamsflags/<?php echo $this->_tpl_vars['team2']->flag_url; ?>
" alt=""/></div>
					<div class="small run">0</div>
					<div class="small"><?php echo $this->_tpl_vars['player']['coc_salary']; ?>
</div>
					<div class="small"><input type="button" value="Add" onclick="zeal.players.add(<?php echo $this->_tpl_vars['player']['id']; ?>
);" class="addfunds"/></div>
					<input type="hidden" name="players[]" value="<?php echo $this->_tpl_vars['player']['id']; ?>
"/>
					<input type="hidden" name="playerssalary" id="salary<?php echo $this->_tpl_vars['player']['id']; ?>
" value="<?php echo $this->_tpl_vars['player']['coc_salary']; ?>
"/>
				</li>
				<?php endif; ?>
				<?php endforeach; endif; unset($_from); ?>
			</ul>
		</div>
		<?php if (! isset ( $this->_tpl_vars['myTeamPlayersId'] )): ?>
        <div class="left-hidden-container"></div>
		<?php endif; ?>
	</div>
	<div class="right-container" style="margin-top:1px;">
    	<div class="remaining">
        	<div class="remaining-menu">
            	<div class="amount-bg"><div class="amount budjet-text" id="budjet-text"><?php echo $this->_tpl_vars['tournament']->salary_cap; ?>
</div></div>
				<input type="hidden" id="budjet" value="<?php echo $this->_tpl_vars['tournament']->salary_cap; ?>
"/>
                <div class="remain-title">REMAINING</div>
				<div class="next-starts-in-counter" id="next-starts-in"></div>
            </div>	
          
        </div>    	
		<form method="post" onsubmit="return zeal.mytournament.validatemytourn();">
			<div class="step1">
				<div class="live-score-menu">
					<div class="step1title">STEP -1</div>
					<div class="changes-value-bg"><div class="changes-values"><?php if (! isset ( $this->_tpl_vars['myTeamPlayersId'] )): ?>0<?php else: ?><?php echo $this->_tpl_vars['myTournament']['no_of_changes']; ?>
<?php endif; ?>/<?php echo $this->_tpl_vars['tournament']->no_of_changes; ?>
</div></div>
					<div class="changes">Changes</div>
					<!--<img src="<?php echo $this->_tpl_vars['base_dir']; ?>
images/question_icon.png" class="quest-img-body"/>-->
				</div>
				<div class="mytournament-step1" id="step1body">
					<div style="margin-left:20px;"><b>Enter Your Team Name:</b></div>
					<input type="text" value="<?php echo $this->_tpl_vars['myTournament']['teamname']; ?>
" name="txtteamname" class="step1txt"/>
					<input type="button" value="submit" class="addfunds" onclick="zeal.players.HiddedWindow();" style="margin-top: 30px;"/>
				</div>
			</div>
			<div class="step2">
				<div class="live-score-menu">
					<div class="step1title">STEP -2</div>
                    <div class="selectteamplayers" id="selectteamplayers"> </div>
                    <div class="amount budjet-text"  style="color:#000; float:right;"><?php echo $this->_tpl_vars['tournament']->salary_cap; ?>
</div>                    
				</div>
                <div class="step2menubg">
                	<div class="name">Name</div>	
                    <div class="role">Role</div>	
                    <div class="country">Country</div>	
                    <div class="salary">Salary</div>
                </div>

				<ul class="mytournament-step1 mytournament-players" id="myteam">
				<?php if (isset ( $this->_tpl_vars['myTeamPlayersId'] )): ?>
					<?php $_from = $this->_tpl_vars['team1players']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['team1players'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['team1players']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['player']):
        $this->_foreach['team1players']['iteration']++;
?>
					<?php if (isset ( $this->_tpl_vars['myTeamPlayersId'] ) && in_array ( $this->_tpl_vars['player']['id'] , $this->_tpl_vars['myTeamPlayersId'] )): ?>					
					<li class="player-indi team1" rel="team1" id="player<?php echo $this->_tpl_vars['player']['id']; ?>
">
						<div style="width:150px;" class="playername"><img src="<?php echo $this->_tpl_vars['tourimageurl']; ?>
players/<?php echo $this->_tpl_vars['player']['photo_url']; ?>
" alt=""/><?php echo ((is_array($_tmp=$this->_tpl_vars['player']['player_name'])) ? $this->_run_mod_handler('truncate', true, $_tmp, 18, '...') : smarty_modifier_truncate($_tmp, 18, '...')); ?>
</div>
						<div><?php echo $this->_tpl_vars['player']['player_type']; ?>
</div>
						<div class="small"><img src="<?php echo $this->_tpl_vars['tourimageurl']; ?>
teamsflags/<?php echo $this->_tpl_vars['team1']->flag_url; ?>
" alt=""/></div>
						<div class="small run hide">0</div>
						<div class="small"><?php echo $this->_tpl_vars['player']['coc_salary']; ?>
</div>
						<div class="small"><input type="button" value="" class="btn-remove-player" onclick="zeal.players.remove(<?php echo $this->_tpl_vars['player']['id']; ?>
);"/></div>
						<input type="hidden" name="players[]" value="<?php echo $this->_tpl_vars['player']['id']; ?>
"/>
						<input type="hidden" name="playerssalary" id="salary<?php echo $this->_tpl_vars['player']['id']; ?>
" value="<?php echo $this->_tpl_vars['player']['coc_salary']; ?>
"/>
						<script>zeal.players.team1 ++;zeal.players.count ++;zeal.players.budjet += parseInt(<?php echo $this->_tpl_vars['player']['coc_salary']; ?>
);</script>
					</li>
					<?php endif; ?>
					<?php endforeach; endif; unset($_from); ?>
					<?php $_from = $this->_tpl_vars['team2players']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['team1players'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['team1players']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['player']):
        $this->_foreach['team1players']['iteration']++;
?>
					<?php if (isset ( $this->_tpl_vars['myTeamPlayersId'] ) && in_array ( $this->_tpl_vars['player']['id'] , $this->_tpl_vars['myTeamPlayersId'] )): ?>							
					<li class="player-indi team2" rel="team2" id="player<?php echo $this->_tpl_vars['player']['id']; ?>
">
						<div style="width:150px;" class="playername"><img src="<?php echo $this->_tpl_vars['tourimageurl']; ?>
players/<?php echo $this->_tpl_vars['player']['photo_url']; ?>
" alt=""/><?php echo ((is_array($_tmp=$this->_tpl_vars['player']['player_name'])) ? $this->_run_mod_handler('truncate', true, $_tmp, 15, '...') : smarty_modifier_truncate($_tmp, 15, '...')); ?>
</div>
						<div><?php echo $this->_tpl_vars['player']['player_type']; ?>
</div>
						<div class="small"><img src="<?php echo $this->_tpl_vars['tourimageurl']; ?>
teamsflags/<?php echo $this->_tpl_vars['team2']->flag_url; ?>
" alt=""/></div>
						<div class="small run hide">0</div>
						<div class="small"><?php echo $this->_tpl_vars['player']['coc_salary']; ?>
</div>
						<div class="small"><input type="button" value="" class="btn-remove-player" onclick="zeal.players.remove(<?php echo $this->_tpl_vars['player']['id']; ?>
);"/></div>
						<input type="hidden" name="players[]" value="<?php echo $this->_tpl_vars['player']['id']; ?>
"/>
						<input type="hidden" name="playerssalary" id="salary<?php echo $this->_tpl_vars['player']['id']; ?>
" value="<?php echo $this->_tpl_vars['player']['coc_salary']; ?>
"/>
						<script>zeal.players.team2 ++;zeal.players.count ++;zeal.players.budjet += parseInt(<?php echo $this->_tpl_vars['player']['coc_salary']; ?>
);</script>
					</li>					
					<?php endif; ?>
					<?php endforeach; endif; unset($_from); ?>					
				<?php endif; ?>
				</ul>
			</div>
			<?php if (! isset ( $this->_tpl_vars['myTeamPlayersId'] )): ?>
            <div class="step2-hidden"></div>
			<?php endif; ?>
			<div class="step3" id="livescoremenu-id-step3">
				<div class="live-score-menu">
					<div class="step1title">STEP -3</div>
				</div>
				<div class="mytournament-step1" style="height:151px;">
					<div class="chooseurcaptain">Choose Your Captain</div>
					<select name="ddcaptain" class="selectcaptain" id="ddcaptain">
                    	<option value="">---select---</option>
					<?php if (isset ( $this->_tpl_vars['myTeamPlayersId'] )): ?>
						<?php $_from = $this->_tpl_vars['team1players']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['team1players'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['team1players']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['player']):
        $this->_foreach['team1players']['iteration']++;
?>
						<?php if (isset ( $this->_tpl_vars['myTeamPlayersId'] ) && in_array ( $this->_tpl_vars['player']['id'] , $this->_tpl_vars['myTeamPlayersId'] )): ?>
						<?php if ($this->_tpl_vars['myTournament']['captain'] == $this->_tpl_vars['player']['id']): ?>
						<option value="<?php echo $this->_tpl_vars['player']['id']; ?>
" selected="selected"><?php echo $this->_tpl_vars['player']['player_name']; ?>
</option>
						<?php else: ?>
						<option value="<?php echo $this->_tpl_vars['player']['id']; ?>
"><?php echo $this->_tpl_vars['player']['player_name']; ?>
</option>
						<?php endif; ?>
						</li>
						<?php endif; ?>
						<?php endforeach; endif; unset($_from); ?>
						<?php $_from = $this->_tpl_vars['team2players']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['team1players'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['team1players']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['player']):
        $this->_foreach['team1players']['iteration']++;
?>
						<?php if (isset ( $this->_tpl_vars['myTeamPlayersId'] ) && in_array ( $this->_tpl_vars['player']['id'] , $this->_tpl_vars['myTeamPlayersId'] )): ?>
						<?php if ($this->_tpl_vars['myTournament']['captain'] == $this->_tpl_vars['player']['id']): ?>
						<option value="<?php echo $this->_tpl_vars['player']['id']; ?>
" selected="selected"><?php echo $this->_tpl_vars['player']['player_name']; ?>
</option>
						<?php else: ?>
						<option value="<?php echo $this->_tpl_vars['player']['id']; ?>
"><?php echo $this->_tpl_vars['player']['player_name']; ?>
</option>
						<?php endif; ?>
						<?php endif; ?>
						<?php endforeach; endif; unset($_from); ?>					
					<?php endif; ?>
					</select><br/>
					<div class="chooseurcoach">Choose Your Coach</div>
					<select name="coach" class="selectcoach" id="ddcoach">
                    	<option value="">---select---</option>
						<?php $_from = $this->_tpl_vars['coaches']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['coaches'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['coaches']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['coach']):
        $this->_foreach['coaches']['iteration']++;
?>		
						<?php if ($this->_tpl_vars['myTournament']['coach'] == $this->_tpl_vars['coach']['coach_id']): ?>
						<option value="<?php echo $this->_tpl_vars['coach']['coach_id']; ?>
" selected="selected"><?php echo $this->_tpl_vars['coach']['coach_name']; ?>
 - <?php echo $this->_tpl_vars['coach']['team']; ?>
</option>
						<?php else: ?>
  	                    <option value="<?php echo $this->_tpl_vars['coach']['coach_id']; ?>
"><?php echo $this->_tpl_vars['coach']['coach_name']; ?>
 - <?php echo $this->_tpl_vars['coach']['team']; ?>
</option>
						<?php endif; ?>
						<?php endforeach; endif; unset($_from); ?>
					</select>
					<input type="submit" value="Submit" name="myteam" class="sub-button"/>
				</div>
			</div>
			<?php if (! isset ( $this->_tpl_vars['myTeamPlayersId'] )): ?>
            <div class="step3-hidden"></div>
			<?php endif; ?>
			<input type="hidden" name="tour_id" value="<?php echo $this->_tpl_vars['tour_id']; ?>
"/>
		</form>
	</div>
</div>
<!-------------------------------- My Tournament -------------------------------->
<!-- Tournment Registration inner window "Connect with facebook"-- START-->
<?php if (! isset ( $this->_tpl_vars['myTeamPlayersId'] )): ?>
<div class="fund-fulls">
	<div class="my-tournament-team-invite">
		<div class="my-tournament-team-msg">Would you like to invite your friends to take part in this tournament</div>
		<div class="my-tournament-btn-share">
		<input type="button" value="  Yes  " class="addfunds" onclick="zeal.tournament.facebookShare('Come and join me in the <?php echo $this->_tpl_vars['tournament']->name; ?>
 tournament', 'I have just taken part in the <?php echo $this->_tpl_vars['tournament']->name; ?>
 tournament in captain of captains. Why dont you join and create your teams for a chance to win real cash prizes.');zeal.players.closewindow();"/>
		<input type="button" value="  No  " class="addfunds" onclick="zeal.players.closewindow();"/>
		</div>
	</div>
</div>
<?php endif; ?>
<!-- Tournment Registration inner window "Connect with facebook"-- END-->
<?php endif; ?>
<!---------------------------------- Error Message ---------------------------------------------->
<div class="error-msg">
	<div id="error-msg">Not Allowed</div>
	<input type="button" class="addfunds" value="OK" style="margin:20px 0 0 135px;" onclick="zeal.errors.closePopError();"/>
</div>
<script type="text/javascript">
var matchservertime = new Date(<?php echo ((is_array($_tmp=$this->_tpl_vars['now'])) ? $this->_run_mod_handler('date_format', true, $_tmp, '%Y') : smarty_modifier_date_format($_tmp, '%Y')); ?>
, <?php echo ((is_array($_tmp=$this->_tpl_vars['now'])) ? $this->_run_mod_handler('date_format', true, $_tmp, '%m') : smarty_modifier_date_format($_tmp, '%m')); ?>
, <?php echo ((is_array($_tmp=$this->_tpl_vars['now'])) ? $this->_run_mod_handler('date_format', true, $_tmp, '%d') : smarty_modifier_date_format($_tmp, '%d')); ?>
, <?php echo ((is_array($_tmp=$this->_tpl_vars['now'])) ? $this->_run_mod_handler('date_format', true, $_tmp, '%H') : smarty_modifier_date_format($_tmp, '%H')); ?>
, <?php echo ((is_array($_tmp=$this->_tpl_vars['now'])) ? $this->_run_mod_handler('date_format', true, $_tmp, '%M') : smarty_modifier_date_format($_tmp, '%M')); ?>
, <?php echo ((is_array($_tmp=$this->_tpl_vars['now'])) ? $this->_run_mod_handler('date_format', true, $_tmp, '%S') : smarty_modifier_date_format($_tmp, '%S')); ?>
);
zeal.tournament.nextMatchTime(<?php echo ((is_array($_tmp=$this->_tpl_vars['tournament']->endtime)) ? $this->_run_mod_handler('date_format', true, $_tmp, '%Y') : smarty_modifier_date_format($_tmp, '%Y')); ?>
, <?php echo ((is_array($_tmp=$this->_tpl_vars['tournament']->endtime)) ? $this->_run_mod_handler('date_format', true, $_tmp, '%m') : smarty_modifier_date_format($_tmp, '%m')); ?>
, <?php echo ((is_array($_tmp=$this->_tpl_vars['tournament']->endtime)) ? $this->_run_mod_handler('date_format', true, $_tmp, '%d') : smarty_modifier_date_format($_tmp, '%d')); ?>
, <?php echo ((is_array($_tmp=$this->_tpl_vars['tournament']->endtime)) ? $this->_run_mod_handler('date_format', true, $_tmp, '%H') : smarty_modifier_date_format($_tmp, '%H')); ?>
, <?php echo ((is_array($_tmp=$this->_tpl_vars['tournament']->endtime)) ? $this->_run_mod_handler('date_format', true, $_tmp, '%M') : smarty_modifier_date_format($_tmp, '%M')); ?>
, <?php echo ((is_array($_tmp=$this->_tpl_vars['tournament']->endtime)) ? $this->_run_mod_handler('date_format', true, $_tmp, '%S') : smarty_modifier_date_format($_tmp, '%S')); ?>
);
</script>