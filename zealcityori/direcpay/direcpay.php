
<?php

echo "timesmoney";
// Encryption/Decryption using pure PHP code
	include('Crypt/AES.php');

	$key = "1pJ+4oEkInt47zR7aAu5og==";
	$plaintext = '201404011000002|DOM|IND|INR|10|zealcity23|others|http://www.zealcity.com/return-direcpay.php|http://www.zealcity.com/return-direcpay.php|DirecPay';
	$merchantId='201404011000002';
	$actionUrl = 'https://www.timesofmoney.com/direcpay/secure/dpMerchantPayment.jsp';
	$aes = new Crypt_AES();
	$secret=base64_decode($key);
	$aes->setKey($secret);

	echo 'Encryption/Decryption using pure PHP code<br>';
	echo '-----------------------------------------<br>';
	echo '<b>Plain Text:</b> '.$plaintext.'<br>';
	$requestParameter =base64_encode($aes->encrypt($plaintext));

	echo '<b>After Encryption:</b> '.$requestParameter.'<br>';
	$decryptedText = $aes->decrypt(base64_decode($requestParameter));
	echo '<b>After Decryption:</b> '.$decryptedText.'<br><br>';

	//Billingdetails
$billingDtls ="TestUser|Mumbai|Mumbai|Maharashtra|400001|IN|91|022|28000000|9820000000|testuser@gmail.com |test transaction for direcpay";

//Shippingdetails
$shippingDtls ="TestUser|Mumbai|Mumbai|Maharashtra|400234|IN|91|022|28000000|9920000000";
$billingDtls  = base64_encode($aes->encrypt($billingDtls));
$shippingDtls  = base64_encode($aes->encrypt($shippingDtls));


?>
<form name="ecom" method="post" action="https://www.timesofmoney.com/direcpay/secure/dpMerchantPayment.jsp">
<input type="hidden" name="requestparameter" value="<?php echo $requestParameter; ?>">
<input type="hidden" name="billingDtls" value="<?php //echo $billingDtls; ?>">
<input type="hidden" name="shippingDtls" value="<?php //echo $shippingDtls; ?>">
<input type="hidden" name="merchantId" value ="201404011000002"/>
<input type="submit" name="submit" value="Submit">
</form>