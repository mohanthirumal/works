<div class="refer-a-friend">
	<div class="live-score-menu rightscore">
		<ul>
			<li class="active" onclick="zeal.index.showContent('invite', 'content', 1, this, 'rightscore')">Facebook Invite</li>
			<!--<li onclick="zeal.index.showContent('invite', 'content', 2, this, 'rightscore')">Email Invite</li>-->
		</ul>
	</div>
	<div class="refer-a-friend-inner">
		<div class="refer-a-friend-mover invite" id="content1">
			{if !empty($facebook)}
			{foreach from=$facebook.friends.data item=friend name=friends}
			<div class="friend-indiv">
				<img src="https://graph.facebook.com/{$friend.id}/picture" alt="" title="{$friend.name}"/>
				<input type="button" value="invite" class="addfunds" onclick="inviteFriend({$friend.id})"/>
			</div>
			{/foreach}
			{else}
				<a href="#" onclick="zeal.facebook.sync({$user->id});"><img src="images/f_connect.png" class="connectwithfbbut" /></a>
			{/if}
		</div>
		<div class="refer-a-friend-inner invite" id="content2" style="display:none;">
			<div class="refer-a-friend-email">
				<div class="refer-a-friend-email-inner-center">
					<div class="refer-a-friend-email-inner">
						<div class="refer-a-friend-title">Email Invite:</div>
						<div class="clear"></div>
						<form method="post" onsubmit="return zeal.refer.refermailvalidate();">
							<div>To :</div>
							<div>
								<input type="text" name="to" id="refertxt" value=""/>
							</div>
							<div>Content :</div>
							<div>
								<textarea name="body" id="refercontent"></textarea>
							</div>
							<div><input type="submit" value="Send" class="addfunds" name="submitEmailInvite"/></div>
						</form>
					</div>				
				</div>
			</div>
		</div>
	</div>
</div>
<script>
{literal}
 function inviteFriend(id) {
  FB.ui({method: 'apprequests',
	message: 'I have started playing captain of captains at Zealcity.com. I want to add you as a friend and challenge you to a game of fantasy cricket.',
	to: id
  }, requestCallback);
}
function requestCallback(response) {
	zeal.facebook.inviteFriend(loggedId, response.request);
}
{/literal}
</script>