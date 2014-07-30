<div class="center-container">
<div class="signin-container signup-container refer-a-friend" id="deposit-cont" style="display:block; height:520px">
	<div class="live-score-menu rightscore">
		<ul style="margin-left:250px;">
			<li class="active">Deposit</li>
		</ul>
	</div>
	<div class="refer-a-friend-inner">
		<div class="deposit-inner-center">
			<div class="deposit-title-options">Deposit Options</div>
			<div style="width:550px; margin:0 0 150px 20px; float:left">
				{foreach from=$products item=product name=products}
				<!------------------------------------------ Deposit : STARTS-------------------------------------------->
				<div class="deposit-indivi-cont{if $smarty.foreach.products.iteration%2 == 0} even{/if}">
					<div class="deposit-money">
						<div class="deposit-money-img"></div>
						<span class="WebRupee">Rs</span>{$product.cash}
					</div>
					<div class="deposit-free-cont">
						<div>Get</div>
						<div class="deposit-free-percent">{$product.free_cash}<span class="WebRupee">Rs</span></div>
						<div>Free</div>
					</div>
					<form method="post" action="deposit.php" style="margin-left:100px; float:left;">
						<input type="hidden" name="itemname" value="{$product.cash} Cash" /> 
						<input type="hidden" name="itemnumber" value="{$product.id}" /> 
						<input type="hidden" name="itemprice" value="{math equation="( y / x )" x=$dollar y=$product.cash format='%.2f'}" />
						<input type="hidden" name="itemQty" value="1"/>
						<input class="addfunds" type="submit" name="paypalSubmit" value="Deposit" style="float:none"/>
					</form>
				</div>
				<!------------------------------------------ Deposit : ENDS-------------------------------------------->
				{/foreach}
				<div style="margin:10px 0 0 220px; float:left;"><input class="addfunds" type="submit" name="paypalSubmit" value="Continue" onclick="zeal.user.closeDeposit();" style="height:30px;"/></div>
			</div>
		</div>
	</div>	
</div>
</div>