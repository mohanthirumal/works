zeal.jQuery(document).ready(function($)
{
	zeal.jQuery('.tour-join-btn').live('click', function(){
		var rel = zeal.jQuery(this).attr('rel');
		var ids = rel.split(',');
		window.location.href = '#';
		zeal.tournament.selectTournament(ids[0], ids[1]);
	});
});