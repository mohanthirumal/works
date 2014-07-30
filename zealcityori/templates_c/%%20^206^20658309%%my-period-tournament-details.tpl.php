<?php /* Smarty version 2.6.27, created on 2014-04-21 14:50:00
         compiled from my-period-tournament-details.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'my-period-tournament-details.tpl', 18, false),array('modifier', 'count', 'my-period-tournament-details.tpl', 62, false),)), $this); ?>
<div class="tournamentInfoClass">
	<div class="tournamentInfoClassHeader">
		<a href="<?php echo $this->_tpl_vars['base_dir']; ?>
tournament"><div class="tournament-back-icon"></div></a>
		<div class="headermenuClass btn-size active" onclick="zeal.tournament.showTournamentDetails('tournamentInfoClass', 'tour-details', 'tour-details1', this)"><div class="IconeImages"></div>Tournament Info</div>
		<?php if ($this->_tpl_vars['tournament']->status != 'Destroyed'): ?>
        <?php if ($this->_tpl_vars['user']->id == $this->_tpl_vars['tournament']->creator->id): ?>
		<div class="headermenuClass btn-size" onclick="zeal.tournament.showTournamentDetails('tournamentInfoClass', 'tour-details', 'tour-details2', this)"><div class="IconeImages2"></div>Invitations</div>
        <?php endif; ?>
		<div class="headermenuClass btn-size" onclick="zeal.tournament.showTournamentDetails('tournamentInfoClass', 'tour-details', 'tour-details3', this)"><div class="IconeImages3"></div>My Team </div>
		<div class="headermenuClass btn-size" onclick="zeal.tournament.showTournamentDetails('tournamentInfoClass', 'tour-details', 'tour-details4', this)"><div class="IconeImages4"></div>Result</div>
		<?php endif; ?>
	</div>
	<div class="tour-details tour-details1<?php if (isset ( $this->_tpl_vars['new'] ) && $this->_tpl_vars['user']->id == $this->_tpl_vars['tournament']->creator->id): ?> hide<?php endif; ?>">
		<div class="tournamentInfoContentClass">
			<div class="InnerJoinClassContainnor" style="margin-top:20px; height:90px;">
				<div class="ClassContainnor">
					<div class="widthContainner">Start Time:</div>
					<div class="valueContainnerClass23"><div class="timeClass" style="font-size: 15px;"><?php echo ((is_array($_tmp=$this->_tpl_vars['tournament']->endtime)) ? $this->_run_mod_handler('date_format', true, $_tmp, '%d-%m-%Y %H:%M:%S') : smarty_modifier_date_format($_tmp, '%d-%m-%Y %H:%M:%S')); ?>
</div></div>
					<div class="timer" style="margin-left:24px;"><div class="period-tournament-timer"></div></div>
				</div>
			</div>
			<div class="InnerJoinContent_class">
				<div class="InnerContent-text">
					<div class="btn-background-Class-one">
						<div class="header-title-class">Tournament ID</div>
						<div class="header-title-class2">Tournament Name</div>
						<div class="header-title-class2">Tournament Creator</div>
						<div class="header-title-class2">Tournament Type</div>
						<div class="header-title-class2">Entry Fee</div>
						<div class="header-title-class2">Players</div>
						<div class="header-title-class2">Prizes</div>
						<div class="header-title-class2">Schedule</div>
						<div class="header-title-class2">Status</div>
					</div>
				</div>
				<div class="InnerContent-text1">
					<div class="btn-background-Class" style="padding-bottom:35px">
						<div class="valueContainnerClass">00000<?php echo $this->_tpl_vars['tournament']->id; ?>
</div>
						<div class="valueContainnerClass2"><?php echo $this->_tpl_vars['tournament']->name; ?>
</div>
						<?php if ($this->_tpl_vars['tournament']->creator->id == 0): ?>
						<div class="valueContainnerClass2">Zealcity</div>
						<?php else: ?>
						<div class="valueContainnerClass2"><?php echo $this->_tpl_vars['tournament']->creator->username; ?>
</div>
						<?php endif; ?>
						<div class="valueContainnerClass2"><?php echo $this->_tpl_vars['tournament']->tournament_type->nickname; ?>
</div>
						<div class="valueContainnerClass2"><?php echo $this->_tpl_vars['tournament']->entry_fee; ?>
</div>
						<div class="valueContainnerClass2"><?php echo $this->_tpl_vars['tournament']->joinPlayers; ?>
/<?php echo $this->_tpl_vars['tournament']->players; ?>
</div>
						<div class="valueContainnerClass2" id="tour-prize1">
						<?php $_from = $this->_tpl_vars['tournament']->prize_pool->prize; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['prizes'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['prizes']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['prize']):
        $this->_foreach['prizes']['iteration']++;
?>
							<span class="WebRupee">Rs.</span><?php echo $this->_tpl_vars['prize']; ?>
<?php if (! ($this->_foreach['prizes']['iteration'] == $this->_foreach['prizes']['total'])): ?>, <?php endif; ?>
						<?php endforeach; endif; unset($_from); ?>
						</div>
						<div class="valueContainnerClass2"><?php echo $this->_tpl_vars['matchescount']; ?>
</div>
						<div class="valueContainnerClass2"<?php if ($this->_tpl_vars['tournament']->status == 'Destroyed'): ?> style="color:#f00;"<?php endif; ?>><?php echo $this->_tpl_vars['tournament']->status; ?>
</div>
					</div>
				</div>
			</div>
			<div class="valueContainnerClass23" style="width:25%; float:left; margin:180px 0 0 0; font-size:15px;">
				<?php if ($this->_tpl_vars['user']->id == $this->_tpl_vars['tournament']->creator->id && $this->_tpl_vars['tournament']->status != 'Destroyed'): ?>
					<a href="javascript:zeal.tournament.showTournamentDetails('tournamentInfoClass', 'tour-details', 'tour-details2', this);">Invite more players</a>
				<?php endif; ?>
				<?php if (count($this->_tpl_vars['tournament']->prize_pool->prize) > 4): ?>
				<a href="javascript:$('#tour-prize1').css('height','auto');" style="margin:145px 0 0 5px; float:left;">More</a>
				<?php endif; ?>
			</div>
			<!--<div class="InnerJoinClassContainnor">
				<div class="ClassContainnor">
					<div class="widthContainner">Rule</div>
					<div class="valueContainnerClass23"><a href="<?php echo $this->_tpl_vars['base_dir']; ?>
tournament-and-how-it-works" target="_blank">Rules For weekly Tournament</a></div>
				</div>
			</div>-->
			
			<?php if ($this->_tpl_vars['user']->id == $this->_tpl_vars['tournament']->creator->id && $this->_tpl_vars['tournament']->status != 'Destroyed'): ?>
			<?php if ($this->_tpl_vars['tournament']->joinPlayers == 1): ?>
			<a href="javascript:zeal1.tournament.destroyTournament(<?php echo $this->_tpl_vars['tournament']->id; ?>
, <?php echo $this->_tpl_vars['tournament']->tournament_type_id; ?>
, <?php echo $this->_tpl_vars['user']->id; ?>
, '<?php echo $this->_tpl_vars['user']->secure_key; ?>
');"><div class="Cancel-btn-class">Cancel Tournament</div></a>
			<?php endif; ?>
			<?php endif; ?>
		</div>
		
	</div>
	<div class="tour-details tour-details2<?php if (! isset ( $this->_tpl_vars['new'] ) || $this->_tpl_vars['user']->id != $this->_tpl_vars['tournament']->creator->id): ?> hide<?php endif; ?>">
		<div class="tournamentInfoContentClass1">
			<div class="tournamentInfoContentClass-inner">
				<div class="tournament-info-left">
					<div class="tournamentInfoContentClass-invites">
						<div class="tournament-info-title" style="margin-left:40px;">Invited friend list</div>
						<div class="tournament-info-invited">
						<div class="tour-info-invited-image">Name</div>
						<div class="tour-info-invited-image">Status</div>
						<?php if ($this->_tpl_vars['invites'] || $this->_tpl_vars['emailinvites']): ?>
						<?php $_from = $this->_tpl_vars['invites']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['invites'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['invites']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['invite']):
        $this->_foreach['invites']['iteration']++;
?>
						<div class="tour-info-invited-indi">
							<div class="tour-info-invited-image">
							<img src="https://graph.facebook.com/<?php echo $this->_tpl_vars['invite']['facebook_id']; ?>
/picture" alt=""/>
							</div>
							<div class="tour-info-invited-image">
							<?php if ($this->_tpl_vars['invite']['status'] == 0): ?>Pending<?php else: ?>Joined<?php endif; ?>
							</div>
						</div>
						<?php endforeach; endif; unset($_from); ?>
						<?php $_from = $this->_tpl_vars['emailinvites']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['invites'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['invites']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['invite']):
        $this->_foreach['invites']['iteration']++;
?>
						<div class="tour-info-invited-indi">
							<div class="tour-info-invited-image"><?php echo $this->_tpl_vars['invite']['name']; ?>
</div>
							<div class="tour-info-invited-image">
							<?php if ($this->_tpl_vars['invite']['status'] == 0): ?>Pending<?php else: ?>Joined<?php endif; ?>
							</div>
						</div>
						<?php endforeach; endif; unset($_from); ?>
						<?php else: ?><div style="width:100%; font-size:20px; text-align:center">No Invitation sent</div><?php endif; ?>
						</div>
					</div>
				</div>
				<div class="tournament-info-right">
					<h1>Invite Friends to your tournament</h1>
					<div class="tournament-info-title">Invite friends</div><!--<div class="tournament-info-title">My Buddies</div>-->
					<div class="tournament-info-invite-right">
						<div class="tournament-info-invite-right-inner">
							<div class="tour-info-invite-btn-cont">
								<div class="tour-info-facebook-cont">
									Invite via Facebook(Recommended)
									<img onclick="zeal1.facebook.facebookConnect(<?php echo $this->_tpl_vars['user']->id; ?>
);" src="<?php echo $this->_tpl_vars['base_dir']; ?>
images/fbbutton.png" alt=""/>
								</div>
								<div class="tour-info-or-cont">Or</div>
								<div class="tour-info-email-cont">
									<input type="button" value="E-mail" class="tour-info-email-btn" onclick="zeal1.tournament.showEmailInvite()"/>
								</div>
							</div>
							<div class="clear"></div>
							<div class="tour-info-invite-list-cont hide">
								<div class="tournament-info-email-invite hide">
									<form method="post" id="emailinvite">
										<input type="text" name="name[]" placeholder="Name"/>
										<input type="text" name="email[]" placeholder="Email"/><br/>
										<input type="text" name="name[]" placeholder="Name"/>
										<input type="text" name="email[]" placeholder="Email"/><br/>
										<div id="add-email-invite"></div>
										<div class="tour-info-add-user-cont">
											<a href="javascript:zeal1.tournament.addEmailInvite();">Add more...</a>
										</div>
										<input class="tournament-add-friends-btn" type="button" value="Send Invite" onclick="zeal1.tournament.sendEmailInvite(<?php echo $this->_tpl_vars['tournament']->id; ?>
, <?php echo $this->_tpl_vars['tournament']->tournament_type_id; ?>
, this, '<?php echo $this->_tpl_vars['user']->secure_key; ?>
')" style="margin:20px 0 20px 280px;"/>
									</form>
								</div>
								<div class="tournament-info-fb-invite hide">
									<div class="tournament-info-trans-full">
										<div class="friends-list">
                                        	<div class="searFri" style="display:none;">
                                        	<div class="all-friends">All Friends</div>
                                            <input type="text" name="search" id="search" value="" class="search-tbox" onkeyup="zeal1.facebook.searchFriend();"/>                
                                            <div class="serach-caption">SEARCH</div>
                                            </div>
											<div id="friendsList"><div class="loading"></div></div>
											<input type="button" name="invite-friends" value="Send Invite" onclick="zeal1.tournament.completeTournament(<?php echo $this->_tpl_vars['tournament']->id; ?>
, <?php echo $this->_tpl_vars['tournament']->tournament_type_id; ?>
);" class="tournament-add-invite-btn"/>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="tour-details tour-details3" style="display:none;">
		<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'my-period-tournament-my-team.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	</div>
	<div class="tour-details tour-details4" style="display:none;">
		<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'my-period-tournament-result.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	</div>
</div>
<script type="text/javascript">
var matchservertime = new Date(<?php echo ((is_array($_tmp=$this->_tpl_vars['now'])) ? $this->_run_mod_handler('date_format', true, $_tmp, '%Y') : smarty_modifier_date_format($_tmp, '%Y')); ?>
, <?php echo ((is_array($_tmp=$this->_tpl_vars['now'])) ? $this->_run_mod_handler('date_format', true, $_tmp, '%m') : smarty_modifier_date_format($_tmp, '%m')); ?>
, <?php echo ((is_array($_tmp=$this->_tpl_vars['now'])) ? $this->_run_mod_handler('date_format', true, $_tmp, '%d') : smarty_modifier_date_format($_tmp, '%d')); ?>
, <?php echo ((is_array($_tmp=$this->_tpl_vars['now'])) ? $this->_run_mod_handler('date_format', true, $_tmp, '%H') : smarty_modifier_date_format($_tmp, '%H')); ?>
, <?php echo ((is_array($_tmp=$this->_tpl_vars['now'])) ? $this->_run_mod_handler('date_format', true, $_tmp, '%M') : smarty_modifier_date_format($_tmp, '%M')); ?>
, <?php echo ((is_array($_tmp=$this->_tpl_vars['now'])) ? $this->_run_mod_handler('date_format', true, $_tmp, '%S') : smarty_modifier_date_format($_tmp, '%S')); ?>
);
zeal.tournament.periodTourTime(<?php echo ((is_array($_tmp=$this->_tpl_vars['tournament']->endtime)) ? $this->_run_mod_handler('date_format', true, $_tmp, '%Y') : smarty_modifier_date_format($_tmp, '%Y')); ?>
, <?php echo ((is_array($_tmp=$this->_tpl_vars['tournament']->endtime)) ? $this->_run_mod_handler('date_format', true, $_tmp, '%m') : smarty_modifier_date_format($_tmp, '%m')); ?>
, <?php echo ((is_array($_tmp=$this->_tpl_vars['tournament']->endtime)) ? $this->_run_mod_handler('date_format', true, $_tmp, '%d') : smarty_modifier_date_format($_tmp, '%d')); ?>
, <?php echo ((is_array($_tmp=$this->_tpl_vars['tournament']->endtime)) ? $this->_run_mod_handler('date_format', true, $_tmp, '%H') : smarty_modifier_date_format($_tmp, '%H')); ?>
, <?php echo ((is_array($_tmp=$this->_tpl_vars['tournament']->endtime)) ? $this->_run_mod_handler('date_format', true, $_tmp, '%M') : smarty_modifier_date_format($_tmp, '%M')); ?>
, <?php echo ((is_array($_tmp=$this->_tpl_vars['tournament']->endtime)) ? $this->_run_mod_handler('date_format', true, $_tmp, '%S') : smarty_modifier_date_format($_tmp, '%S')); ?>
);
</script>