{if $contenttype == 1}
<div class="pop-dialog-box">
	<div class="pop-head-cont">
		<div class="pop-head-cont-title">Like Us</div>
		<div class="pop-head-cont-close" onclick="zeal.tournament.closeTournament()"></div>
	</div>
	<div class="pop-body-cont">
		You must like us to join our free tournament<br/><br/>
		<div class="fb-like-cont">
			<fb:like href="http://www.facebook.com/pages/zealcitycom/190533467632448" send="false" layout="button_count"></fb:like>
		</div>
		<div id="likeus-loader" class="loading hide"></div>
	</div>
</div>
<script>
{literal}
try
{
	FB.XFBML.parse();
}
catch(ex)
{alert(ex);}
{/literal}
</script>
{else}
<div class="pop-dialog-box">
	<div class="pop-head-cont">
		<div class="pop-head-cont-title">Share Us</div>
		<div class="pop-head-cont-close" onclick="zeal.tournament.closeTournament()"></div>
	</div>
	<div class="pop-body-cont">
		You must share us to join our free tournament<br/><br/>
		<div class="fb-like-cont">
			<input type="button" class="addFundClass like-us-share-btn" value="Share" onclick="zeal.tournament.fbJoinShare()"/>
		</div>
		<div id="likeus-loader" class="loading hide"></div>
	</div>
</div>
{/if}