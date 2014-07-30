var myClinic = '';
var myClinicMember = '';
var myClinicDoc = '';
var availableUsers = [];
var map = '';
var markers = [];
var mapSaveInterval = '';
var clinicSchType = '';
var docAppClinicId = '';
var docPatientAppId = '';
(function(root) {
	root.MC = root.MC || {};
	MC.getMyClinic = function(id)
	{
		$('.ui-loader').show();
		var Clinic = Parse.Object.extend("clinic");
		var query = new Parse.Query(Clinic);
		query.get(id, {
			success: function(clinic) {
				myClinic = clinic;
				$('.my-clinic-title').html(clinic.get('name'));
				Doc.goto('#my-clinic-home');
				$('.ui-loader').hide();
			},
			error: function(object, error) {
				  
			}
		});
	};
	MC.getClinicUsers = function(id)
	{
		$('.ui-loader').show();
		var username = Doc.getElement('invite-username').value;
		var searchQuery = Parse.Object.extend("User");
		var query = new Parse.Query(searchQuery);
		query.startsWith("username", username);
		query.find({
			success: function(data)
			{
				availableUsers = [];
				for (var i = 0; i < data.length; i++)
				{
					availableUsers.push(data[i].get('username'));
				}
				$('.ui-loader').hide();
				$('#invite-username').autocomplete({
					source: availableUsers
				});
			},
			error: function(error) {
				alert(error);
			}
		});
		
	};
	MC.addClinicRole = function()
	{
		$('.ui-loader').show();
		var username = Doc.getElement('invite-username').value;
		var usrrole = Doc.getElement('member-role').value;
		var Role = Parse.Object.extend("role");
		var role = new Role();
		var User = Parse.Object.extend("User");
		var query = new Parse.Query(User);
		query.equalTo("username", username);
		query.find({
			success: function(clinic) {
				var user = new User();
				user.id = clinic[0].id;
				role.set("user_id", user);
				role.set("username", username);
				role.set("role", usrrole);
				var Clinic = Parse.Object.extend("clinic");
				var clinic = new Clinic();
				clinic.id = myClinic.id;
				role.set("parent", clinic);
				role.save(null, {
					success: function(data){
						$('.ui-loader').hide();
						Doc.goto('#invite-member-list');
						MC.getClinicMember();
					}
				});
			},
			error: function(object, error) {
				$('.ui-loader').hide();
				alert('Error');
			}
		});
		
	};
	MC.getClinicMember = function()
	{
		$('.ui-loader').show();
		var Doctor = Parse.Object.extend("role");
		var query = new Parse.Query(Doctor);
		var Clinic = Parse.Object.extend("clinic");
		var clinic = new Clinic();
		clinic.id = myClinic.id;
		query.equalTo("parent", clinic);
		query.find({
			success: function(clinic) {
				var clic = '';
				for (var i = 0; i < clinic.length; i++)
				{
					clic += '<div class="clinic-link clinic-link-remove-icon"><a class="clinic-link-arrow" onclick="MC.getMyClinicMember(\''+clinic[i].id+'\')" data-transition="fade">'+clinic[i].get("username")+'</a></div>';
				}
				Doc.getElement('clinic-members').innerHTML = clic;
				$('.ui-loader').hide();
			},
			error: function(object, error) {
				$('.ui-loader').hide();
				alert('Error');
			}
		});
	};
	MC.getMyClinicMember = function(id)
	{
		$('.ui-loader').show();
		var Clinic = Parse.Object.extend("role");
		var query = new Parse.Query(Clinic);
		query.get(id, {
			success: function(clinic) {
				myClinicMember = clinic;
				$('.my-clinic-member').html(clinic.get('username'));
				Doc.goto('#my-clinic-member');
				$('.ui-loader').hide();
			},
			error: function(object, error) {
				  
			}
		});
	};
	MC.myClinicShowMap = function()
	{
	  var script = document.createElement('script');
	  script.type = 'text/javascript';
	  script.src = 'https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&' +
		  'callback=MC.showMyLocation';
	  document.body.appendChild(script);
	};
	MC.showMyLocation = function()
	{
		$('.ui-loader').show();
		var mapOptions = {zoom: 12};
		map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);

		if(navigator.geolocation)
		{		
			navigator.geolocation.getCurrentPosition(function(position)
			{
				var pos = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);
				map.setCenter(pos);
				$('.ui-loader').hide();
			}, function(){
				//handleNoGeolocation(true);
			});
		}
		google.maps.event.addListener(map, 'click', function(e) {
			MC.placeMarker(e.latLng, map);
		});
	};
	MC.searchLocation = function()
	{
		$('.ui-loader').show();
		var address = document.getElementById('geocodeInput').value;
		geocoder = new google.maps.Geocoder();
		geocoder.geocode( { 'address': address}, function(results, status) {
			if (status == google.maps.GeocoderStatus.OK) {
				map.setCenter(results[0].geometry.location);
				$('.ui-loader').hide();
			} else {
			alert('Error: ' + status);
			}
		});
	};
	MC.placeMarker = function(position, map)
	{
		MC.clearAllMarker(null);
		markers = [];
		var marker = new google.maps.Marker({
			position: position,
			map: map
		});
		markers.push(marker);
		mapSaveInterval = setTimeout(function(){MC.saveMarkerLocation(marker);}, 3000);
	};
	MC.clearAllMarker = function(map)
	{
		for (var i = 0; i < markers.length; i++)
		{
			markers[i].setMap(map);
		}
		clearTimeout(mapSaveInterval);
	};
	MC.saveMarkerLocation = function(position)
	{
		var lat = position.getPosition().lat();
		var lng = position.getPosition().lng()
		var User = Parse.User.current();
		var Clinic = Parse.Object.extend("clinic");
		var clinic = new Clinic();
		clinic.id = myClinic.id;
		var point = new Parse.GeoPoint({latitude: lat, longitude: lng});
		clinic.set("location", point);
		clinic.save(null, {
			success: function(data){
				
			}
		});
	};
	MC.showMyClinicInfo = function()
	{
		if(!myClinic)
			return false;
		Doc.getElement('clinic-name-info').value = myClinic.get('name');
		Doc.getElement('clinic-type-info').value = myClinic.get('type');
		Doc.getElement('clinic-country-info').value = myClinic.get('country');
		Doc.getElement('clinic-state-info').value = myClinic.get('state');
		Doc.getElement('clinic-city-info').value = myClinic.get('city');
		Doc.getElement('clinic-address-info').value = myClinic.get('address');
		Doc.getElement('clinic-pincode-info').value = myClinic.get('pincode');
		Doc.getElement('clinic-contact-no-info').value = myClinic.get('contactno');
		Doc.getElement('clinic-email-info').value = myClinic.get('email');
		
		if (typeof myClinic.get('avatar') != 'undefined')
		{
			Doc.getElement('clinic-avatar').src = myClinic.get('avatar').url();
		}
	};
	
	MC.updateMyClinicInfo = function()
	{
		if(!myClinic)
			return false;
		$('.ui-loader').show();
		var name = Doc.getElement('clinic-name-info').value;
		var type = Doc.getElement('clinic-type-info').value;
		var country = Doc.getElement('clinic-country-info').value;
		var state = Doc.getElement('clinic-state-info').value;
		var city = Doc.getElement('clinic-city-info').value;
		var address = Doc.getElement('clinic-address-info').value;
		var pincode = Doc.getElement('clinic-pincode-info').value;
		var contactno = Doc.getElement('clinic-contact-no-info').value;
		var email = Doc.getElement('clinic-email-info').value;

		var Clinic = Parse.Object.extend("clinic");
		var clinic = new Clinic();
		clinic.id = myClinic.id;
		clinic.set("name", name);
		clinic.set("type", type);
		clinic.set("country", country);
		clinic.set("state", state);
		clinic.set("city", city);
		clinic.set("address", address);
		clinic.set("pincode", pincode);
		clinic.set("contactno", contactno);
		clinic.set("email", email);
		clinic.save(null, {
			success: function(data){
				$('.ui-loader').hide();
				alert('Updated Successfully');
			}
		});
		return false;
	};
	MC.onAvatarSuccess = function(imageData)
	{
		Doc.showLoader();
		var base64 = imageData;
		var parseFile = new Parse.File("photo.jpg", { base64: base64 });
		parseFile.save().then(function() {
			var Clinic = Parse.Object.extend("clinic");
			var clinic = new Clinic();
			clinic.id = myClinic.id;
			clinic.set("avatar", parseFile);
			clinic.save(null, {
			  success: function(gameScore) {
				var profilePhoto = clinic.get("avatar");
				$('.clinic-avatar').prop('src', profilePhoto.url());
				Doc.hideLoader();
			  }
			});
		}, function(error) {
			alert(error);
		});
	};
	
	MC.onAvatarFail = function(message)
	{
		alert('Failed because: ' + message);
	};
	
	MC.updateAvatar = function()
	{
		navigator.camera.getPicture(MC.onAvatarSuccess, MC.onAvatarFail, { quality: 50,
			destinationType: Camera.DestinationType.DATA_URL,
			sourceType : Camera.PictureSourceType.PHOTOLIBRARY
		});
	};
	MC.addAvatar = function()
	{
		navigator.camera.getPicture(MC.saveAvatarSuccess, MC.onAvatarFail, { quality: 50,
			destinationType: Camera.DestinationType.DATA_URL,
			sourceType : Camera.PictureSourceType.PHOTOLIBRARY
		});
	};
	MC.saveAvatarSuccess = function(imageData)
	{
		Doc.showLoader();
		var base64 = imageData;
		var parseFile = new Parse.File("photo.jpg", { base64: base64 });
		parseFile.save().then(function() {
			$('#create-clinic-avatar').prop('src', "data:image/jpeg;base64," + imageData);
			clinicAvatar = parseFile;
			Doc.hideLoader();
		}, function(error) {
			alert(error);
		});
	};
	MC.showClinicDocTime = function(ele)
	{
		$('#doc-working-timing-home .button').removeClass('active');
		$(ele).addClass('active');
		$('.clinic-work-time').hide();
		$('.clinic-doc-work-time').show();
	};
	MC.showClinicAllTime = function(ele)
	{
		$('#doc-working-timing-home .button').removeClass('active');
		$(ele).addClass('active');
		$('.clinic-work-time').hide();
		$('.clinic-all-work-time').show();
	};
	MC.loadMembers = function()
	{
		var Doctor = Parse.Object.extend("role");
		var query = new Parse.Query(Doctor);
		var Clinic = Parse.Object.extend("clinic");
		var clinic = new Clinic();
		clinic.id = myClinic.id;
		query.equalTo("parent", clinic);
		query.equalTo("role", "Doctor");
		query.find({
			success: function(clinic) {
				var clic = '';
				for (var i = 0; i < clinic.length; i++)
				{
					clic += '<div class="clinic-link clinic-link-remove-icon"><a class="clinic-link-arrow" href="#doc-working-timing" onclick="MC.getDocTime(\''+clinic[i].get("user_id").id+'\')" data-transition="fade">Dr. '+clinic[i].get("username")+'</a></div>';
				}
				$('.clinic-doc-work-time').html(clic);
				$('.ui-loader').hide();
			},
			error: function(object, error) {
				$('.ui-loader').hide();
				alert('Error');
			}
		});
	};
	MC.getDocTime = function(id)
	{
		MC.getDogLeave(id);
		Doc.showLoader();
		clinicSchType = 'Doc';
		var DocSchedule = Parse.Object.extend("doc_schedule");
		var query = new Parse.Query(DocSchedule);
		var Clinic = Parse.Object.extend("clinic");
		var clinic = new Clinic();
		clinic.id = myClinic.id;
		var User = Parse.Object.extend("User");
		var user = new User();
		user.id = id;
		myClinicDoc = user;
		query.equalTo("clinic", clinic);
		query.equalTo("doctor", user);
		query.ascending("day");
		document.getElementById("schedule-form").reset();
		query.find({
			success: function(time) {
				var day = $('.days');
				var inTime = $('.in-time');
				var outTime = $('.out-time');
				for (var i = 0; i < time.length; i++)
				{
					day.eq(i).val(time[i].get('day'));
					inTime.eq(i).val(time[i].get('in_time'));
					outTime.eq(i).val(time[i].get('out_time'));
				}
				$('.ui-loader').hide();
			},
			error: function(object, error) {
				$('.ui-loader').hide();
				alert('Error');
			}
		});
	};
	MC.getClinicTime = function()
	{
		MC.getClinicLeave();
		Doc.showLoader();
		clinicSchType = 'Clinic';
		var DocSchedule = Parse.Object.extend("clinic_schedule");
		var query = new Parse.Query(DocSchedule);
		var Clinic = Parse.Object.extend("clinic");
		var clinic = new Clinic();
		clinic.id = myClinic.id;
		query.equalTo("clinic", clinic);
		query.ascending("day");
		document.getElementById("schedule-form").reset();
		query.find({
			success: function(time) {
				var day = $('.days');
				var inTime = $('.in-time');
				var outTime = $('.out-time');
				for (var i = 0; i < time.length; i++)
				{
					day.eq(i).val(time[i].get('day'));
					inTime.eq(i).val(time[i].get('in_time'));
					outTime.eq(i).val(time[i].get('out_time'));
				}
				$('.ui-loader').hide();
			},
			error: function(object, error) {
				$('.ui-loader').hide();
				alert('Error');
			}
		});
	};
	MC.getClinicLeave = function()
	{
		var DocSchedule = Parse.Object.extend("clinic_schedule_leave");
		var query = new Parse.Query(DocSchedule);
		var Clinic = Parse.Object.extend("clinic");
		var clinic = new Clinic();
		clinic.id = myClinic.id;
		query.equalTo("clinic", clinic);
		query.find({
			success: function(data) {
				var leaveData = '';
				for (var i = 0; i < data.length; i++)
				{
					leaveData += '<div class="clinic-link clinic-link-remove-icon"><a class="clinic-link-arrow clinic-link-arrow-minus" data-transition="fade">'+data[i].get("leave")+'</a></div>';
				}
				$('#doc-leave-add').html(leaveData);
			},
			error: function(object, error) {
				$('.ui-loader').hide();
				alert('Error');
			}
		});
	};
	MC.getDogLeave = function(id)
	{
		var DocSchedule = Parse.Object.extend("doc_schedule_leave");
		var query = new Parse.Query(DocSchedule);
		var Clinic = Parse.Object.extend("clinic");
		var clinic = new Clinic();
		clinic.id = myClinic.id;
		var User = Parse.Object.extend("User");
		var user = new User();
		user.id = id;
		myClinicDoc = user;
		query.equalTo("clinic", clinic);
		query.equalTo("doctor", user);
		query.find({
			success: function(data) {
				var leaveData = '';
				for (var i = 0; i < data.length; i++)
				{
					leaveData += '<div class="clinic-link clinic-link-remove-icon"><a class="clinic-link-arrow clinic-link-arrow-minus" data-transition="fade">'+data[i].get("leave")+'</a></div>';
				}
				$('#doc-leave-add').html(leaveData);
			},
			error: function(object, error) {
				$('.ui-loader').hide();
				alert('Error');
			}
		});
	};
	MC.addLeave = function()
	{
		if(clinicSchType == 'Doc')
			var Schedules = Parse.Object.extend("doc_schedule_leave");
		else
			var Schedules = Parse.Object.extend("clinic_schedule_leave");
		var schedules = new Schedules();
		schedules.set("leave", document.getElementById("leave-date-time").value);
		if(clinicSchType == 'Doc')
			schedules.set("doctor", myClinicDoc);
		schedules.set("clinic", myClinic);
		schedules.save();
		Doc.gotoBack();
		if(clinicSchType == 'Doc')
			MC.getDogLeave();
		else
			MC.getClinicLeave();
	};
	MC.getClinicApp = function(id)
	{
		var Clinic = Parse.Object.extend("clinic");
		var query = new Parse.Query(Clinic);
		query.get(id, {
			success: function(clinic) {
				$('.my-clinic-app-title').html(clinic.get('name'));
			},
			error: function(object, error) {
				  console.log(error);
			}
		});
		docAppClinicId = id
		var Doctor = Parse.Object.extend("role");
		var query = new Parse.Query(Doctor);
		var Clinic = Parse.Object.extend("clinic");
		var clinic = new Clinic();
		clinic.id = id;
		query.equalTo("parent", clinic);
		query.equalTo("role", "Doctor");
		query.include("user_id");
		query.find({
			success: function(clinic) {
				var clic = '';
				var dropdown = document.getElementById('doc-app-clinic-date');
				for (var i = 0; i < clinic.length; i++)
				{
					var option = document.createElement("option");
					option.text = 'Dr. '+clinic[i].get("user_id").get("username");
					option.value = clinic[i].get("user_id").id;
					dropdown.add(option);
				}
				$('.ui-loader').hide();
			},
			error: function(object, error) {
				$('.ui-loader').hide();
				alert('Error');
			}
		});
		var Booking = Parse.Object.extend("bookings");
		var query = new Parse.Query(Booking);
		var Clinic = Parse.Object.extend("clinic");
		var clinic = new Clinic();
		clinic.id = id;
		query.equalTo("clinic", clinic);
		var today = new Date();
		var dateString = today.getFullYear()+'-'+("0" + (today.getMonth() + 1)).slice(-2)+'-'+("0" + today.getDate()).slice(-2);
		document.getElementById('doc-app-date-input').value = dateString;
		query.equalTo("date", dateString);
		query.include('user');
		query.find({
			success: function(data) {
				var clinicAppList = '';
				for (var i = 0; i < data.length; i++)
				{
					clinicAppList += '<div class="clinic-link"><a class="clinic-link-arrow doc-clinic-app-user" rel="'+data[i].id+'" href="#doc-clinic-app-patient" data-transition="fade" onclick="MC.getAppoiPatient(\''+data[i].id+'\')">'+data[i].get('user').get('username')+'</a></div>';
				}
				$('#doc-clinic-app-list').html(clinicAppList);
			},
			error: function(object, error) {
				$('.ui-loader').hide();
				alert('Error');
			}
		});
	};
	MC.getAppoiPatient = function(id)
	{
		docPatientAppId = id;
		Doc.showLoader();
		var Booking = Parse.Object.extend("bookings");
		var query = new Parse.Query(Booking);
		query.include('user');
		query.include('schedule');
		query.get(id, {
			success: function(data) {
				document.getElementById('doc-app-patient-name').innerHTML = data.get('user').get('username');
				document.getElementById('doc-app-patient-age').innerHTML = getAge(data.get('user').get('dob'));
				document.getElementById('doc-app-patient-gender').innerHTML = (data.get('user').get('gender')==1?'Male':'Female');
				document.getElementById('doc-app-patient-contact').innerHTML = data.get('user').get('phone');
				document.getElementById('doc-app-patient-date').innerHTML = data.get('date');
				document.getElementById('doc-app-patient-bid').innerHTML = data.id;
				document.getElementById('clinic-app-avatar').src = data.get('user').get('avatar').url();
				document.getElementById('doc-clinic-app-patie-stat').value = data.get('status');
				if(data.get('status') == 'Completed')
					$('#doc-app-pat-btn').attr('value', 'Completed').attr('onclick','');
				
				Doc.hideLoader();
			},
			error: function(object, error) {
				  console.log(error);
			}
		});
	};
	MC.updateAppoiPatStatus = function()
	{
		Doc.showLoader();
		var Bookings = Parse.Object.extend("bookings");
		var booking = new Bookings();
		booking.id = docPatientAppId;
		booking.set('status', document.getElementById('doc-clinic-app-patie-stat').value);
		booking.save(null, {
			success: function(gameScore) {
				Doc.hideLoader();
				alert('Booking updated successfully');
				Doc.gotoBack();
			},
			error: function(gameScore, error) {
				alert('Failed');
				Doc.hideLoader();
			}
		});
	};
	MC.updateAppoiBookTime = function()
	{
		Doc.showLoader();
		var Tags = Parse.Object.extend("doc_schedule");
		var query = new Parse.Query(Tags);
		var bookDate = document.getElementById('book-date').value;
		var Clinic = Parse.Object.extend("clinic");
		var clinic = new Clinic();
		clinic.id = docAppClinicId;
		query.equalTo("clinic", clinic);
		var User = Parse.Object.extend("User");
		var user = new User();
		user.id = bookDoctor;
		query.equalTo("doctor", user);
		var date = new Date(bookDate);
		query.equalTo("day", date.getDay()+1);
		query.find({
			success: function(data) {
				var dropdown = document.getElementById('clinic-type-time');
				for (i = 0; i < dropdown.length;  i++)
				{
				   if (dropdown.options[i].value != '0')
					 dropdown.remove(i);
				}
				for (var i = 0; i < data.length; i++)
				{
					var option = document.createElement("option");
					option.text = data[i].get('in_time')+' - '+data[i].get('out_time');
					option.value = data[i].id;
					dropdown.add(option);
				}
				Doc.hideLoader();
			},
			error: function(object, error) {
			}
		});
		
		var Doctor = Parse.Object.extend("clinic");
		var query = new Parse.Query(Doctor);
		query.get(id, {
			success: function(clinic) {
				$('.book-doctor-addr').html(clinic.get('address'));
				Doc.hideLoader();
				$('#book-doctor .address-hider').removeClass('hide');
				
			},
			error: function(object, error) {
				  console.log(error);
			}
		});
	};
	MC.updateDocCliApp = function()
	{
		var Booking = Parse.Object.extend("bookings");
		var query = new Parse.Query(Booking);
		var Clinic = Parse.Object.extend("clinic");
		var clinic = new Clinic();
		clinic.id = docAppClinicId;
		query.equalTo("clinic", clinic);
		var dateString = document.getElementById('doc-app-date-input').value;
		query.equalTo("date", dateString);
		var doctorId = document.getElementById('doc-app-clinic-date').value;
		
		$.when(Doc.getDocIdFrmUsrId(doctorId)).then(
			function(id)
			{
				var Doctor = Parse.Object.extend("doctors");
				var doctor = new Doctor();
				doctor.id = id;
				query.equalTo("doctor", doctor);
				query.include('user');
				query.find({
					success: function(data) {
						var clinicAppList = '';
						for (var i = 0; i < data.length; i++)
						{
							clinicAppList += '<div class="clinic-link"><a class="clinic-link-arrow" href="#doc-clinic-app-patient" data-transition="fade">'+data[i].get('user').get('username')+'</a></div>';
						}
						$('#doc-clinic-app-list').html(clinicAppList);
					},
					error: function(object, error) {
						$('.ui-loader').hide();
						alert('Error');
					}
				});
  			}
		);
		
	};
	MC.docManualAppoin = function()
	{
		var patientName = document.getElementById('app-patient-name').value;
		var patientNo = document.getElementById('app-patient-no').value;
		Doc.showLoader();
		var doctorId = document.getElementById('doc-app-clinic-date').value;
		$.when(Doc.getDocIdFrmUsrId(doctorId)).then(
			function(id)
			{
				var Bookings = Parse.Object.extend("bookings_manual");
				var booking = new Bookings();
				var User = Parse.Object.extend("doctors");
				var user = new User();
				user.id = id;
				booking.set('doctor', user);
				var Clinic = Parse.Object.extend("clinic");
				var clinic = new Clinic();
				var clinicId = document.getElementById('clinic-type-info').value;
				clinic.id = docAppClinicId;
				booking.set('clinic', clinic);
				var bookDate = document.getElementById('doc-app-date-input').value;
				booking.set('date', bookDate);
				
  			}
		);
		
		
		
		
		
		
		
		var clinicTime = document.getElementById('clinic-type-time').value;
		var Schedule = Parse.Object.extend("doc_schedule");
		var schedule = new Schedule();
		schedule.id = clinicTime;
		booking.set('schedule', schedule);
		booking.set('user', currentUser);
		booking.save(null, {
			success: function(gameScore) {
				Doc.hideLoader();
				alert('Booked successfully');
				Doc.gotoBack();
			},
			error: function(gameScore, error) {
				alert('Failed');
				Doc.hideLoader();
			}
		});
	};
}(this));
function getAge(dateString)
{
    var today = new Date();
    var birthDate = new Date(dateString);
    var age = today.getFullYear() - birthDate.getFullYear();
    var m = today.getMonth() - birthDate.getMonth();
    if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) {
        age--;
    }
    return age;
}