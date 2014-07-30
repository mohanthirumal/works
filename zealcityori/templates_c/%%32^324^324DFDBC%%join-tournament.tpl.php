<?php /* Smarty version 2.6.27, created on 2014-04-22 14:02:14
         compiled from join-tournament.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'join-tournament.tpl', 39, false),)), $this); ?>
<div class="jointournamentContainnor">
	<div class="joinTournamentContainnorClassHead"><?php echo $this->_tpl_vars['tournament']->name; ?>
 <?php echo $this->_tpl_vars['tournament']->tournament_type->nickname; ?>
 fantasy pool</div>
	<div style="float:left; width:100%; background-color:#fff; border-radius:0 0 8px 8px;-moz-border-radius:0 0 8px 8px;-web-border-radius:0 0 8px 8px; padding-bottom:8px;">
		<div class="jointitleContent">
			<div class="firstClassContent">Entry Fee: <span class="WebRupee">Rs.</span><?php echo $this->_tpl_vars['tournament']->entry_fee; ?>
</div>
			<div class="firstClassContent">Salary cap: 100 K</div>
			<div class="firstClassContent">Single entry</div>
			<div class="firstClassContent">Entries: <?php echo $this->_tpl_vars['tournament']->joinPlayers; ?>
/<?php echo $this->_tpl_vars['tournament']->players; ?>
</div>
			<div class="firstClassContent" style="width:27%">Guaranteed prize pool</div>
		</div>
		<div class="InnerJoin-containnor-select all-tournament">
			<div class="dailyfantasy"><?php echo $this->_tpl_vars['tournament']->tournament_type->name; ?>
 Fantasy League</div>
            <div class="headerFileClass">
                <ul>
                    <li class="headermenuClass active" onclick="zeal.tournament.showJoinTournamentTab('all-tournament', 'inner-Join-containnor-text', 'match-info', this)" style="margin:9px 0 0 23px"><div class="IconeImages5"></div>Info</li>
                    <li class="headermenuClass " onclick="zeal.tournament.showJoinTournamentTab('all-tournament', 'inner-Join-containnor-text', 'joined-user', this)"><div class="IconeImages6"></div>Entries</li>
                    <li class="headermenuClass " onclick="zeal.tournament.showJoinTournamentTab('all-tournament', 'inner-Join-containnor-text', 'prize-detail', this)"><div class="IconeImages7"></div>Prizes</li>
                </ul>
            </div>
			<div class="main-class-content">
            	<div class="inner-Join-containnor-text match-info" style=" background-color:#E1E1E1;" id="joitournamentId-3" >
					<div class="btn-class-Inner-sec">Pick a team of 11 from each of the following games</div>
					<div class="falgClassContainnor">
						<?php if ($this->_tpl_vars['tournament']->tournament_type->id >= 5): ?>
                        	<?php $_from = $this->_tpl_vars['match']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['match'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['match']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['match']):
        $this->_foreach['match']['iteration']++;
?>
                                    <div class="match-det<?php if ($this->_foreach['match']['iteration'] > 2): ?> hide<?php endif; ?>">
                                        <div class="match-type-containnorClass"><?php echo $this->_tpl_vars['match']['type']; ?>
</div>
                                        <div class="match-type-containnorClass" style="width:44%">
                                            <div class="flagsClassImages">
                                                <div class="classImages"><img style="width:100%" src="<?php echo $this->_tpl_vars['imageurl']; ?>
<?php echo $this->_tpl_vars['match']['t2flag']; ?>
" alt="<?php echo $this->_tpl_vars['match']['t1name']; ?>
"></div>
                                                <span><?php echo $this->_tpl_vars['match']->team1Details->teamname; ?>
</span>
                                            </div>
                                            <div class="vs-class-containnor">Vs</div>
                                            <div class="flagsClassImages">
                                                <div class="classImages"><img style="width:100%" src="<?php echo $this->_tpl_vars['imageurl']; ?>
<?php echo $this->_tpl_vars['match']['t1flag']; ?>
" alt="<?php echo $this->_tpl_vars['match']['t2name']; ?>
"></div>
                                                <span><?php echo $this->_tpl_vars['match']->team2Details->teamname; ?>
</span>
                                            </div>
                                        </div>
                                        <div class="match-type-containnorClass" style="width:30%; line-height:19px;"><br/><?php echo ((is_array($_tmp=$this->_tpl_vars['match']['match_date'])) ? $this->_run_mod_handler('date_format', true, $_tmp, '%a %R') : smarty_modifier_date_format($_tmp, '%a %R')); ?>
 IST<br/><?php echo ((is_array($_tmp=$this->_tpl_vars['match']['match_date'])) ? $this->_run_mod_handler('date_format', true, $_tmp, '%d-%m-%Y') : smarty_modifier_date_format($_tmp, '%d-%m-%Y')); ?>
</div>
                                    </div>
                               	<?php $this->assign('matchDetCount', $this->_foreach['match']['iteration']); ?>
                            <?php endforeach; endif; unset($_from); ?>
						<?php else: ?>
                        	<div class="match-type-containnorClass"><?php echo $this->_tpl_vars['match']->type; ?>
</div>
                            <div class="match-type-containnorClass" style="width:44%">
                                <div class="flagsClassImages">
                                    <div class="classImages"><img style="width:100%" src="<?php echo $this->_tpl_vars['imageurl']; ?>
<?php echo $this->_tpl_vars['match']->team1Details->flag_url; ?>
" alt="<?php echo $this->_tpl_vars['match']->team1Details->teamname; ?>
"></div>
                                    <span><?php echo $this->_tpl_vars['match']->team1Details->teamname; ?>
</span>
                                </div>
                                <div class="vs-class-containnor">Vs</div>
                                <div class="flagsClassImages">
                                    <div class="classImages"><img style="width:100%" src="<?php echo $this->_tpl_vars['imageurl']; ?>
<?php echo $this->_tpl_vars['match']->team2Details->flag_url; ?>
" alt="<?php echo $this->_tpl_vars['match']->team2Details->teamname; ?>
"></div>
                                    <span><?php echo $this->_tpl_vars['match']->team2Details->teamname; ?>
</span>
                                </div>
                            </div>
                            <div class="match-type-containnorClass" style="width:30%;"><?php echo ((is_array($_tmp=$this->_tpl_vars['tournament']->endtime)) ? $this->_run_mod_handler('date_format', true, $_tmp, '%A %R') : smarty_modifier_date_format($_tmp, '%A %R')); ?>
</div>
						<?php endif; ?>
					</div>
                    <?php if ($this->_tpl_vars['matchDetCount'] > 2): ?>
	                    <div class="btn-class-corner-classs match-list" style="margin:4px 4px 0 0" onclick="zeal.tournament.joinTourMore();">More..</div>
					<?php endif; ?>
				</div>
				<div class="inner-Join-containnor-text joined-user" id="joitournamentId-1" style="display:none;" >
					<div class="play-det-cont" style=" float:left;margin:10px 0 0 0; width:100%; height: 200px; overflow-y: auto;">
                    	<?php $this->assign('joinplaycount', 0); ?>
						<?php $_from = $this->_tpl_vars['players']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['players'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['players']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['player']):
        $this->_foreach['players']['iteration']++;
?>
	                         <div class="name-Containnor-text play-det<?php if ($this->_foreach['players']['iteration'] > 4): ?> hide<?php endif; ?>"><?php echo $this->_tpl_vars['player']['username']; ?>
</div> <br/>
                            <?php $this->assign('joinplaycount', $this->_foreach['players']['iteration']); ?>
                        <?php endforeach; endif; unset($_from); ?>
					</div>
                    <?php if ($this->_tpl_vars['joinplaycount'] > 4): ?>
						<div class="btn-class-corner-classs player-list" onclick="zeal.tournament.playerList();">More..</div>
					<?php endif; ?>
				</div>
				<div class="inner-Join-containnor-text prize-detail" style="width:50%; display:none;float: left; margin: 20px 0 20px 130px; padding: 0 0 10px 0; height:auto" id="joitournamentId-2" >
					<div class="prize-pool-Containnor"><div class="IconeImages7" style="margin:3px 3px 0 60px;"></div>Prize pool</div>
                    <?php $_from = $this->_tpl_vars['tournament']->prize_pool->prize; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['prizes'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['prizes']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['prize']):
        $this->_foreach['prizes']['iteration']++;
?>
                        <div class="small-containnor">
                            <div class="s-noClass">
                                <?php echo $this->_foreach['prizes']['iteration']; ?>

                            </div>
                            <div class="s-noClass" style="width:70%; text-align:center;">
                                <span class="WebRupee">Rs.</span><?php echo $this->_tpl_vars['prize']; ?>

                            </div>
						</div>
                    <?php endforeach; endif; unset($_from); ?>
				</div>
			</div>
		</div>
		<div class="rightContainnorClass">
			<h1>Start Time</h1>
            <div class="timer">		
                <div id="defaultCountdown"></div>
            </div>
            <div class="btn-cotainnorClass" style="margin:30px 0 0 5px; height:90px">
                <div style="float:left; width:100%; margin:15px 0 0 0;">
                    <div class="date-column"><?php echo ((is_array($_tmp=$this->_tpl_vars['tournament']->endtime)) ? $this->_run_mod_handler('date_format', true, $_tmp, '%A') : smarty_modifier_date_format($_tmp, '%A')); ?>
</div>
                    <div class="date-column"><?php echo ((is_array($_tmp=$this->_tpl_vars['tournament']->endtime)) ? $this->_run_mod_handler('date_format', true, $_tmp, '%n %R') : smarty_modifier_date_format($_tmp, '%n %R')); ?>
 IST</div>
                    <div class="date-column"><?php echo ((is_array($_tmp=$this->_tpl_vars['tournament']->endtime)) ? $this->_run_mod_handler('date_format', true, $_tmp, '%d-%m-%Y') : smarty_modifier_date_format($_tmp, '%d-%m-%Y')); ?>
</div>
                </div>
            </div>
		</div>
		<div class="loading hide loading-tour-join"></div>
		<input type="button" onclick="zeal.tournament.closeTournament()" class="common-btn create-tournament-btn" value="Cancel"/>
		<?php if ($this->_tpl_vars['tournament']->entry_fee == 0): ?>
		<input type="button" onclick="zeal.tournament.checkUserLike(<?php echo $this->_tpl_vars['tournament']->id; ?>
, <?php echo $this->_tpl_vars['tournament']->tournament_type_id; ?>
, this);" class="common-btn create-tournament-btn" value="Join tournament"/>
		<?php else: ?>
		<input type="button" onclick="zeal.tournament.confirmJoin(<?php echo $this->_tpl_vars['tournament']->id; ?>
, <?php echo $this->_tpl_vars['tournament']->tournament_type_id; ?>
, this);" class="common-btn create-tournament-btn" value="Join tournament"/>
		<?php endif; ?>
	</div>
</div>
<div class="insufficient-innercontainer insufficientcash">
	<div class="inner-header"><div class="tournlobbybutton">Insufficient Cash</div></div>
	<div class="joinquestion" style="margin-left:20px;">Sorry you do not have sufficient balance, you can add funds to start playing for real money</div>
	<div class="tournregis-divider"></div>
	<input type="button" value="Add funds" class="addfunds" style="height:30px; margin:10px 0 0 180px;" onclick="window.location.href='deposit'"/>
</div>
<script type="text/javascript">
var servertime = new Date(<?php echo ((is_array($_tmp=$this->_tpl_vars['now'])) ? $this->_run_mod_handler('date_format', true, $_tmp, '%Y') : smarty_modifier_date_format($_tmp, '%Y')); ?>
, <?php echo ((is_array($_tmp=$this->_tpl_vars['now'])) ? $this->_run_mod_handler('date_format', true, $_tmp, '%m') : smarty_modifier_date_format($_tmp, '%m')); ?>
, <?php echo ((is_array($_tmp=$this->_tpl_vars['now'])) ? $this->_run_mod_handler('date_format', true, $_tmp, '%d') : smarty_modifier_date_format($_tmp, '%d')); ?>
, <?php echo ((is_array($_tmp=$this->_tpl_vars['now'])) ? $this->_run_mod_handler('date_format', true, $_tmp, '%H') : smarty_modifier_date_format($_tmp, '%H')); ?>
, <?php echo ((is_array($_tmp=$this->_tpl_vars['now'])) ? $this->_run_mod_handler('date_format', true, $_tmp, '%M') : smarty_modifier_date_format($_tmp, '%M')); ?>
, <?php echo ((is_array($_tmp=$this->_tpl_vars['now'])) ? $this->_run_mod_handler('date_format', true, $_tmp, '%S') : smarty_modifier_date_format($_tmp, '%S')); ?>
);
zeal.tournament.calculateTime(<?php echo ((is_array($_tmp=$this->_tpl_vars['tournament']->endtime)) ? $this->_run_mod_handler('date_format', true, $_tmp, '%Y') : smarty_modifier_date_format($_tmp, '%Y')); ?>
, <?php echo ((is_array($_tmp=$this->_tpl_vars['tournament']->endtime)) ? $this->_run_mod_handler('date_format', true, $_tmp, '%m') : smarty_modifier_date_format($_tmp, '%m')); ?>
, <?php echo ((is_array($_tmp=$this->_tpl_vars['tournament']->endtime)) ? $this->_run_mod_handler('date_format', true, $_tmp, '%d') : smarty_modifier_date_format($_tmp, '%d')); ?>
, <?php echo ((is_array($_tmp=$this->_tpl_vars['tournament']->endtime)) ? $this->_run_mod_handler('date_format', true, $_tmp, '%H') : smarty_modifier_date_format($_tmp, '%H')); ?>
, <?php echo ((is_array($_tmp=$this->_tpl_vars['tournament']->endtime)) ? $this->_run_mod_handler('date_format', true, $_tmp, '%M') : smarty_modifier_date_format($_tmp, '%M')); ?>
, <?php echo ((is_array($_tmp=$this->_tpl_vars['tournament']->endtime)) ? $this->_run_mod_handler('date_format', true, $_tmp, '%S') : smarty_modifier_date_format($_tmp, '%S')); ?>
);
</script>