<?php /* Smarty version 2.6.27, created on 2014-04-11 12:59:51
         compiled from refer-a-friend.tpl */ ?>
<div class="refer-a-friend">
	<div class="live-score-menu rightscore">
		<ul>
			<li class="active" onclick="zeal.index.showContent('invite', 'content', 1, this, 'rightscore')">Facebook Invite</li>
			<!--<li onclick="zeal.index.showContent('invite', 'content', 2, this, 'rightscore')">Email Invite</li>-->
		</ul>
	</div>
	<div class="refer-a-friend-inner">
		<div class="refer-a-friend-mover invite" id="content1">
			<?php if (! empty ( $this->_tpl_vars['facebook'] )): ?>
			<?php $_from = $this->_tpl_vars['facebook']['friends']['data']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['friends'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['friends']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['friend']):
        $this->_foreach['friends']['iteration']++;
?>
			<div class="friend-indiv">
				<img src="https://graph.facebook.com/<?php echo $this->_tpl_vars['friend']['id']; ?>
/picture" alt="" title="<?php echo $this->_tpl_vars['friend']['name']; ?>
"/>
				<input type="button" value="invite" class="addfunds" onclick="inviteFriend(<?php echo $this->_tpl_vars['friend']['id']; ?>
)"/>
			</div>
			<?php endforeach; endif; unset($_from); ?>
			<?php else: ?>
				<a href="#" onclick="zeal.facebook.sync(<?php echo $this->_tpl_vars['user']->id; ?>
);"><img src="images/f_connect.png" class="connectwithfbbut" /></a>
			<?php endif; ?>
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
<?php echo '
 function inviteFriend(id) {
  FB.ui({method: \'apprequests\',
	message: \'I have started playing captain of captains at Zealcity.com. I want to add you as a friend and challenge you to a game of fantasy cricket.\',
	to: id
  }, requestCallback);
}
function requestCallback(response) {
	zeal.facebook.inviteFriend(loggedId, response.request);
}
'; ?>

</script>