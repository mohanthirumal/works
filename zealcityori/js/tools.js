function emailExist(email)
{
	$.ajax({
		type: 'GET',
		url: 'tools/ajax/ajax.php',
		data: 'action=emailexist&email=' + email,
		success: function(data)
		{
			if(data == '1')
				return false;
			return true;
		},
		error: function(XMLHttpRequest, textStatus, errorThrown) {
			// in front-office, do not display technical error
			alert("TECHNICAL ERROR: unable to perform.\n\nDetails:\nError thrown: " + XMLHttpRequest + "\n" + 'Text status: ' + textStatus);
		}
	});
}
function usernameExist(username)
{
	$.ajax({
		type: 'GET',
		url: 'tools/ajax/ajax.php',
		data: 'action=usernameexist&username=' + username,
		success: function(data)
		{
			if(data == '1')
				return false;
			return true;
		},
		error: function(XMLHttpRequest, textStatus, errorThrown) {
			// in front-office, do not display technical error
			alert("TECHNICAL ERROR: unable to perform.\n\nDetails:\nError thrown: " + XMLHttpRequest + "\n" + 'Text status: ' + textStatus);
		}
	});
}