				<div class="index-second">					
					{if isset($allUserTournaments) || isset($weeklyTournaments)}
					<div class="index-left2" style="margin:0;">
						<!----------------------------------------------- Tournament : Start ------------------------------------------------>
						<div class="tournament" id="tournament1">
							<div class="tournament-lobby-head">
								<div class="tournament-lobby-title">Invited Tournaments</div>
								<a href="{$base_dir}create-tournament"><input type="button" class="common-btn create-tournament-btn" value="Create Tournament"/></a>
								<!--<div class="championship-text"><div class="champion-icon-star-header"></div> - <a href="leaderboard">Championship</a><a target="_blank" href="championship-leaderboard.php"><img src="{$base_dir}images/question_icon.png" alt="" style="margin:13px 0 0 5px;"/></a></div>-->
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
										<!--<img src="{$base_dir}images/tri-series.jpg" alt="" width="593px" height="215px" />-->
										<div id="tournament">
											{foreach from=$allUserTournaments item=tournament name=tournaments}
											{if $userid != $tournament.user_id}
											<div class="index-lobby-room daily-tournament">
												<div class="divider"></div>
												<div class="extra-large">{$tournament.name}</div>
												<div class="divider"></div>
												<div class="large">{$tournament.nickname}</div>
												<div class="divider"></div>
												<div class="large"><span class="WebRupee">Rs.</span>{$tournament.amount}</div>
												<div class="divider"></div>
												<div class="large">{$tournament.reg_player}/{$tournament.player}</div>
												<div class="divider"></div>
												<div class="large"><span class="WebRupee">Rs.</span>{$tournament.prize}</div>
												<div class="divider"></div>
												<div class="extra-large">{$tournament.endtime|date_format:'%a %R %p %e %b'} </div>
												<div class="divider"></div>
												<div class="medium">
												{if $tournament.status == 'Closed'}
												<a href="#" class="lobby-join-closed">Closed</a>
												{else}
													{if $tournament.tournament_id}
													<a href="{$base_dir}my-period-tournament-details/{$tournament.tournament_type_id}-type/{$tournament.id}" class="lobby-join" >Enter</a>
													{else}
													<a href="#" onclick="zeal.tournament.selectTournament({$tournament.id}, {$tournament.tournament_type_id})" class="lobby-join" >Join</a>
													{/if}
												{/if}
												</div>
											</div>
											{/if}
											{/foreach}
											{foreach from=$weeklyTournaments item=tournament name=weeklyTournaments}
											{if $userid != $tournament.user_id}
											<div class="index-lobby-room{if $tournament.tournament_type_id == 5 || $tournament.tournament_type_id == 7} weekly-tournament{else} series-tournament{/if}">
												<div class="divider"></div>
												<div class="extra-large">{$tournament.name}</div>
												<div class="divider"></div>
												<div class="large">{$tournament.nickname}</div>
												<div class="divider"></div>
												<div class="large"><span class="WebRupee">Rs.</span>{$tournament.amount}</div>
												<div class="divider"></div>
												<div class="large">{$tournament.reg_player}/{$tournament.player}</div>
												<div class="divider"></div>
												<div class="large"><span class="WebRupee">Rs.</span>{$tournament.prize}</div>
												<div class="divider"></div>
												<div class="extra-large">{$tournament.endtime|date_format:'%a %R %p %e %b'} </div>
												<div class="divider"></div>
												<div class="medium">
												{if $tournament.status == 'Closed'}
												<a href="#" class="lobby-join-closed">Closed</a>
												{else}											
													{if $tournament.pt_id}
													<a href="{$base_dir}my-period-tournament-details/{$tournament.tournament_type_id}-type/{$tournament.id}" class="lobby-join" >Enter</a>
													{else}
													<a href="#" onclick="zeal.tournament.selectTournament({$tournament.id}, {$tournament.tournament_type_id})" class="lobby-join" >Join</a>
													{/if}
												{/if}									
												</div>
											</div>
											{/if}
											{/foreach}
										</div>
									</div>
								</div>
								<div class="view-all-tour-btn"></div>
							</div>
						</div>
						<!----------------------------------------------- Tournament : Ends ------------------------------------------------>
					</div>
					{else}
						<div style="width:100%; font-size:25px; text-align:center">No invited tournament</div>
					{/if}					
					
				</div>