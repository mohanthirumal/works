<?php /* Smarty version 2.6.27, created on 2014-07-10 11:59:20
         compiled from tournament.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'count_characters', 'tournament.tpl', 215, false),array('modifier', 'date_format', 'tournament.tpl', 227, false),)), $this); ?>
				<div class="index-second">					
					<?php if (isset ( $this->_tpl_vars['tournaments'] )): ?>
					<div class="index-left2" style="margin:0;">
						<div class="tournament-tab tournament-tab">
							<ul>
								<li class="active" onclick="zeal.index.showContent('tournament', 'tournament', 1, this, 'tournament-tab')">Tournaments</li>
								<?php if (isset ( $this->_tpl_vars['mytournaments'] )): ?>
								<li onclick="zeal.index.showContent('tournament', 'tournament', 2, this, 'tournament-tab')">My Tournaments</li>
								<?php endif; ?>
							</ul>
						</div>
						<!----------------------------------------------- Tournament : Start ------------------------------------------------>
						<div class="tournament" id="tournament1">
							<div class="tournament-lobby-head">
								<div class="tournament-lobby-title">Tournaments</div>
								<?php if ($this->_tpl_vars['nextMatch']['match_date']): ?>
								<div class="next-starts-in">
									<div class="next-match-start-text">Next match starts in<div class="next-starts-in-counter" id="next-starts-in"></div></div>
								</div>
								<div class="tournament-match-flag">
									<div class="flag"><img src="<?php echo $this->_tpl_vars['tourimageurl']; ?>
teamsflags/<?php echo $this->_tpl_vars['nextMatch']['t1flag']; ?>
" alt=""></div>
									<div class="v-image-area"></div>
									<div class="flag flag-op"><img src="<?php echo $this->_tpl_vars['tourimageurl']; ?>
teamsflags/<?php echo $this->_tpl_vars['nextMatch']['t2flag']; ?>
" alt=""></div>
								</div>
								<?php endif; ?>
								<?php if ($this->_tpl_vars['cookie']->user_id): ?>
								<a href="<?php echo $this->_tpl_vars['base_dir']; ?>
create-tournament"><input type="button" class="common-btn create-tournament-btn" value="Create Tournament"/></a>
								<?php endif; ?>
								<!--<div class="championship-text"><div class="champion-icon-star-header"></div> - <a href="leaderboard">Championship</a><a target="_blank" href="championship-leaderboard.php"><img src="<?php echo $this->_tpl_vars['base_dir']; ?>
images/question_icon.png" alt="" style="margin:13px 0 0 5px;"/></a></div>-->
							</div>
							<div class="tournament-lobby-body">
								<div class="tournament-lobby-inner all-tournament">
									<div class="tournament-lobby-inner-head">
										<div class="tournament-loby-left-menu">
											<ul>
												<li class="tour-lobby-room-li" class="active" onclick="zeal.tournament.showTournament('all-tournament', 'tour-lobby-room', 'tour-lobby-room', this)">All Tournaments</li>
												<li class="daily-tournament-li" onclick="zeal.tournament.showTournament('all-tournament', 'tour-lobby-room', 'daily-tournament', this)">Daily</li>
												<li class="weekly-tournament-li" onclick="zeal.tournament.showTournament('all-tournament', 'tour-lobby-room', 'weekly-tournament', this)">Weekly</li>
												<li class="series-tournament-li" onclick="zeal.tournament.showTournament('all-tournament', 'tour-lobby-room', 'series-tournament', this)">Series</li>
												<li class="invited-li" onclick="zeal.tournament.showTournament('all-tournament', 'tour-lobby-room', 'invited', this)">Invited</li>
												<li class="free-tournament-li" onclick="zeal.tournament.showTournament('all-tournament', 'tour-lobby-room', 'free-tournament', this)">Free</li>
												<li class="cash-tournament-li" onclick="zeal.tournament.showTournament('all-tournament', 'tour-lobby-room', 'cash-tournament', this)">Cash</li>
											</ul>
										</div>
									</div>
									<div class="tournament-lobby-inner-right">
									<div id="tournament">
										<?php $_from = $this->_tpl_vars['tournaments']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['matches'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['matches']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['match']):
        $this->_foreach['matches']['iteration']++;
?>
											<?php $_from = $this->_tpl_vars['match']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['tournaments'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['tournaments']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['tournament']):
        $this->_foreach['tournaments']['iteration']++;
?>
											<div class="tounament-row-cont tour-lobby-room daily-tournament<?php if ($this->_tpl_vars['tournament']['entryfee'] == 0): ?> free-tournament<?php else: ?> cash-tournament<?php endif; ?>">
												<div class="tournament-row-type">
													<div class="tournament-row-type-flag">
														<div class="flag"><img src="<?php echo $this->_tpl_vars['tourimageurl']; ?>
teamsflags/<?php echo $this->_tpl_vars['tournament']['flag1']; ?>
" alt=""></div>
														<div class="v-image-area"></div>
														<div class="flag flag-op"><img src="<?php echo $this->_tpl_vars['tourimageurl']; ?>
teamsflags/<?php echo $this->_tpl_vars['tournament']['flag2']; ?>
" alt=""></div>
													</div>
													<div class="tour-row-type-win-text"><?php echo $this->_tpl_vars['tournament']['prizetype']; ?>
</div>
													<div class="tour-row-type-win-cash"><span class="WebRupee">Rs.</span> <?php echo $this->_tpl_vars['tournament']['prize']; ?>
</div>
												</div>
												<?php $_from = $this->_tpl_vars['tournament']['tour']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['tours'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['tours']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['tour']):
        $this->_foreach['tours']['iteration']++;
?>
												<div class="tour-row-player-entry">
													<div class="tour-row-player-count"><span><?php echo $this->_tpl_vars['tour']['player']; ?>
</span> Players</div>
													<div class="tour-row-player-joined">Players <?php echo $this->_tpl_vars['tour']['reg_player']; ?>
/<?php echo $this->_tpl_vars['tour']['player']; ?>
</div>
													<div class="tour-row-enrty-fee"><?php if ($this->_tpl_vars['tour']['amount'] == 0): ?><b>Free</b><?php else: ?>Enrty Fee <span class="WebRupee">Rs.</span><?php echo $this->_tpl_vars['tour']['amount']; ?>
<?php endif; ?></div>
													<?php if ($this->_tpl_vars['tour']['tournament_id']): ?>
													<?php if ($this->_tpl_vars['tour']['tournament_type_id'] == 1): ?>
													<a href="<?php echo $this->_tpl_vars['base_dir']; ?>
my-team/<?php echo $this->_tpl_vars['tour']['tournament_type_id']; ?>
-type/<?php echo $this->_tpl_vars['tour']['id']; ?>
/0" class="tour-row-join-btn" >Enter</a>
													<?php else: ?>
													<a href="<?php echo $this->_tpl_vars['base_dir']; ?>
my-period-tournament-details/<?php echo $this->_tpl_vars['tour']['tournament_type_id']; ?>
-type/<?php echo $this->_tpl_vars['tour']['id']; ?>
" class="tour-row-join-btn" >Enter</a>
													<?php endif; ?>
													<?php else: ?>
													<div class="tour-row-join-btn tour-join-btn" rel="<?php echo $this->_tpl_vars['tour']['id']; ?>
,<?php echo $this->_tpl_vars['tour']['tournament_type_id']; ?>
">Join</div>
													<?php endif; ?>
												</div>
												<?php endforeach; endif; unset($_from); ?>
											</div>
											<div class="clear"></div>
											<?php endforeach; endif; unset($_from); ?>
										<?php endforeach; endif; unset($_from); ?>
										<div class="clear"></div>
										<?php $_from = $this->_tpl_vars['weeklyTournaments']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['matches'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['matches']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['match']):
        $this->_foreach['matches']['iteration']++;
?>
											<?php $_from = $this->_tpl_vars['match']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['tournaments'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['tournaments']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['tournament']):
        $this->_foreach['tournaments']['iteration']++;
?>
											<div class="tounament-row-cont tour-lobby-room <?php if ($this->_tpl_vars['tournament']['type'] == 5 || $this->_tpl_vars['tournament']['type'] == 7): ?> weekly-tournament<?php else: ?> series-tournament<?php endif; ?><?php if ($this->_tpl_vars['tournament']['entryfee'] == 0): ?> free-tournament<?php else: ?> cash-tournament<?php endif; ?>">
												<div class="tournament-row-type">
													<div class="tour-period-type-txt"><?php if ($this->_tpl_vars['tournament']['type'] == 5 || $this->_tpl_vars['tournament']['type'] == 7): ?>Weekly<?php elseif ($this->_tpl_vars['tournament']['type'] == 6 || $this->_tpl_vars['tournament']['type'] == 8): ?>Series<?php endif; ?></div>
													<div class="tour-row-type-win-text"><?php echo $this->_tpl_vars['tournament']['prizetype']; ?>
</div>
													<div class="tour-row-type-win-cash"><span class="WebRupee">Rs.</span> <?php echo $this->_tpl_vars['tournament']['prize']; ?>
</div>
												</div>
												<?php $_from = $this->_tpl_vars['tournament']['tour']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['tours'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['tours']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['tour']):
        $this->_foreach['tours']['iteration']++;
?>
												<div class="tour-row-player-entry">
													<div class="tour-row-player-count"><span><?php echo $this->_tpl_vars['tour']['player']; ?>
</span> Players</div>
													<div class="tour-row-player-joined">Players <?php echo $this->_tpl_vars['tour']['reg_player']; ?>
/<?php echo $this->_tpl_vars['tour']['player']; ?>
</div>
													<div class="tour-row-enrty-fee"><?php if ($this->_tpl_vars['tour']['amount'] == 0): ?><b>Free</b><?php else: ?>Entry Fee <span class="WebRupee">Rs.</span><?php echo $this->_tpl_vars['tour']['amount']; ?>
<?php endif; ?></div>
													<?php if ($this->_tpl_vars['tour']['pt_id']): ?>
													<a href="<?php echo $this->_tpl_vars['base_dir']; ?>
my-period-tournament-details/<?php echo $this->_tpl_vars['tour']['tournament_type_id']; ?>
-type/<?php echo $this->_tpl_vars['tour']['id']; ?>
" class="tour-row-join-btn" >Enter</a>
													<?php else: ?>
													<div class="tour-row-join-btn tour-join-btn" rel="<?php echo $this->_tpl_vars['tour']['id']; ?>
,<?php echo $this->_tpl_vars['tour']['tournament_type_id']; ?>
">Join</div>
													<?php endif; ?>
												</div>
												<?php endforeach; endif; unset($_from); ?>
											</div>
											<div class="clear"></div>
											<?php endforeach; endif; unset($_from); ?>
										<?php endforeach; endif; unset($_from); ?>
									</div>
									<div id="usertournament">
										<?php $_from = $this->_tpl_vars['usertournaments']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['matches'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['matches']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['match']):
        $this->_foreach['matches']['iteration']++;
?>
											<?php $_from = $this->_tpl_vars['match']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['tournaments'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['tournaments']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['tournament']):
        $this->_foreach['tournaments']['iteration']++;
?>
											<div class="tounament-row-cont tour-lobby-room daily-tournament<?php if ($this->_tpl_vars['tournament']['entryfee'] == 0): ?> free-tournament<?php else: ?> cash-tournament<?php endif; ?> invited">
												<div class="tournament-row-type">
													<div class="tournament-row-type-flag">
														<div class="flag"><img src="<?php echo $this->_tpl_vars['tourimageurl']; ?>
teamsflags/<?php echo $this->_tpl_vars['tournament']['flag1']; ?>
" alt=""></div>
														<div class="v-image-area"></div>
														<div class="flag flag-op"><img src="<?php echo $this->_tpl_vars['tourimageurl']; ?>
teamsflags/<?php echo $this->_tpl_vars['tournament']['flag2']; ?>
" alt=""></div>
													</div>
													<div class="tour-row-type-win-text"><?php echo $this->_tpl_vars['tournament']['prizetype']; ?>
</div>
													<div class="tour-row-type-win-cash"><span class="WebRupee">Rs.</span> <?php echo $this->_tpl_vars['tournament']['prize']; ?>
</div>
												</div>
												<?php $_from = $this->_tpl_vars['tournament']['tour']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['tours'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['tours']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['tour']):
        $this->_foreach['tours']['iteration']++;
?>
												<div class="tour-row-player-entry">
													<div class="tour-row-player-count"><span><?php echo $this->_tpl_vars['tour']['player']; ?>
</span> Players</div>
													<div class="tour-row-player-joined">Players <?php echo $this->_tpl_vars['tour']['reg_player']; ?>
/<?php echo $this->_tpl_vars['tour']['player']; ?>
</div>
													<div class="tour-row-enrty-fee">Entry Fee <span class="WebRupee">Rs.</span><?php echo $this->_tpl_vars['tour']['amount']; ?>
</div>
													<?php if ($this->_tpl_vars['tour']['tournament_id']): ?>
													<?php if ($this->_tpl_vars['tour']['tournament_type_id'] == 1): ?>
													<a href="<?php echo $this->_tpl_vars['base_dir']; ?>
my-team/<?php echo $this->_tpl_vars['tour']['tournament_type_id']; ?>
-type/<?php echo $this->_tpl_vars['tour']['id']; ?>
/0" class="tour-row-join-btn" >Enter</a>
													<?php else: ?>
													<a href="<?php echo $this->_tpl_vars['base_dir']; ?>
my-period-tournament-details/<?php echo $this->_tpl_vars['tour']['tournament_type_id']; ?>
-type/<?php echo $this->_tpl_vars['tour']['id']; ?>
" class="tour-row-join-btn" >Enter</a>
													<?php endif; ?>
													<?php else: ?>
													<div class="tour-row-join-btn tour-join-btn" rel="<?php echo $this->_tpl_vars['tour']['id']; ?>
,<?php echo $this->_tpl_vars['tour']['tournament_type_id']; ?>
">Join</div>
													<?php endif; ?>
												</div>
												<?php endforeach; endif; unset($_from); ?>
											</div>
											<div class="clear"></div>
											<?php endforeach; endif; unset($_from); ?>
										<?php endforeach; endif; unset($_from); ?>
										<div class="clear"></div>
										<?php $_from = $this->_tpl_vars['userweeklytournaments']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['matches'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['matches']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['match']):
        $this->_foreach['matches']['iteration']++;
?>
											<?php $_from = $this->_tpl_vars['match']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['tournaments'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['tournaments']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['tournament']):
        $this->_foreach['tournaments']['iteration']++;
?>
											<div class="tounament-row-cont tour-lobby-room <?php if ($this->_tpl_vars['tournament']['type'] == 5 || $this->_tpl_vars['tournament']['type'] == 7): ?> weekly-tournament<?php else: ?> series-tournament<?php endif; ?> invited">
												<div class="tournament-row-type">
													<div class="tour-period-type-txt"><?php if ($this->_tpl_vars['tournament']['type'] == 5 || $this->_tpl_vars['tournament']['type'] == 7): ?>Weekly<?php elseif ($this->_tpl_vars['tournament']['type'] == 6 || $this->_tpl_vars['tournament']['type'] == 8): ?>Series<?php endif; ?></div>
													<div class="tour-row-type-win-text"><?php echo $this->_tpl_vars['tournament']['prizetype']; ?>
</div>
													<div class="tour-row-type-win-cash"><span class="WebRupee">Rs.</span> <?php echo $this->_tpl_vars['tournament']['prize']; ?>
</div>
												</div>
												<?php $_from = $this->_tpl_vars['tournament']['tour']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['tours'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['tours']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['tour']):
        $this->_foreach['tours']['iteration']++;
?>
												<div class="tour-row-player-entry">
													<div class="tour-row-player-count"><span><?php echo $this->_tpl_vars['tour']['player']; ?>
</span> Players</div>
													<div class="tour-row-player-joined">Players <?php echo $this->_tpl_vars['tour']['reg_player']; ?>
/<?php echo $this->_tpl_vars['tour']['player']; ?>
</div>
													<div class="tour-row-enrty-fee">Entry Fee <span class="WebRupee">Rs.</span><?php echo $this->_tpl_vars['tour']['amount']; ?>
</div>
													<?php if ($this->_tpl_vars['tour']['pt_id']): ?>
													<a href="<?php echo $this->_tpl_vars['base_dir']; ?>
my-period-tournament-details/<?php echo $this->_tpl_vars['tour']['tournament_type_id']; ?>
-type/<?php echo $this->_tpl_vars['tour']['id']; ?>
" class="tour-row-join-btn" >Enter</a>
													<?php else: ?>
													<div class="tour-row-join-btn tour-join-btn" rel="<?php echo $this->_tpl_vars['tour']['id']; ?>
,<?php echo $this->_tpl_vars['tour']['tournament_type_id']; ?>
">Join</div>
													<?php endif; ?>
												</div>
												<?php endforeach; endif; unset($_from); ?>
											</div>
											<div class="clear"></div>
											<?php endforeach; endif; unset($_from); ?>
										<?php endforeach; endif; unset($_from); ?>
										</div>
										</div>
									</div>
								</div>
								<div class="view-all-tour-btn"></div>
							</div>
						</div>
						<!----------------------------------------------- Tournament : Ends ------------------------------------------------>
						<?php if (isset ( $this->_tpl_vars['mytournaments'] )): ?>
						<!----------------------------------------------- Tournament : Start ------------------------------------------------>
						<div class="tournament" id="tournament2">
							<div class="tournament-lobby-head">
								<div class="tournament-lobby-title">My Tournaments</div>
								<div class="next-starts-in"></div>
							</div>
							<div class="tournament-lobby-body">
							
							
							
							
							
							
							
							
								<div class="tournament-lobby-inner my-tournament">
										<div class="tournament-lobby-inner-head">
											<div class="tournament-loby-left-menu">
												<ul>
													<li class="active" onclick="zeal.tournament.showTournament('my-tournament', 'index-lobby-room', 'index-lobby-room', this)">All Tournaments</li>
													<li onclick="zeal.tournament.showTournament('my-tournament', 'index-lobby-room', 'daily-tournament', this)">Daily</li>
													<li onclick="zeal.tournament.showTournament('my-tournament', 'index-lobby-room', 'weekly-tournament', this)">Weekly</li>
													<li onclick="zeal.tournament.showTournament('my-tournament', 'index-lobby-room', 'series-tournament', this)">Series</li>
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
													<li class="small">Rank</li>
													<li class="extra-large">Start time ( IST )</li>
												</ul>
											</div>
											<div id="my-tournament">
												<?php $_from = $this->_tpl_vars['mytournaments']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['weeklyTournaments'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['weeklyTournaments']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['tournament']):
        $this->_foreach['weeklyTournaments']['iteration']++;
?>
												<div class="index-lobby-room my-tour-indi<?php if ($this->_tpl_vars['tournament']['status'] == 'Completed'): ?> compl-tour<?php endif; ?><?php if ($this->_tpl_vars['tournament']['status'] == 'Destroyed'): ?> destr-tour<?php endif; ?><?php if ($this->_tpl_vars['tournament']['tournament_type_id'] == 1 || $this->_tpl_vars['tournament']['tournament_type_id'] == 3): ?> daily-tournament<?php elseif ($this->_tpl_vars['tournament']['tournament_type_id'] == 5 || $this->_tpl_vars['tournament']['tournament_type_id'] == 7): ?> weekly-tournament<?php else: ?> series-tournament<?php endif; ?>">
													<div class="divider"></div>
													<div class="extra-large"<?php if (((is_array($_tmp=$this->_tpl_vars['tournament']['name'])) ? $this->_run_mod_handler('count_characters', true, $_tmp, true) : smarty_modifier_count_characters($_tmp, true)) > 23): ?> style="line-height:25px;"<?php endif; ?>><?php echo $this->_tpl_vars['tournament']['name']; ?>
</div>
													<div class="divider"></div>
													<div class="large"><?php if ($this->_tpl_vars['tournament']['tournament_type_id'] == 1 || $this->_tpl_vars['tournament']['tournament_type_id'] == 3): ?> Daily<?php elseif ($this->_tpl_vars['tournament']['tournament_type_id'] == 5 || $this->_tpl_vars['tournament']['tournament_type_id'] == 7): ?> Weekly<?php else: ?> Series<?php endif; ?></div>
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
													<div class="small"><?php if ($this->_tpl_vars['tournament']['position'] == 0): ?>NA<?php else: ?><?php echo $this->_tpl_vars['tournament']['position']; ?>
<?php endif; ?></div>
													<div class="divider"></div>
													<div class="extra-large"><?php echo ((is_array($_tmp=$this->_tpl_vars['tournament']['endtime'])) ? $this->_run_mod_handler('date_format', true, $_tmp, '%a %R %b %e') : smarty_modifier_date_format($_tmp, '%a %R %b %e')); ?>
</div>
													<div class="divider"></div>
													<div class="medium">
													<?php if ($this->_tpl_vars['tournament']['status'] == 'Destroyed'): ?>
														<b><?php echo $this->_tpl_vars['tournament']['status']; ?>
</b>
													<?php else: ?>
														<?php if ($this->_tpl_vars['tournament']['tournament_type_id'] == 1): ?>
														<a href="<?php echo $this->_tpl_vars['base_dir']; ?>
my-team/<?php echo $this->_tpl_vars['tournament']['tournament_type_id']; ?>
-type/<?php echo $this->_tpl_vars['tournament']['id']; ?>
/0" class="lobby-join" >Enter</a>
														<?php else: ?>
														<a href="<?php echo $this->_tpl_vars['base_dir']; ?>
my-period-tournament-details/<?php echo $this->_tpl_vars['tournament']['tournament_type_id']; ?>
-type/<?php echo $this->_tpl_vars['tournament']['id']; ?>
" class="lobby-join" >Enter</a>
														<?php endif; ?>
													<?php endif; ?>
													</div>
												</div>
												<?php endforeach; endif; unset($_from); ?>
											</div>
											<div class="loading hide tournament-loader"></div>
											<a class="my-tournament-more-link" href="javascript:zeal.tournament.getOlderTournaments()">More....</a>
										</div>
									</div>
							
								<div class="view-all-tour-btn"></div>
							</div>
						</div>
						<!----------------------------------------------- Tournament : Ends ------------------------------------------------>
						<?php endif; ?>
					</div>
					<?php endif; ?>
				</div>
				<script type="text/javascript">
				var matchservertime = new Date(<?php echo ((is_array($_tmp=$this->_tpl_vars['now'])) ? $this->_run_mod_handler('date_format', true, $_tmp, '%Y') : smarty_modifier_date_format($_tmp, '%Y')); ?>
, <?php echo ((is_array($_tmp=$this->_tpl_vars['now'])) ? $this->_run_mod_handler('date_format', true, $_tmp, '%m') : smarty_modifier_date_format($_tmp, '%m')); ?>
-1, <?php echo ((is_array($_tmp=$this->_tpl_vars['now'])) ? $this->_run_mod_handler('date_format', true, $_tmp, '%d') : smarty_modifier_date_format($_tmp, '%d')); ?>
, <?php echo ((is_array($_tmp=$this->_tpl_vars['now'])) ? $this->_run_mod_handler('date_format', true, $_tmp, '%H') : smarty_modifier_date_format($_tmp, '%H')); ?>
, <?php echo ((is_array($_tmp=$this->_tpl_vars['now'])) ? $this->_run_mod_handler('date_format', true, $_tmp, '%M') : smarty_modifier_date_format($_tmp, '%M')); ?>
, <?php echo ((is_array($_tmp=$this->_tpl_vars['now'])) ? $this->_run_mod_handler('date_format', true, $_tmp, '%S') : smarty_modifier_date_format($_tmp, '%S')); ?>
);
				<?php if ($this->_tpl_vars['nextMatch']['match_date']): ?>
				zeal.tournament.nextMatchTime(<?php echo ((is_array($_tmp=$this->_tpl_vars['nextMatch']['match_date'])) ? $this->_run_mod_handler('date_format', true, $_tmp, '%Y') : smarty_modifier_date_format($_tmp, '%Y')); ?>
, <?php echo ((is_array($_tmp=$this->_tpl_vars['nextMatch']['match_date'])) ? $this->_run_mod_handler('date_format', true, $_tmp, '%m') : smarty_modifier_date_format($_tmp, '%m')); ?>
, <?php echo ((is_array($_tmp=$this->_tpl_vars['nextMatch']['match_date'])) ? $this->_run_mod_handler('date_format', true, $_tmp, '%d') : smarty_modifier_date_format($_tmp, '%d')); ?>
, <?php echo ((is_array($_tmp=$this->_tpl_vars['nextMatch']['match_date'])) ? $this->_run_mod_handler('date_format', true, $_tmp, '%H') : smarty_modifier_date_format($_tmp, '%H')); ?>
, <?php echo ((is_array($_tmp=$this->_tpl_vars['nextMatch']['match_date'])) ? $this->_run_mod_handler('date_format', true, $_tmp, '%M') : smarty_modifier_date_format($_tmp, '%M')); ?>
, <?php echo ((is_array($_tmp=$this->_tpl_vars['nextMatch']['match_date'])) ? $this->_run_mod_handler('date_format', true, $_tmp, '%S') : smarty_modifier_date_format($_tmp, '%S')); ?>
);
				<?php endif; ?>
				<?php echo '
				if(typeof(EventSource) != "undefined")
				{
					var source = new EventSource("dynamic-tournament.php");
					source.onmessage = function(event)
					{
						document.getElementById("tournament").innerHTML = JSON.parse(event.data);
						zeal.tournament.showTournament(\'all-tournament\', \'tour-lobby-room\', zeal.tournament.activeTournament);
					};
				}
				'; ?>

				</script>
<!-- Facebook Conversion Code for tournament page views -->
<script type="text/javascript">
<?php echo '
var fb_param = {};
fb_param.pixel_id = \'6013414704510\';
fb_param.value = \'0.00\';
fb_param.currency = \'USD\';
(function(){
  var fpw = document.createElement(\'script\');
  fpw.async = true;
  fpw.src = \'//connect.facebook.net/en_US/fp.js\';
  var ref = document.getElementsByTagName(\'script\')[0];
  ref.parentNode.insertBefore(fpw, ref);
})();
'; ?>

</script>
<noscript><img height="1" width="1" alt="" style="display:none" src="https://www.facebook.com/offsite_event.php?id=6013414704510&amp;value=0&amp;currency=USD" /></noscript>