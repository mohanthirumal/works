(function(root) {
	root.Doc = root.Doc || {};
	
	Doc.getElement = function(id)
	{
		return document.getElementById(id);
	}
	Doc.setElement = function(id, value)
	{
		document.getElementById(id).value = value;
	}
	Doc.getDateItem = function()
	{
		var calendar = '';
		var weekDays = ["Sun","Mon","Tue","Wed","Thu","Fri","Sat"];
		var months = [ "January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December" ];
		var today = new Date();
		for(i = 0; i < 7; i++)
		{
			calendar += '<div class="doctor-app-date">Appointments - '+weekDays[today.getDay()]+' '+today.getDate()+' '+months[today.getMonth()+1]+', '+today.getFullYear()+'</div>';
			today.setDate(today.getDate() + 1);
		}
		return (calendar);
	}
	Doc.showDocHome = function()
	{
		var items = Doc.getDateItem();
		Doc.getElement('calendar').innerHTML = items;
		Doc.getSchedules();
		
	};
	Doc.logout = function()
	{
		Parse.User.logOut();
		window.location.href = '#login';
	};
	Doc.showSignup = function()
	{
		window.location.href = '#signup';
	};
	Doc.showSignin = function()
	{
		window.location.href = '#login';
	};
	Doc.showLoader = function()
	{
		$('.ui-loader').show();
		$con.mobile.loading( 'show', {
		  text: '',
		  textVisible: 'true',
		  theme: 'b',
		  textonly: '',
		  html: ''
		});
		$('.content').hide();
	};
	Doc.hideLoader = function()
	{
		$('.ui-loader').hide();
		$con.mobile.loading( 'hide');
		$('.content').show();
	};
	Doc.loadScript = function(func)
	{
	  var script = document.createElement('script');
	  script.type = 'text/javascript';
	  script.src = 'https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&' +
		  'callback='+func;
	  document.body.appendChild(script);
	};
	
	Doc.showMyLocation = function()
	{
		$('.ui-loader').show();
		var mapOptions = {zoom: 18};
		map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);

		if(navigator.geolocation)
		{		
			navigator.geolocation.getCurrentPosition(function(position)
			{
				var pos = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);
				var infowindow = new google.maps.InfoWindow({map: map, position: pos, content: 'You are here'});
				map.setCenter(pos);
				$('.ui-loader').hide();
			}, function(){
				//handleNoGeolocation(true);
			});
		}
	};
	
	Doc.goto = function(url)
	{
		window.location.href = url;
	};
	
	Doc.showContent = function(id, clas, ele)
	{
		$(ele).parent().children('.button').removeClass('active');
		$(ele).addClass('active');
		$('.'+clas).hide();
		$('.'+clas+id).show();
	};
	Doc.gotoBack = function()
	{
		history.back();
	};
}(this));