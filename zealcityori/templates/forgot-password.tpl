<div class="center-container">
	<div class="live-score-menu">
    	<ul>
        	<li class="active">Forgot Password</li>
		</ul>
	</div>
	<div class="aboutus-container">
        <div class="inner-terms" >
			<div class="refer-a-friend-email">
				<div class="refer-a-friend-email-inner-center">
					<div class="refer-a-friend-email-inner">
						<div class="clear"></div>
						{if isset($confirmation) && $confirmation == 1}
						<p class="success">Your password has been successfully reset and has been sent to your e-mail address: {$email|escape:'htmlall':'UTF-8'}</p>
						{elseif isset($confirmation) && $confirmation == 2}
						<p class="success">A confirmation e-mail has been sent to your address:{$email|escape:'htmlall':'UTF-8'}</p>
						{else}
						<form method="post" onsubmit="" >
							<div>Email :</div>
							<div>
								<input type="text" name="email" id="txtemail" value=""/>
							</div>
							<div><input type="submit" value="Submit" class="addfunds" name="submitForgotPassword"/></div>
						</form>
						{/if}
					</div>				
				</div>
			</div>
		</div>
    </div>
</div>