function createtournamentValidate()
{
	var tournamentname	 =	$('#tournamentName').val();
	var type			 = 	$('#type').val();
	var entryfee1		=	$('#entryfee1').val();
	var players			=	$('#players').val();
	
	var msg='';	
	 if (/[^a-zA-Z0-9\-\ /]/.test(name))
		msg = 'Special characters not allowed in Tournament name!';
	else if(tournamentname.length == 0)
		msg = 'Tournament name should not be empty';
	else if(type == 0)
		msg = 'Please select type !';
	else if(players == 0)
		msg = 'Please Select Player !';
	else if(entryfee1 == 0)
		msg = 'Please Select Entryfee !';	
	else if(type == 3  )
	{
		var matchs =$('#match').val();
		if(matchs == 0)
		msg = 'Please Select Schedule !';
	}
	else if(type == 7  )
	{
		var weekly =$('#weekly').val();
		if(weekly == 0)
		msg = 'Please Select the week !';
	}
	else if(type == 8  )
	{
		var series =$('#series').val();
		if(series == 0)
		msg = 'Please select Series !';
	}
	if(msg.length > 0)
	{

		$('.transparent-container').fadeIn('slow');
		$('#invite-dialog3').show();
		
		$('#create-submitId').css('margin','6px 0 5px 25px');
	
		$('#invite-textId').html(msg);
		return false;
	}
	zeal1.tournament.validate();
	//return true;
}