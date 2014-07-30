var docBreakCount = 0;
var clinicAvatar = '';
(function(root) {
	Doc.initJquery = function()
	{
		jQuery(document).ready(function($)
		{
			var pageCount = 0;
			$('div.page').each(function()
			{
				var id = $(this).attr('id');
				$(this).load(id+'.html', function(){pageCount += 1; if(pageCount == $('div.page').length)Doc.initParse();});
			});
		});
	};
	Doc.initialize = function()
	{
		Parse.initialize("SV7U73uAVhR6fn1IUR5OxPoa0fHBxyfQNk9NvJTA", "pZzaN8INyPr5UZuXHsPeoBRxuWZEmoGjwhjioCF2");
		Doc.initJquery();
	};
	Doc.initParse = function()
	{
		
		var geocoder;
		var map;
		currentUser = Parse.User.current();
		var currentLocation = '';
		if (currentUser)
		{
			var profilePhoto = currentUser.get("avatar");
			$('.avatar').prop('src', profilePhoto.url());
		}
		else
			window.location.href = '#home';
	};
	Doc.getNotification = function()
	{
		var Notification = Parse.Object.extend("notification");
		var query = new Parse.Query(Notification);
		query.equalTo("to", currentUser);
		query.include('from');
		query.find({
			success: function(tags) {
				var specialityCon = '';
				for (var i = 0; i < tags.length; i++)
				{
					specialityCon += '<div class="notifi-indiv-item"><div class="notifi-indiv-image"><div><img src="'+tags[i].get("from").get("avatar").url()+'"/></div></div><div class="notifi-indiv-text">'+tags[i].get("desc")+'</div></div>';
				}
				if(specialityCon.length == 0)
					document.getElementById('notifi-indiv-list').innerHTML = '<div class="center">No Notification</div>';
				else
					document.getElementById('notifi-indiv-list').innerHTML = specialityCon;
				Doc.hideLoader();
			},
			error: function(object, error) {
			}
		});
	};
	Doc.getDocDetails = function()
	{
		Doc.showLoader();
		var user = Parse.User.current();
		var Doctor = Parse.Object.extend("doctors");
		var doctorQuery = new Parse.Query(Doctor);
		doctorQuery.equalTo("parent", user);
		doctorQuery.find({
			success: function(data) {
				Doc.hideLoader();
				Doc.setElement('doc-mode-mobile', data[0].get('mobile'));
				Doc.setElement('doc-mode-email', data[0].get('email'));
				document.getElementById('doctor-id').innerHTML = currentUser.id;
			}
		});
	};
	Doc.saveDocSetting = function()
	{
		Doc.showLoader();
		var User = Parse.User.current();
		var Doctor = Parse.Object.extend("doctors");
		var query = new Parse.Query(Doctor);
		query.equalTo("parent", User);
		query.find({
			success: function(doctor) {
				var id = doctor[0].id;
				var doctor = new Doctor();
				doctor.set("objectId", id);
				var mobile = Doc.getElement('doc-mode-mobile').value;
				var email = Doc.getElement('doc-mode-email').value;
				doctor.set('mobile', mobile);
				doctor.set('email', email);
				Doc.hideLoader();
				if(Doc.getElement('doc-mode-check').value == 'false')
				{
					doctor.set("docmode", false);
					Doc.goto('index.html');
				}
				else
					Doc.goto('#my-clinic');
				doctor.save();
			},
			error: function(object, error) {
				Doc.hideLoader();
				alert('Error');
			}
		});
	};
	Doc.createClinic = function()
	{
		Doc.showLoader();
		var name = Doc.getElement('clinic-name').value;
		var type = Doc.getElement('clinic-type').value;
		var country = Doc.getElement('clinic-country').value;
		var state = Doc.getElement('clinic-state').value;
		var city = Doc.getElement('clinic-city').value;
		var address = Doc.getElement('clinic-address').value;
		var pincode = Doc.getElement('clinic-pincode').value;
		var contactno = Doc.getElement('clinic-contact-no').value;
		var email = Doc.getElement('clinic-email').value;
		var User = Parse.User.current();
		var Clinic = Parse.Object.extend("clinic");
		var clinic = new Clinic();
		clinic.set('name', name);
		clinic.set('type', type);
		clinic.set('country', country);
		clinic.set('state', state);
		clinic.set('city', city);
		clinic.set('address', address);
		clinic.set('pincode', pincode);
		clinic.set('contactno', contactno);
		clinic.set('email', email);
		clinic.set("parent", User);
		clinic.set("avatar", clinicAvatar);
		clinic.save(null, {
		  success: function(gameScore) {
			clinic.save(null, {
				success: function(data){
					var Role = Parse.Object.extend("role");
					var role = new Role();
					role.set("username", User.get("username"));
					role.set("role", "Owner");
					var Clinic = Parse.Object.extend("clinic");
					var clinic = new Clinic();
					clinic.id = data.id;
					role.set("parent", clinic);
					role.save(null, {
						success: function(data){
							Doc.hideLoader();
							document.getElementById("create-clinic-form").reset();
							Doc.goto('#my-clinic');
						}
					});
					Doc.getClinic();
				}
			});
			Doc.hideLoader();
		  }
		});
		return false;
	};
	Doc.getClinic = function()
	{
		Doc.showLoader();
		var User = Parse.User.current();
		var Doctor = Parse.Object.extend("clinic");
		var query = new Parse.Query(Doctor);
		query.equalTo("parent", User);
		query.find({
			success: function(clinic) {
				var clic = '';
				var clic1 = '';
				for (var i = 0; i < clinic.length; i++)
				{
					clic += '<div class="clinic-link clinic-link-remove-icon"><a class="clinic-link-arrow" onclick="MC.getMyClinic(\''+clinic[i].id+'\')" data-transition="fade">'+clinic[i].get("name")+'</a></div>';
					clic1 += '<div class="clinic-link clinic-link-remove-icon"><a class="clinic-link-arrow" onclick="MC.getClinicApp(\''+clinic[i].id+'\')" data-transition="fade" href="#doc-clinic-app">'+clinic[i].get("name")+'</a></div>';
				}
				Doc.getElement('my-clinic-cont').innerHTML = clic;
				$('.my-clinic-cont').html(clic1);
				Doc.hideLoader();
			},
			error: function(object, error) {
				Doc.hideLoader();
				alert('Error');
			}
		});
	};
	Doc.updateBreak = function()
	{
		var docBreakValue = $('#doc-break-count').val();
		if(docBreakCount < docBreakValue)
		{
			
			var breaks = '<div>'+
			'<select name="in" class="days" data-role="none">'+
				'<option value="0">Start Time</option>'+
				'<option value="1">1:00 AM</option>'+
				'<option value="2">2:00 AM</option>'+
				'<option value="2">3:00 AM</option>'+
				'<option value="2">4:00 AM</option>'+
				'<option value="2">5:00 AM</option>'+
				'<option value="2">6:00 AM</option>'+
				'<option value="2">7:00 AM</option>'+
				'<option value="2">8:00 AM</option>'+
				'<option value="2">9:00 AM</option>'+
				'<option value="2">10:00 AM</option>'+
				'<option value="2">11:00 AM</option>'+
				'<option value="2">12:00 PM</option>'+
				'<option value="2">13:00 PM</option>'+
				'<option value="2">14:00 PM</option>'+
				'<option value="2">15:00 PM</option>'+
				'<option value="2">16:00 PM</option>'+
				'<option value="2">17:00 PM</option>'+
				'<option value="2">18:00 PM</option>'+
				'<option value="2">19:00 PM</option>'+
				'<option value="2">20:00 PM</option>'+
				'<option value="2">21:00 PM</option>'+
				'<option value="2">22:00 PM</option>'+
				'<option value="2">23:00 PM</option>'+
			'</select>'+
			'<select name="in" class="days" data-role="none">'+
				'<option value="0">Duration</option>'+
				'<option value="1">5 Min</option>'+
				'<option value="2">10 Min</option>'+
				'<option value="2">15 Min</option>'+
				'<option value="2">20 Min</option>'+
				'<option value="2">30 Min</option>'+
				'<option value="2">40 Min</option>'+
				'<option value="2">45 Min</option>'+
				'<option value="2">50 Min</option>'+
				'<option value="2">1 Hrs</option>'+
				'<option value="2">2 Hrs</option>'+
				'<option value="2">3 Hrs</option>'+
				'<option value="2">4 Hrs</option>'+
			'</select></div>';
			$('#work-break-html').append(breaks);
		}
		else
		{
			$('#work-break-html div:last-child').remove();
		}
		docBreakCount = docBreakValue;
	};
	Doc.updateWorkSchedule = function()
	{
		Doc.showLoader();
		currentUser = Parse.User.current();
		$.when( Doc.deleteSchedule() ).done(function( x ) {
			var schedule = Array();
			$('.work-time-schedule').each(function(){
				var scheduleList = Array();
				var day = $(this).children('select.days').val();
				var inTime = $(this).children('select.in-time').val();
				var outTime = $(this).children('select.out-time').val();
				scheduleList["day"] = day;
				scheduleList["inTime"] = inTime;
				scheduleList["outTime"] = outTime;
				schedule.push(scheduleList);
			}).promise().done(function(){
					for(i = 0; i < schedule.length; i++)
					{
						if(schedule[i]['day'] > 0)
						{
							if(clinicSchType == 'Doc')
								var Schedules = Parse.Object.extend("doc_schedule");
							else
								var Schedules = Parse.Object.extend("clinic_schedule");
							var schedules = new Schedules();
							schedules.set("day", schedule[i]['day']);
							schedules.set("in_time", schedule[i]['inTime']);
							schedules.set("out_time", schedule[i]['outTime']);
							if(clinicSchType == 'Doc')
								schedules.set("doctor", myClinicDoc);
							schedules.set("clinic", myClinic);
							schedules.save();
						}
					}
					Doc.hideLoader();
				});
		});
	};
	Doc.deleteSchedule = function()
	{
		var dfd = new jQuery.Deferred();
		var Schedule = Parse.Object.extend("doc_schedule");
		var query = new Parse.Query(Schedule);
		query.equalTo("doctor", myClinicDoc);
		query.equalTo("clinic", myClinic);
		query.find({
			success: function(result) {
				if(result.length == 0)
					dfd.resolve();
				for(i = 0; i < result.length; i++)
				{
					result[i].destroy();
					if(result.length == (i+1))
						dfd.resolve();
				}
			},
			error: function(error) {
				alert('Error in delete query');
			}
		});
		return dfd.promise();
	};
	Doc.loadSchedule = function()
	{
		
	};
	Doc.getDocIdFrmUsrId = function(id)
	{
		var dfd = new jQuery.Deferred();
		var Schedule = Parse.Object.extend("doctors");
		var query = new Parse.Query(Schedule);
		var User = Parse.Object.extend("User");
		var user = new User();
		user.id = id;
		query.equalTo("parent", user);
		query.find({
			success: function(result) {
				dfd.resolve(result[0].id);
			},
			error: function(error) {
				alert('Error in delete query');
			}
		});
		return dfd.promise();
	};
	Doc.getMyFollowers = function()
	{
		Doc.showLoader();
		$.when(Doc.getDocIdFrmUsrId(currentUser.id)).then(
			function(id)
			{
				var searchQuery = Parse.Object.extend("favourite");
				var query = new Parse.Query(searchQuery);
				var Doctor = Parse.Object.extend("doctors");
				var doctor = new Doctor();
				doctor.id = id;
				query.equalTo("doctor", doctor);
				query.include('user');
				query.find({
					success: function(data)
					{
						var searchDoc = '';
						for (var i = 0; i < data.length; i++)
						{
							searchDoc += '<div class="clinic-link"><a class="clinic-link-arrow" href="#favourites-details" data-transition="fade" onclick="Doc.showMyFavourites(\''+data[i].id+'\')">'+data[i].get("user").get('username')+'</a></div>';
						}
						document.getElementById('my-followers-list').innerHTML = searchDoc;
						Doc.hideLoader();
					},
					error: function(error) {
						alert(error);
					}
				});
  			}
		);
	};
	Doc.getMyPatients = function()
	{
		Doc.showLoader();
		$.when(Doc.getDocIdFrmUsrId(currentUser.id)).then(
			function(id)
			{
				var searchQuery = Parse.Object.extend("bookings");
				var query = new Parse.Query(searchQuery);
				var Doctor = Parse.Object.extend("doctors");
				var doctor = new Doctor();
				doctor.id = id;
				query.equalTo("doctor", doctor);
				query.include('user');
				query.find({
					success: function(data)
					{
						var searchDoc = '';
						for (var i = 0; i < data.length; i++)
						{
							searchDoc += '<div class="clinic-link"><a class="clinic-link-arrow" href="#favourites-details" data-transition="fade" onclick="Doc.showMyFavourites(\''+data[i].get("user").id+'\')">'+data[i].get("user").get('username')+'</a></div>';
						}
						document.getElementById('my-patient-list').innerHTML = searchDoc;
						Doc.hideLoader();
					},
					error: function(error) {
						alert(error);
					}
				});
  			}
		);
	};
}(this));
document.addEventListener('deviceready', Doc.initialize(), false);