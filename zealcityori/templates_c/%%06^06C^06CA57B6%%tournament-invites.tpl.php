<?php /* Smarty version 2.6.27, created on 2014-04-11 12:54:17
         compiled from tournament-invites.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'tournament-invites.tpl', 50, false),)), $this); ?>
				<div class="index-second">					
					<?php if (isset ( $this->_tpl_vars['allUserTournaments'] ) || isset ( $this->_tpl_vars['weeklyTournaments'] )): ?>
					<div class="index-left2" style="margin:0;">
						<!----------------------------------------------- Tournament : Start ------------------------------------------------>
						<div class="tournament" id="tournament1">
							<div class="tournament-lobby-head">
								<div class="tournament-lobby-title">Invited Tournaments</div>
								<a href="<?php echo $this->_tpl_vars['base_dir']; ?>
create-tournament"><input type="button" class="common-btn create-tournament-btn" value="Create Tournament"/></a>
								<!--<div class="championship-text"><div class="champion-icon-star-header"></div> - <a href="leaderboard">Championship</a><a target="_blank" href="championship-leaderboard.php"><img src="<?php echo $this->_tpl_vars['base_dir']; ?>
images/question_icon.png" alt="" style="margin:13px 0 0 5px;"/></a></div>-->
							</div>
							<div class="tournament-lobby-body">
								<div class="tournament-lobby-inner all-tournament">
									<div class="tournament-lobby-inner-head">
										<div class="tournament-loby-left-menu">
											<ul>
												<li class="active" onclick="zeal.tournament.showTournament('all-tournament', 'index-lobby-room', 'index-lobby-room', this)">All Tournaments</li>
												<li onclick="zeal.tournament.showTournament('all-tournament', 'index-lobby-room', 'daily-tournament', this)">Daily</li>
												<li onclick="zeal.tournament.showTournament('all-tournament', 'index-lobby-room', 'weekly-tournament', this)">Weekly</li>
												<li onclick="zeal.tournament.showTournament('all-tournament', 'index-lobby-room', 'series-tournament', this)">Series</li>
											</ul>
										</div>
									</div>
									<div class="tournament-lobby-inner-right">
										<div class="tournament-lobby-inner-head-title">
											<ul>
												<li class="extra-large">Tournament Name</li>
												<li class="large">Type</li>
												<li class="large">Entry fee</li>
												<li class="large">Players</li>
												<li class="large">Prizes</li>
												<li class="extra-large">Start time ( IST )</li>
											</ul>
										</div>
										<!--<img src="<?php echo $this->_tpl_vars['base_dir']; ?>
images/tri-series.jpg" alt="" width="593px" height="215px" />-->
										<div id="tournament">
											<?php $_from = $this->_tpl_vars['allUserTournaments']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['tournaments'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['tournaments']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['tournament']):
        $this->_foreach['tournaments']['iteration']++;
?>
											<?php if ($this->_tpl_vars['userid'] != $this->_tpl_vars['tournament']['user_id']): ?>
											<div class="index-lobby-room daily-tournament">
												<div class="divider"></div>
												<div class="extra-large"><?php echo $this->_tpl_vars['tournament']['name']; ?>
</div>
												<div class="divider"></div>
												<div class="large"><?php echo $this->_tpl_vars['tournament']['nickname']; ?>
</div>
												<div class="divider"></div>
												<div class="large"><span class="WebRupee">Rs.</span><?php echo $this->_tpl_vars['tournament']['amount']; ?>
</div>
												<div class="divider"></div>
												<div class="large"><?php echo $this->_tpl_vars['tournament']['reg_player']; ?>
/<?php echo $this->_tpl_vars['tournament']['player']; ?>
</div>
												<div class="divider"></div>
												<div class="large"><span class="WebRupee">Rs.</span><?php echo $this->_tpl_vars['tournament']['prize']; ?>
</div>
												<div class="divider"></div>
												<div class="extra-large"><?php echo ((is_array($_tmp=$this->_tpl_vars['tournament']['endtime'])) ? $this->_run_mod_handler('date_format', true, $_tmp, '%a %R %p %e %b') : smarty_modifier_date_format($_tmp, '%a %R %p %e %b')); ?>
 </div>
												<div class="divider"></div>
												<div class="medium">
												<?php if ($this->_tpl_vars['tournament']['status'] == 'Closed'): ?>
												<a href="#" class="lobby-join-closed">Closed</a>
												<?php else: ?>
													<?php if ($this->_tpl_vars['tournament']['tournament_id']): ?>
													<a href="<?php echo $this->_tpl_vars['base_dir']; ?>
my-period-tournament-details/<?php echo $this->_tpl_vars['tournament']['tournament_type_id']; ?>
-type/<?php echo $this->_tpl_vars['tournament']['id']; ?>
" class="lobby-join" >Enter</a>
													<?php else: ?>
													<a href="#" onclick="zeal.tournament.selectTournament(<?php echo $this->_tpl_vars['tournament']['id']; ?>
, <?php echo $this->_tpl_vars['tournament']['tournament_type_id']; ?>
)" class="lobby-join" >Join</a>
													<?php endif; ?>
												<?php endif; ?>
												</div>
											</div>
											<?php endif; ?>
											<?php endforeach; endif; unset($_from); ?>
											<?php $_from = $this->_tpl_vars['weeklyTournaments']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['weeklyTournaments'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['weeklyTournaments']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['tournament']):
        $this->_foreach['weeklyTournaments']['iteration']++;
?>
											<?php if ($this->_tpl_vars['userid'] != $this->_tpl_vars['tournament']['user_id']): ?>
											<div class="index-lobby-room<?php if ($this->_tpl_vars['tournament']['tournament_type_id'] == 5 || $this->_tpl_vars['tournament']['tournament_type_id'] == 7): ?> weekly-tournament<?php else: ?> series-tournament<?php endif; ?>">
												<div class="divider"></div>
												<div class="extra-large"><?php echo $this->_tpl_vars['tournament']['name']; ?>
</div>
												<div class="divider"></div>
												<div class="large"><?php echo $this->_tpl_vars['tournament']['nickname']; ?>
</div>
												<div class="divider"></div>
												<div class="large"><span class="WebRupee">Rs.</span><?php echo $this->_tpl_vars['tournament']['amount']; ?>
</div>
												<div class="divider"></div>
												<div class="large"><?php echo $this->_tpl_vars['tournament']['reg_player']; ?>
/<?php echo $this->_tpl_vars['tournament']['player']; ?>
</div>
												<div class="divider"></div>
												<div class="large"><span class="WebRupee">Rs.</span><?php echo $this->_tpl_vars['tournament']['prize']; ?>
</div>
												<div class="divider"></div>
												<div class="extra-large"><?php echo ((is_array($_tmp=$this->_tpl_vars['tournament']['endtime'])) ? $this->_run_mod_handler('date_format', true, $_tmp, '%a %R %p %e %b') : smarty_modifier_date_format($_tmp, '%a %R %p %e %b')); ?>
 </div>
												<div class="divider"></div>
												<div class="medium">
												<?php if ($this->_tpl_vars['tournament']['status'] == 'Closed'): ?>
												<a href="#" class="lobby-join-closed">Closed</a>
												<?php else: ?>											
													<?php if ($this->_tpl_vars['tournament']['pt_id']): ?>
													<a href="<?php echo $this->_tpl_vars['base_dir']; ?>
my-period-tournament-details/<?php echo $this->_tpl_vars['tournament']['tournament_type_id']; ?>
-type/<?php echo $this->_tpl_vars['tournament']['id']; ?>
" class="lobby-join" >Enter</a>
													<?php else: ?>
													<a href="#" onclick="zeal.tournament.selectTournament(<?php echo $this->_tpl_vars['tournament']['id']; ?>
, <?php echo $this->_tpl_vars['tournament']['tournament_type_id']; ?>
)" class="lobby-join" >Join</a>
													<?php endif; ?>
												<?php endif; ?>									
												</div>
											</div>
											<?php endif; ?>
											<?php endforeach; endif; unset($_from); ?>
										</div>
									</div>
								</div>
								<div class="view-all-tour-btn"></div>
							</div>
						</div>
						<!----------------------------------------------- Tournament : Ends ------------------------------------------------>
					</div>
					<?php else: ?>
						<div style="width:100%; font-size:25px; text-align:center">No invited tournament</div>
					<?php endif; ?>					
					
				</div>