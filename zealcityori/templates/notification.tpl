<div class="center-container">
	<div class="live-score-menu">
    	<ul>
        	<li class="active">Notifications</li>
		</ul>
	</div>
    {assign var="totcount" value=$notifications|@count}
	{assign var="totcount1" value=$buddynotify|@count}
    {assign var="total" value=$totcount+$totcount1}
	<div class="aboutus-container" >
        <div class="inner-terms">
        	{if $total != 0}
                <div class="notification-page">
                    <!--<img src="images/loader.gif" class="loadingimg" id="loadingimg" />-->
                    {if $notifications|@count != 0 }
                        <div class="tourinvite" style=" font-size:16px; font-weight:bold;margin: 10px 1px 10px 0px;">Tournament Invite</div>
                        <form  id="notification" method="post" action="notification.php">
                            {foreach from=$notifications item=notification name=notifications}
                                <div class="notification-indi">
                                    <div class="notification-img">
                                        {if $notification.connect_id}
                                        <img src="https://graph.facebook.com/{$notification.connect_id}/picture" alt=""/>
                                        {else}
                                        <img src="{$base_dir}images/avatar.jpg" alt="" style="width:50px; height:50px; cursor:default;" />
                                        {/if}
                                    </div>
                                    <div class="notification-desc"><b>{$notification.description}</b></div>
                                    <div class="notification-buttons-{$notification.id}">
                                        <input type="button" value="Accept" class="addfunds" onclick="zeal2.notification.acceptNotification({$notification.id},{$notification.tournament_id})"/>
                                        <input type="button" value="Decline" class="addfunds" onclick="zeal2.notification.declineNotification({$notification.id})"/>
                                    </div>                           
                                </div>
                            {/foreach}
                        </form>
                    {/if}
                </div>
                <div class="notification-page">
                    {if $buddynotify|@count != 0}
                        <div class="tourinvite" style=" font-size:16px; font-weight:bold;margin: 10px 1px 10px 0px;">Buddy Invite</div>
                        <form  id="notification" method="post" action="notification.php">                	
                            {foreach from=$buddynotify item=buddynotify name=buddynotify}
                                <div class="notification-indi">
                                    <div class="notification-img">
                                        {if $buddynotify.connect_id}
                                    <img src="https://graph.facebook.com/{$buddynotify.connect_id}/picture" alt=""/>
                                        {else}
                                        <img src="{$base_dir}images/avatar.jpg" alt="" style="width:50px; height:50px; cursor:default;" />
                                        {/if}
                                    </div>
                                    <div class="notification-desc"><b>{$buddynotify.username}</b> has invited you to play.</div>
                                    <div class="notification-buttons1-{$buddynotify.id}">
                                        <input type="button" value="Accept" class="addfunds" onclick="zeal2.notification.buddyacceptNotification({$buddynotify.id})"/>
                                        <input type="button" value="Decline" class="addfunds" onclick="zeal2.notification.buddydeclineNotification({$buddynotify.id})"/>
                                    </div>
                                </div>
                            {/foreach}
                        </form>
                    {/if}
                </div>
			{else}
            	<div class="no-detail">No Invites</div>
			{/if}
		</div>
    </div>
</div>