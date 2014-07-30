
 function inframe()
 {
	
	
	document.getElementById('autoIframe').height=0;
	var the_height =0;
	var height=0;
	var the_height=
	document.getElementById('autoIframe').contentWindow.
	document.body.scrollHeight;
	if(the_height < 900)
	{
		the_height=1100;
	document.getElementById('autoIframe').height=
	the_height +'px';
	}
	else
	{
		var height = the_height+40;
		document.getElementById('autoIframe').height=
		the_height +'px';
	}
	
	
	
	
 }
 function titlescoresite(str)
 {
	 	document.getElementById('headerTitle').innerHTML=str;
}