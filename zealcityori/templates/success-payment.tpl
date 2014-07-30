<div class="refer-a-friend">
	<div class="live-score-menu rightscore">
		<ul>
			<li class="active">Success</li>
		</ul>
	</div>
	<div class="refer-a-friend-inner">
		<div>
			<h1 style="text-align:center; font-size:20px;">Your deposit was successful</h1>
			<div style="float:left; margin:30px 0 0 20px; height:200px;">
				<b>Deposit Amount : </b>Rs. {$deposit->amount}<br/>
				<b>Transaction Id :</b>{$payment_id}<br/>
				<b>Date : </b>{$smarty.now|date_format}<br/><br/>
				An e-mail has been sent to you for reference<br/><br/>
				If you have any problems regarding this deposit , please send a mail to deposit@zealcity.com and include the above information.<br/><br/><br/>
				<input type="button" value="Continue" class="addfunds" onclick="window.location.href='tournament'"/>
			</div>			
		</div>
	</div>
</div>