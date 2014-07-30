<?php /* Smarty version 2.6.27, created on 2014-04-11 18:47:47
         compiled from support.tpl */ ?>
<div class="center-container" style="font-size:16px;">
	<div class="live-score-menu">
    	<ul>
        	<li class="active">Support</li>
		</ul>
	</div>
	<div class="aboutus-container" >
        <div class="inner-terms" >
			<div class="refer-a-friend-email" style="padding-bottom:50px;">
				<div class="refer-a-friend-email-inner-center">
					<div class="refer-a-friend-email-inner">
						<div class="clear"></div>
						<form method="post" onsubmit="return zeal.support.validate();">
							<div>Name :</div>
							<div>
								<input type="text" name="txtname" id="suptxtname" value=""/>
							</div>
							<div>Email :</div>
							<div>
								<input type="text" name="txtemail" id="supmail" value=""/>
							</div>
							<div>Verification :</div>
							<div>
								<input type="text" name="txtverification" id="txtverification" value="" style="width:100px;"/>
								<img src="<?php echo $this->_tpl_vars['base_dir']; ?>
captcha_code_file.php?rand=<?php echo $this->_tpl_vars['rand']; ?>
" alt="" style="margin:0 0 0 10px;" id="captchaimg"/>
							</div>
							<div>Content :</div>
							<div><textarea name="body" id="supcontent"></textarea></div>
							<div><input type="submit" value="Submit" class="addfunds" name="submitSupport"/></div>
						</form>
					</div>				
				</div>
			</div>
		</div>
    </div>
</div>