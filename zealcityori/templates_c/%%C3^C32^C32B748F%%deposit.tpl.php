<?php /* Smarty version 2.6.27, created on 2014-04-14 14:22:15
         compiled from deposit.tpl */ ?>
<?php if (isset ( $this->_tpl_vars['paymentprocess'] )): ?>
	<form name="ecom" id="deposit" method="post" action="https://www.timesofmoney.com/direcpay/secure/dpMerchantPayment.jsp">
		<input type="hidden" name="requestparameter" value="<?php echo $this->_tpl_vars['requestparameter']; ?>
">
		<input type="hidden" name="billingDtls" value="<?php echo $this->_tpl_vars['billingDtls']; ?>
">
		<input type="hidden" name="shippingDtls" value="<?php echo $this->_tpl_vars['shippingDtls']; ?>
">
		<input type="hidden" name="merchantId" value ="<?php echo $this->_tpl_vars['merchantId']; ?>
"/>
		<input type="hidden" name="editAllowed" value="N">
		<h1>Please wait.....</h1>
	</form>
	<script>
	document.getElementById('deposit').submit();
	</script>
<?php else: ?>
<form method="post"  onsubmit="return zealdep.deposit.uservalidate();">
	<div class="tournamentInfoClass">
		<div class="joinTournamentContainnorClassHead" style="width:140px; margin:0 auto; float:none; color:#FFFFFF;"><div class="icon-deposit-Class"></div>Deposit</div>
		<div class="tournamentInfoContentClass" style="height:1370px;border-radius: 8px;-moz-border-radius: 8px;-web-border-radius:8px;">
			<div style="float:left; width:100%;">
				<div class="my-tournament-Class">Earn xtra cash when you deposit in Zealcity with our latest deposit offers.</div>
				<div class="depositContainnor">
					<?php $_from = $this->_tpl_vars['products']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['products'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['products']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['product']):
        $this->_foreach['products']['iteration']++;
?>
					<?php if ($this->_tpl_vars['product']['cash'] > 0): ?>
						<div class="depostContainnor-class" id="dopsite-<?php echo $this->_tpl_vars['product']['id']; ?>
" onclick="zealdep.deposit.priceadd('<?php echo $this->_tpl_vars['product']['id']; ?>
','<?php echo $this->_tpl_vars['product']['cash']; ?>
')">
							<div class="innerContainor-like">
								<div class="rupessImagesContent"><div class="rupessContent"><span class="WebRupee">Rs.</span></div><?php echo $this->_tpl_vars['product']['cash']; ?>
</div>
							</div>
							<div class="innerContainor-likeTwo " id="dopsitetwo-<?php echo $this->_tpl_vars['product']['id']; ?>
">GET BONUS RS <?php echo $this->_tpl_vars['product']['free_cash']; ?>
 FREE !</div>
						</div>
					<?php endif; ?>
					<?php endforeach; endif; unset($_from); ?>		
					<div class="or-class-content">Or</div>
					<div class="or-class-content"><input  palceholder="Enter amount" type="text" class="txtType" id="userAmount" name="amount" value="" onkeyup="zealdep.deposit.userprice();" autocomplete="off" placeholder="Enter your own amount"/></div>
					<div class="or-class-content">
						<div class="btnclassSearchContent">
							<div style="text-align:center; color:#FFFFFF;float:left;width:100%; font-size:14px; margin:8px 0 0 0;padding:0;  ">Please note: Xtra cash will be provided only to players who choose an<br />option from above. If you enter a custom amount and deposit you<br />will not be entitled to Xtra cash.
	 </div>
						</div>
					</div>
				</div>
			</div>
				<div style="float:left; width:100%; margin:30px 0 0 0;">
					<div class="joinTournamentContainnorClassHead" style="width:140px; margin:0 auto; float:none; color:#FFFFFF;">Billing Details</div>
					<div class="depositContainnor" style="width:53%; margin-top:0; height:330px;">
						<div style="width:80%; margin:0 auto; margin-top:20px">
							<div class="rightContentails">
								<div class="textContainnore">Full name : </div>
								<!--<div class="textContainnore" style="margin-top:13px">Email : </div>-->
								<div class="textContainnore" style="margin-top:13px">Address : </div>
								<div class="textContainnore" style="margin-top:13px"></div>
								<div class="textContainnore" style="margin-top:13px">state : </div>
								<div class="textContainnore" style="margin-top:13px">City : </div>
								<div class="textContainnore" style="margin-top:13px">Country : </div>
								<div class="textContainnore" style="margin-top:13px">Pin Code : </div>
								<div class="textContainnore" style="margin-top:13px">mobile no : </div>
							</div>
							<div class="leftContentails"><input class="txtType" type="text" name="fullname" id="fullname" value="<?php echo $this->_tpl_vars['user']->firstname; ?>
" /></div>
							<!--<div class="leftContentails" style="margin-top:10px"><input class="txtType" type="text" id="email" name="email" value="<?php echo $this->_tpl_vars['user']->email; ?>
" /></div>-->
							<div class="leftContentails" style="margin-top:10px"><input class="txtType" type="text" id="address" name="address" value="<?php echo $this->_tpl_vars['user']->address; ?>
" /></div>
							<div class="leftContentails" style="margin-top:10px"><input class="txtType" type="text" id="address2" name="address2" value="" /></div>
							<div class="leftContentails" style="margin-top:10px"><input class="txtType" type="text" id="state" name="state"  value="<?php echo $this->_tpl_vars['user']->state; ?>
"/></div>
							<div class="leftContentails" style="margin-top:10px"><input class="txtType" type="text" id="city" name="city"  value="<?php echo $this->_tpl_vars['user']->city; ?>
" /></div>
							<div class="leftContentails" style="margin-top:10px"><input class="txtType" type="text" id="country" name="country" value="<?php echo $this->_tpl_vars['user']->country; ?>
" /></div>
							<div class="leftContentails" style="margin-top:10px"><input class="txtType" type="text" id="pincode" name="pincode" value="<?php echo $this->_tpl_vars['user']->pincode; ?>
" /></div>
							<div class="leftContentails" style="margin-top:10px"><input class="txtType" type="text" id="mobileno" name="mobileno" value="" /></div>
						</div>
					</div>
				</div>
				<div style="float:left; width:100%; margin:30px 0 0 0;">
					<div class="joinTournamentContainnorClassHead" style="width:140px; margin:0 auto; float:none; color:#FFFFFF;">Payment type</div>
					<div class="depositContainnor" style="width:53%; margin-top:0; height:270px;">
						
						<div class="depositClassContainnorClass2">
							<div class="tournament-values">
								<div class="fill-Content">
									<div class="styled-select-one">
										<select id="type" onchange="zeal1.tournament.changeType()" name="type" class="">
										<option value="0">---- Select -----</option>
										<option value="1"> Debit card</option>
										<option value="2">Credit card</option>
										<option value="3">Net Banking</option>
										</select>
									</div>						
								</div>
							</div>
						</div>	
						
						
						<div class="depositClassContainnorClass2">
							<div class="text-box-Containnor" id="depositAmountId"><div style="float:left; width:65%;">Deposit amount :</div><div class="rupessContent"><span class="WebRupee">Rs.</span>500</div>  </div>
								<input type="hidden" name="productid" id="productid" value="1" />
								<input class="join-tournament-class"  type="submit" name="paypalSubmit" value="Pay now" />
							</div>
						</div>	
				</div>
			</form>
		</div>
	</div>
<?php endif; ?>