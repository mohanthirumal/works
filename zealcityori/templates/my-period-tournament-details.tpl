<div class="tournamentInfoClass">
	<div class="tournamentInfoClassHeader">
		<a href="{$base_dir}tournament"><div class="tournament-back-icon"></div></a>
		<div class="headermenuClass btn-size active" onclick="zeal.tournament.showTournamentDetails('tournamentInfoClass', 'tour-details', 'tour-details1', this)"><div class="IconeImages"></div>Tournament Info</div>
		{if $tournament->status != 'Destroyed'}
        {if $user->id == $tournament->creator->id}
		<div class="headermenuClass btn-size" onclick="zeal.tournament.showTournamentDetails('tournamentInfoClass', 'tour-details', 'tour-details2', this)"><div class="IconeImages2"></div>Invitations</div>
        {/if}
		<div class="headermenuClass btn-size" onclick="zeal.tournament.showTournamentDetails('tournamentInfoClass', 'tour-details', 'tour-details3', this)"><div class="IconeImages3"></div>My Team </div>
		<div class="headermenuClass btn-size" onclick="zeal.tournament.showTournamentDetails('tournamentInfoClass', 'tour-details', 'tour-details4', this)"><div class="IconeImages4"></div>Result</div>
		{/if}
	</div>
	<div class="tour-details tour-details1{if isset($new) && $user->id == $tournament->creator->id} hide{/if}">
		<div class="tournamentInfoContentClass">
			<div class="InnerJoinClassContainnor" style="margin-top:20px; height:90px;">
				<div class="ClassContainnor">
					<div class="widthContainner">Start Time:</div>
					<div class="valueContainnerClass23"><div class="timeClass" style="font-size: 15px;">{$tournament->endtime|date_format:'%d-%m-%Y %H:%M:%S'}</div></div>
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
						<div class="valueContainnerClass">00000{$tournament->id}</div>
						<div class="valueContainnerClass2">{$tournament->name}</div>
						{if $tournament->creator->id == 0}
						<div class="valueContainnerClass2">Zealcity</div>
						{else}
						<div class="valueContainnerClass2">{$tournament->creator->username}</div>
						{/if}
						<div class="valueContainnerClass2">{$tournament->tournament_type->nickname}</div>
						<div class="valueContainnerClass2">{$tournament->entry_fee}</div>
						<div class="valueContainnerClass2">{$tournament->joinPlayers}/{$tournament->players}</div>
						<div class="valueContainnerClass2" id="tour-prize1">
						{foreach from=$tournament->prize_pool->prize item=prize name=prizes}
							<span class="WebRupee">Rs.</span>{$prize}{if !$smarty.foreach.prizes.last}, {/if}
						{/foreach}
						</div>
						<div class="valueContainnerClass2">{$matchescount}</div>
						<div class="valueContainnerClass2"{if $tournament->status == 'Destroyed'} style="color:#f00;"{/if}>{$tournament->status}</div>
					</div>
				</div>
			</div>
			<div class="valueContainnerClass23" style="width:25%; float:left; margin:180px 0 0 0; font-size:15px;">
				{if $user->id == $tournament->creator->id && $tournament->status != 'Destroyed'}
					<a href="javascript:zeal.tournament.showTournamentDetails('tournamentInfoClass', 'tour-details', 'tour-details2', this);">Invite more players</a>
				{/if}
				{if $tournament->prize_pool->prize|@count gt 4}
				<a href="javascript:$('#tour-prize1').css('height','auto');" style="margin:145px 0 0 5px; float:left;">More</a>
				{/if}
			</div>
			<!--<div class="InnerJoinClassContainnor">
				<div class="ClassContainnor">
					<div class="widthContainner">Rule</div>
					<div class="valueContainnerClass23"><a href="{$base_dir}tournament-and-how-it-works" target="_blank">Rules For weekly Tournament</a></div>
				</div>
			</div>-->
			
			{if $user->id == $tournament->creator->id && $tournament->status != 'Destroyed'}
			{if $tournament->joinPlayers == 1}
			<a href="javascript:zeal1.tournament.destroyTournament({$tournament->id}, {$tournament->tournament_type_id}, {$user->id}, '{$user->secure_key}');"><div class="Cancel-btn-class">Cancel Tournament</div></a>
			{/if}
			{/if}
		</div>
		
	</div>
	<div class="tour-details tour-details2{if !isset($new) || $user->id != $tournament->creator->id} hide{/if}">
		<div class="tournamentInfoContentClass1">
			<div class="tournamentInfoContentClass-inner">
				<div class="tournament-info-left">
					<div class="tournamentInfoContentClass-invites">
						<div class="tournament-info-title" style="margin-left:40px;">Invited friend list</div>
						<div class="tournament-info-invited">
						<div class="tour-info-invited-image">Name</div>
						<div class="tour-info-invited-image">Status</div>
						{if $invites || $emailinvites}
						{foreach from=$invites item=invite name=invites}
						<div class="tour-info-invited-indi">
							<div class="tour-info-invited-image">
							<img src="https://graph.facebook.com/{$invite.facebook_id}/picture" alt=""/>
							</div>
							<div class="tour-info-invited-image">
							{if $invite.status == 0}Pending{else}Joined{/if}
							</div>
						</div>
						{/foreach}
						{foreach from=$emailinvites item=invite name=invites}
						<div class="tour-info-invited-indi">
							<div class="tour-info-invited-image">{$invite.name}</div>
							<div class="tour-info-invited-image">
							{if $invite.status == 0}Pending{else}Joined{/if}
							</div>
						</div>
						{/foreach}
						{else}<div style="width:100%; font-size:20px; text-align:center">No Invitation sent</div>{/if}
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
									<img onclick="zeal1.facebook.facebookConnect({$user->id});" src="{$base_dir}images/fbbutton.png" alt=""/>
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
										<input class="tournament-add-friends-btn" type="button" value="Send Invite" onclick="zeal1.tournament.sendEmailInvite({$tournament->id}, {$tournament->tournament_type_id}, this, '{$user->secure_key}')" style="margin:20px 0 20px 280px;"/>
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
											<input type="button" name="invite-friends" value="Send Invite" onclick="zeal1.tournament.completeTournament({$tournament->id}, {$tournament->tournament_type_id});" class="tournament-add-invite-btn"/>
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
		{include file='my-period-tournament-my-team.tpl'}
	</div>
	<div class="tour-details tour-details4" style="display:none;">
		{include file='my-period-tournament-result.tpl'}
	</div>
</div>
<script type="text/javascript">
var matchservertime = new Date({$now|date_format:'%Y'}, {$now|date_format:'%m'}, {$now|date_format:'%d'}, {$now|date_format:'%H'}, {$now|date_format:'%M'}, {$now|date_format:'%S'});
zeal.tournament.periodTourTime({$tournament->endtime|date_format:'%Y'}, {$tournament->endtime|date_format:'%m'}, {$tournament->endtime|date_format:'%d'}, {$tournament->endtime|date_format:'%H'}, {$tournament->endtime|date_format:'%M'}, {$tournament->endtime|date_format:'%S'});
</script>