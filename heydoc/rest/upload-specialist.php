<?php
if($_POST && isset($_POST['action']))
{
	$excel = $_FILES['excel'];
	if(($_FILES['excel']['size'] > 0))
	{
		require 'reader.php';
		$excel = new Spreadsheet_Excel_Reader();
		$excel->read($_FILES['excel']['tmp_name']);    
		$x=1;
		$json = '{
			"results": [';
		while($x<=$excel->sheets[0]['numRows'])
		{
		  $y=1;
		  $json .= '{
					';
			if(isset($excel->sheets[0]['cells'][$x][1]))
				$json .= '"name":"'.$excel->sheets[0]['cells'][$x][1].'",';
			if(isset($excel->sheets[0]['cells'][$x][2]))
				$json .= '"desc":"'.$excel->sheets[0]['cells'][$x][2].'",';
			$json = substr($json, 0, -1);

		  $json .= '},';
		  $x++;
		}
		$json = substr($json, 0, -1);
		$json .= ']}';
		echo $json;exit;
		$url = 'https://api.parse.com/1/batch';  
		$appId = 'SV7U73uAVhR6fn1IUR5OxPoa0fHBxyfQNk9NvJTA';  
		$restKey = '3xTy2738CaqYsXOPbqb6JQ71Dnv8JbbZbmScS3Xe';  
		$headers = array(  
		"Content-Type: application/json",  
		"X-Parse-Application-Id: " . $appId,  
		"X-Parse-REST-API-Key: " . $restKey  
		);  
//		 $json = '{ 
//		 			"requests": [
//						{
//							"method": "POST", 
//							"path": "/1/classes/doctorlist", 
//							"body": {
//								"specialist":"gynoschennai",
//								"specialist":"N N Hospital",
//								"specialist":"(+91)-44-66321402",
//								"specialist":"Tambaram West ",
//								"specialist":"No 39, Opposite To K K Eye Hospital, Gandhi Road, Tambaram West, Chennai - 600045",
//								"specialist":"12.93201",
//								"specialist":"80.119332222222",
//								}
//							}
//						]
//					}';
		$rest = curl_init();  
		curl_setopt($rest,CURLOPT_URL,$url);  
		curl_setopt($rest,CURLOPT_POST,1);  
		curl_setopt($rest,CURLOPT_POSTFIELDS,$json);  
		curl_setopt($rest,CURLOPT_HTTPHEADER,$headers);  
		curl_setopt($rest,CURLOPT_SSL_VERIFYPEER, false);  
		curl_setopt($rest,CURLOPT_RETURNTRANSFER, true);  
		$response = curl_exec($rest);  
		echo $response;  
		print_r($response);  
		curl_close($rest);
	}
	
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Upload doctor</title>
</head>

<body>
<form method="post" enctype="multipart/form-data" class="video-add-container">
	<div class="add-items-window">	
		<table align="center" width="450px" cellpadding="0" cellspacing="0">
			<tr class="bgcolor">
				<td>Upload Excel:</td>
				<td><input type="file" name="excel"/></td>
			</tr>
			<tr><td colspan="2" height="5"></td></tr>
			<tr>
				<td colspan="2" align="right"><input type="submit" value="Submit" class="login-submit-btn" style="margin:20px 0 20px 200px;"/></td>
			</tr>
		</table>
		<input type="hidden" name="action" value="coupon"/>
	</div>
</form>
</body>
</html>
