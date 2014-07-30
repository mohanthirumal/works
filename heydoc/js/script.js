var currentUser = '';
var searchType = '';
var bookDoctor = '';
var bookDoctorId = '';
var appClinicId = '';
var appDocId = '';
var manDocId = '';
var registerUserAvatar = '';
var myGeoLoc = '';
var shareWindow = '';
(function(root) {
	root.Doc = root.Doc || {};
	Doc.initJquery = function()
	{
		
		jQuery(document).ready(function($)
		{
			Doc.showLoader();
			$('div.page').each(function()
			{
				var id = $(this).attr('id');		
				$("#"+id).load(id+'.html').trigger('create');
			}).promise().done(function(){Doc.initParse();});
		});
		
	};
	
	Doc.InitFB = function()
	{
		openFB.init('400201633456132');
//		window.fbAsyncInit = function() {
//		  Parse.FacebookUtils.init({
//			appId      : '400201633456132', // Facebook App ID
//			channelUrl : '//zealcitytest.parseapp.com/', // Channel File
//			cookie     : true, // enable cookies to allow Parse to access the session
//			xfbml      : true  // parse XFBML
//		  });
//		 
//		  // Additional initialization code here
//		};
//		(function(d, s, id){
//				 var js, fjs = d.getElementsByTagName(s)[0];
//				 if (d.getElementById(id)) {return;}
//				 js = d.createElement(s); js.id = id;
//				 js.src = "//connect.facebook.net/en_US/all.js";
//				 fjs.parentNode.insertBefore(js, fjs);
//			   }(document, 'script', 'facebook-jssdk'));
	};
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
	Doc.getSchedules = function()
	{
		var Booking = Parse.Object.extend("booking");
		var User = Parse.Object.extend("User");
		var bookingQuery = new Parse.Query(Booking);
		
		var userQuery = new Parse.Query(User);
		//query1.exists("user_id");
		//query1.equalTo("doc_id", currentUser.id);
		//userQuery.include('booking');
		//userQuery.matchesQuery('user_id', bookingQuery);
		
		
		userQuery.find({
			success: function(schedules) {alert(schedules);
				for (var i = 0; i < schedules.length; i++)
					alert(schedules[i].get("username"));
			},
			error: function(object, error) {
			}
		});
	};
	Doc.initialize = function()
	{
		document.addEventListener("backbutton", Doc.backKeyDown, false);
		Doc.initJquery();
		Doc.InitFB();
	};
	Doc.backKeyDown = function()
	{
		navigator.app.exitApp();
	};
	Doc.getCurrentUserLoc = function()
	{
		if(navigator.geolocation)
		{		
			navigator.geolocation.getCurrentPosition(function(position)
			{
				myGeoLoc = new Parse.GeoPoint({latitude: position.coords.latitude, longitude: position.coords.longitude});
			}, function(){
				//handleNoGeolocation(true);
			});
		}
	};
	Doc.initParse = function()
	{
		Parse.initialize("SV7U73uAVhR6fn1IUR5OxPoa0fHBxyfQNk9NvJTA", "pZzaN8INyPr5UZuXHsPeoBRxuWZEmoGjwhjioCF2");
		Doc.getCurrentUserLoc();
		var geocoder;
		var map;
		currentUser = Parse.User.current();
		var currentLocation = '';
		if (currentUser)
		{
			
			var Doctor = Parse.Object.extend("doctors");
			var query = new Parse.Query(Doctor);
			query.equalTo("parent", currentUser);
			query.find({
				success: function(doctor) {
					Doc.hideLoader();
					//var id = doctor[0].id;
					if(doctor[0] && doctor[0].get('docmode'))
						Doc.goto('doctor.html#my-clinic');
					else
					{
						//Doc.loadScript();
						Doc.goto('#search-home');
					}
					if (typeof currentUser.get("avatar") != 'undefined')
					{
						var profilePhoto = currentUser.get("avatar");
						$('.avatar').prop('src', profilePhoto.url());
					}
				},
				error: function(object, error) {
					Doc.hideLoader();
					alert('Error');
				}
			});
		}
		else
		{
			window.location.href = '#home';
			Doc.hideLoader();
		}
	};
	Doc.onAvatarSuccess = function(imageData)
	{
		Doc.showLoader();
		var base64 = imageData;
		var parseFile = new Parse.File("photo.jpg", { base64: base64 });
		parseFile.save().then(function() {
			currentUser.set("avatar", parseFile);
			currentUser.save(null, {
			  success: function(gameScore) {
				currentUser = Parse.User.current();
				var profilePhoto = currentUser.get("avatar");
				$('.avatar').prop('src', profilePhoto.url());
				Doc.hideLoader();
			  }
			});
		}, function(error) {
			alert(error);
		});
	};
	
	Doc.onAvatarFail = function(message)
	{
		alert('Failed because: ' + message);
	};
	
	Doc.updateAvatar = function()
	{
		navigator.camera.getPicture(Doc.onAvatarSuccess, Doc.onAvatarFail, { quality: 50,
			destinationType: Camera.DestinationType.DATA_URL,
			sourceType : Camera.PictureSourceType.PHOTOLIBRARY
		});
	};
	Doc.registerAvatar = function()
	{
		navigator.camera.getPicture(Doc.saveRAvatarSuccess, Doc.onAvatarFail, { quality: 50,
			destinationType: Camera.DestinationType.DATA_URL,
			sourceType : Camera.PictureSourceType.PHOTOLIBRARY
		});
	};
	Doc.saveRAvatarSuccess = function(imageData)
	{
		Doc.showLoader();
		var base64 = imageData;
		var parseFile = new Parse.File("photo.jpg", { base64: base64 });
		parseFile.save().then(function() {
			$('#create-clinic-avatar').prop('src', "data:image/jpeg;base64," + imageData);
			registerUserAvatar = parseFile;
			Doc.hideLoader();
		}, function(error) {
			alert(error);
		});
	};
	Doc.iniCliniSearch = function(ele)
	{
		if(searchType == 'problem')
		{
			var availableTags = [];
			var Tags = Parse.Object.extend("problems");
			var query = new Parse.Query(Tags);
			query.find({
				success: function(tags) {
					for (var i = 0; i < tags.length; i++)
					{
						availableTags.push(tags[i].get("problem"));
					}
					$('#'+ele).autocomplete({
						source: availableTags,
						select: function( event, ui ) {
							document.getElementById(ele).value = ui.item.value;
							$('#search-d-btn').click();
						}
					});
				},
				error: function(object, error) {
				}
			});
		}
		else
		{
			document.getElementById(ele).value = '';
			$('#search-list #address').empty();
			var availableTags = [];
			var Tags = Parse.Object.extend("clinic");
			var query = new Parse.Query(Tags);
			query.near("location", myGeoLoc);
			query.find({
				success: function(tags) {
					var dataList = $("#datalist");
					dataList.empty();
					for (var i = 0; i < tags.length; i++)
					{
						availableTags.push(tags[i].get("name")+' - '+parseFloat(Math.round((tags[i].get("location").kilometersTo(myGeoLoc)) * 100) / 100).toFixed(1)+' KM');
					}
					$('#'+ele).autocomplete({
					  source: availableTags,
					  select: function( event, ui ) {
							document.getElementById(ele).value = ui.item.value.substr(0, ui.item.value.lastIndexOf(" -"));
							$('#search-d-btn').click();
						}
					});
				},
				error: function(object, error) {
				}
			});
			var Tags = Parse.Object.extend("doctor_list");
			var query = new Parse.Query(Tags);
			query.near("location", myGeoLoc);
			query.find({
				success: function(tags) {
					for (var i = 0; i < tags.length; i++)
					{
						availableTags.push(tags[i].get("name")+' - '+parseFloat(Math.round((tags[i].get("location").kilometersTo(myGeoLoc)) * 100) / 100).toFixed(1)+' KM');
					}
					$('#'+ele).autocomplete({
					  source: availableTags,
					  select: function( event, ui ) {
							document.getElementById(ele).value = ui.item.value.substr(0, ui.item.value.lastIndexOf(" -"));
							$('#search-d-btn').click();
						}
					});
				},
				error: function(object, error) {
				}
			});
			
		}
		
	};
	Doc.iniSpecSearch = function(ele)
	{
		var availableTags = [];
		var Tags = Parse.Object.extend("specialist");
		var query = new Parse.Query(Tags);
		query.find({
			success: function(tags) {
				var dataList = $("#datalist");
				dataList.empty();
				for (var i = 0; i < tags.length; i++)
				{
					availableTags.push(tags[i].get("name"));
				}
			},
			error: function(object, error) {
			}
		});
		$('#'+ele).autocomplete({
		  source: availableTags,
		  select: function( event, ui ) {
				document.getElementById(ele).value = ui.item.value;
				$('#search-s-btn').click();
			}
		});
	};
	Doc.login = function()
	{
		Doc.showLoader();
		var username = document.getElementById('username').value;
		var password = document.getElementById('password').value;
		Parse.User.logIn(username, password, {
			success: function(user) {
				currentUser = Parse.User.current();
				if (typeof currentUser.get("avatar") != 'undefined')
				{
					var profilePhoto = currentUser.get("avatar");
					$('.avatar').src = profilePhoto.url();
				}
				var Doctor = Parse.Object.extend("doctors");
				var query = new Parse.Query(Doctor);
				query.equalTo("parent", currentUser);
				query.find({
					success: function(doctor) {
						Doc.hideLoader();
						//var id = doctor[0].id;
						if(doctor[0] && doctor[0].get('docmode'))
							Doc.goto('doctor.html#my-clinic');
						else
						{
							//Doc.loadScript();
							Doc.goto('#search-home');
						}
					},
					error: function(object, error) {
						Doc.hideLoader();
						alert('Error');
					}
				});
		  },
		  error: function(user, error) {
			// The login failed. Check error to see why.
			alert("Error: " + error.code + " " + error.message);
			Doc.hideLoader();
			
		  }
		});
	};
	Doc.showError = function(error)
	{
		alert(error.message);
	};
	Doc.checkFbUser = function(id, email)
	{
		var FBUser = Parse.Object.extend("FBUser");
		var query = new Parse.Query(FBUser);
		query.equalTo("fb_id", id);
		query.equalTo("email", email);
		query.find({
			success: function(doctor) {
				if(doctor[0] && doctor[0].get('fb_id'))
				{
					Parse.User.logIn(doctor[0].get('fb_id'), doctor[0].get('fb_id'), {
						success: function(user) {
							currentUser = Parse.User.current();
							if (typeof currentUser.get("avatar") != 'undefined')
							{
								var profilePhoto = currentUser.get("avatar");
								$('.avatar').src = profilePhoto.url();
							}
							var Doctor = Parse.Object.extend("doctors");
							var query = new Parse.Query(Doctor);
							query.equalTo("parent", currentUser);
							query.find({
								success: function(doctor) {
									Doc.hideLoader();
									//var id = doctor[0].id;
									if(doctor[0] && doctor[0].get('docmode'))
										Doc.goto('doctor.html#my-clinic');
									else
									{
										//Doc.loadScript();
										Doc.goto('#search-home');
									}
								},
								error: function(object, error) {
									Doc.hideLoader();
									alert('Error');
								}
							});
					  },
					  error: function(user, error) {
						// The login failed. Check error to see why.
						alert("Error: " + error.code + " " + error.message);
						Doc.hideLoader();
						
					  }
					});
				}
				else
				{
					var FBUser = Parse.Object.extend("FBUser");
					var fbuser = new FBUser();
					fbuser.set("fb_id", id);
					fbuser.set("email", email);
					fbuser.save();
					var user = new Parse.User();
					user.set("username", id);
					user.set("password", id);
					user.set("email", email);
					user.signUp(null, {
					  success: function(user) {
						Parse.User.logIn(id, id, {
							success: function(user) {
								currentUser = Parse.User.current();
								if (typeof currentUser.get("avatar") != 'undefined')
								{
									var profilePhoto = currentUser.get("avatar");
									$('.avatar').src = profilePhoto.url();
								}
								var Doctor = Parse.Object.extend("doctors");
								var query = new Parse.Query(Doctor);
								query.equalTo("parent", currentUser);
								query.find({
									success: function(doctor) {
										Doc.hideLoader();
										//var id = doctor[0].id;
										if(doctor[0] && doctor[0].get('docmode'))
											Doc.goto('doctor.html#my-clinic');
										else
										{
											//Doc.loadScript();
											Doc.goto('#search-home');
										}
									},
									error: function(object, error) {
										Doc.hideLoader();
										alert('Error');
									}
								});
						  },
						  error: function(user, error) {
							// The login failed. Check error to see why.
							alert("Error: " + error.code + " " + error.message);
							Doc.hideLoader();
							
						  }
						});
					  },
					  error: function(user, error) {
						Doc.hideLoader();
						alert("Error: " + error.code + " " + error.message);
					  }
					});
				}
			},
			error: function(object, error) {
				Doc.hideLoader();
				alert('Error');
			}
		});
	};
	
	Doc.FBLogin = function()
	{
		Doc.showLoader();
		openFB.login('email',
		function() {
			openFB.api({
            path: '/me',
            success: function(data) {
				Doc.checkFbUser(data.id, data.email);
            },
            error: Doc.showError});
		},
		function(error) {
			alert('Facebook login failed: ' + error.error_description);
		});
//		Parse.FacebookUtils.logIn(null, {
//		  success: function(user) {
//			if (!user.existed()) {
//			  alert("User signed up and logged in through Facebook!");
//			} else {
//			  alert("User logged in through Facebook!");
//			}
//		  },
//		  error: function(user, error) {
//			alert("User cancelled the Facebook login or did not fully authorize.");
//		  }
//		});
	};
	Doc.signup = function()
	{
		Doc.showLoader();
		var username = document.getElementById('username1').value;
		var password = document.getElementById('password1').value;
		var email = document.getElementById('email').value;
		var dob = document.getElementById('dob').value;
		var gender = document.getElementById('gender').value;
		var phone = document.getElementById('phone').value;
		var country = document.getElementById('country').value;
		var city = document.getElementById('city').value;
		var user = new Parse.User();
		user.set("username", username);
		user.set("password", password);
		user.set("email", email);
		user.set("dob", dob);
		user.set("gender", gender);
		user.set("phone", phone);
		user.set("country", country);
		user.set("city", city);
		user.set("type", 1);
		user.set("avatar", registerUserAvatar);
		user.signUp(null, {
		  success: function(user) {
			navigator.notification.alert('Signup successfull!','','Success','Done');
			document.getElementById('username').value = username;
			document.getElementById('password').value = password;
			Doc.login();
			Doc.showSignin();
			Doc.hideLoader();
		  },
		  error: function(user, error) {
			Doc.hideLoader();
			alert("Error: " + error.code + " " + error.message);
		  }
		});

		
	};
	
	Doc.updateSearch = function(type)
	{
		searchType = type;
		if(searchType == 'speciality')
		{
			Doc.showLoader();
			$('#geocodeInput2').prop('placeholder', 'Type your speciality');
			var Tags = Parse.Object.extend("specialist");
			var query = new Parse.Query(Tags);
			query.find({
				success: function(tags) {
					var specialityCon = '';
					var availableTags = [];
					for (var i = 0; i < tags.length; i++)
					{
						specialityCon += '<div class="clinic-link"><a class="clinic-link-arrow" href="#speciality-detail" onclick="Doc.showSpecialityDetails(\''+tags[i].id+'\')" data-transition="fade">'+tags[i].get("name")+'</a></div>';
						availableTags.push(tags[i].get("name"));
					}
					$('#geocodeInput2').autocomplete({
					  source: availableTags,
					  select: function( event, ui ) {
							document.getElementById('geocodeInput2').value = ui.item.value;
							$('#search-s-btn').click();
						}
					});
					document.getElementById('speciality-list').innerHTML = specialityCon;
					Doc.hideLoader();
				},
				error: function(object, error) {
				}
			});
		}
		else if(searchType == 'clinic' || searchType == 'hospital')
		{
			if(searchType == 'clinic')
				$('#geocodeInput1').prop('placeholder', 'Type your clinic name');
			if(searchType == 'hospital')
				$('#geocodeInput1').prop('placeholder', 'Type your hospital name');
			Doc.iniCliniSearch('geocodeInput1');
		}
		else if(searchType == 'problem')
		{
			$('#geocodeInput1').prop('placeholder', 'Type your problem (eg:stomach pain)');
			Doc.iniCliniSearch('geocodeInput1');
		}
	};
	
	Doc.showSpecialityDetails = function(id)
	{
		Doc.showLoader();
		var Doctor = Parse.Object.extend("specialist");
		var query = new Parse.Query(Doctor);
		query.get(id, {
			success: function(clinic) {
				document.getElementById('speciality-title').style.display = 'block';
				document.getElementById('speciality-desc').style.display = 'block';
				$('#speciality-desc').text(clinic.get('desc'));
				$('#speciality-title').text(clinic.get('name'));
				var searchQuery = Parse.Object.extend("doctors");
				var query = new Parse.Query(searchQuery);
				query.equalTo("specialist", clinic.get('name'));

				query.include("parent");
				var searchLength = 0;
				$('#speciality-details-doctor').empty();
				//Query to get list of doctors
				query.find({
					success: function(data)
					{
						Doc.showLoader();
						$('#speciality-detail .specialit-srch-res span').text(data.length + searchLength);
						searchLength = data.length + searchLength;
						var doctorHtml = '';
						
						for (var i = 0; i < data.length; i++)
						{
							
							
							
							
							var docAvatar = 'images/avatar.jpg';
							if (typeof data[i].get("parent").get("avatar") != 'undefined')
								docAvatar = data[i].get("parent").get("avatar").url();
							var docParId = data[i].get("parent").id;
							var docId = data[i].id;
							var docName = data[i].get("name").substring(0, 24);
							var Role = Parse.Object.extend("role");
							var query = new Parse.Query(Role);
							query.include("parent");
							var User = Parse.Object.extend("User");
							var user = new User();
							user.id = data[i].get("parent").id;
							query.equalTo("user_id", user);
							var Clinic = Parse.Object.extend("clinic");
							var innerQuery = new Parse.Query(Clinic);
							innerQuery.near("location", myGeoLoc);
							query.matchesQuery("parent", innerQuery);
							query.find({
								success: function(data1)
								{
									if (data1[0] && typeof data1[0].get("parent").get("location") != 'undefined')
										doctorHtml = '<div class="clinic-link"><div class="clinic-link-arrow"><img src="'+docAvatar+'"/><div class="doc-name">Dr. '+docName+'<br/><span>Ent</span></div><div class="doc-list-r"><input type="button" class="accept-btn" value="Book" data-role="none" onclick="Doc.bookDoctorPage(\''+docId+'\',\''+docParId+'\')"/><span>'+parseFloat(Math.round((data1[0].get("parent").get("location").kilometersTo(myGeoLoc)) * 100) / 100).toFixed(1)+' KM</span></div></div></div>';
									else
										doctorHtml = '<div class="clinic-link"><div class="clinic-link-arrow"><img src="'+docAvatar+'"/><div class="doc-name">Dr. '+docName+'<br/><span>Ent</span></div><input type="button" class="accept-btn" value="Book" data-role="none" onclick="Doc.bookDoctorPage(\''+docId+'\',\''+docParId+'\')"/></div></div>';
									$('#speciality-details-doctor').append(doctorHtml);
								}
							});
						
						}
						Doc.hideLoader();
					},
					error: function(error) {
						alert(error);
					}
				});
				var searchQuery = Parse.Object.extend("doctor_list");
				var query = new Parse.Query(searchQuery);
				query.equalTo("specialist", clinic.get('name'));
				query.near("location", myGeoLoc);
				query.find({
					success: function(data)
					{
						Doc.showLoader();
						$('#speciality-detail .specialit-srch-res span').text(data.length + searchLength);
						searchLength = data.length + searchLength;
						for (var i = 0; i < data.length; i++)
						{
							if (typeof data[i].get("location") != 'undefined')
								doctorHtml = '<div class="clinic-link"><div class="clinic-link-arrow"><img src="images/avatar.jpg"/><div class="doc-name">'+data[i].get("name").substring(0, 24)+'<br/><span>Ent</span></div><div class="doc-list-r"><a href="#manual-doctor" data-transition="fade" onclick="Doc.showManualDoctor(\''+data[i].id+'\')"><input type="button" class="accept-btn" value="View" data-role="none")"/></a><span>'+parseFloat(Math.round((data[i].get("location").kilometersTo(myGeoLoc)) * 100) / 100).toFixed(1)+' KM</span></div></div></div>';
							else
								doctorHtml = '<div class="clinic-link"><div class="clinic-link-arrow"><img src="images/avatar.jpg"/><div class="doc-name">'+data[i].get("name").substring(0, 24)+'<br/><span>Ent</span></div><a href="#manual-doctor" data-transition="fade" onclick="Doc.showManualDoctor(\''+data[i].id+'\')"><input type="button" class="accept-btn" value="View" data-role="none")"/></a></div></div>';
							$('#speciality-details-doctor').append(doctorHtml);
						}
						
						// get doctors which location does not exist
						var searchQuery = Parse.Object.extend("doctor_list");
						var query = new Parse.Query(searchQuery);
						query.equalTo("specialist", clinic.get('name'));
						query.doesNotExist("location");
						query.find({
							success: function(data)
							{
								Doc.showLoader();
								$('#speciality-detail .specialit-srch-res span').text(data.length + searchLength);
								searchLength = data.length + searchLength;
								for (var i = 0; i < data.length; i++)
								{
									if (typeof data[i].get("location") != 'undefined')
										doctorHtml = '<div class="clinic-link"><div class="clinic-link-arrow"><img src="images/avatar.jpg"/><div class="doc-name">'+data[i].get("name").substring(0, 24)+'<br/><span>Ent</span></div><div class="doc-list-r"><a href="#manual-doctor" data-transition="fade" onclick="Doc.showManualDoctor(\''+data[i].id+'\')"><input type="button" class="accept-btn" value="View" data-role="none")"/></a><span>'+parseFloat(Math.round((data[i].get("location").kilometersTo(myGeoLoc)) * 100) / 100).toFixed(1)+' KM</span></div></div></div>';
									else
										doctorHtml = '<div class="clinic-link"><div class="clinic-link-arrow"><img src="images/avatar.jpg"/><div class="doc-name">'+data[i].get("name").substring(0, 24)+'<br/><span>Ent</span></div><a href="#manual-doctor" data-transition="fade" onclick="Doc.showManualDoctor(\''+data[i].id+'\')"><input type="button" class="accept-btn" value="View" data-role="none")"/></a></div></div>';
									$('#speciality-details-doctor').append(doctorHtml);
								}
								
								Doc.hideLoader();
							},
							error: function(error) {
								alert(error);
							}
						});

					},
					error: function(error) {
						alert(error);
					}
				});
			},
			error: function(object, error) {
				  console.log(error);
			}
		});
	};
	
	Doc.bookDoctorPage = function(docId, id)
	{
		document.getElementById('book-form-id').reset();
		bookDoctor = id;
		bookDoctorId = docId;
		Doc.showLoader();
		var Doctor = Parse.Object.extend("doctors");
		var query = new Parse.Query(Doctor);
		query.get(docId, {
			success: function(clinic) {
				$('#doctor-book-name').html(clinic.get('name'));
				Doc.hideLoader();
				Doc.goto('#book-doctor');
			},
			error: function(object, error) {
				  console.log(error);
			}
		});
	};
	
	Doc.bookDoctor = function(id)
	{
		bookDoctor = id;
		Doc.showLoader();
		var Doctor = Parse.Object.extend("doctors");
		var query = new Parse.Query(Doctor);
		query.get(id, {
			success: function(clinic) {
				$('#doctor-book-name').html(clinic.get('name'));
				Doc.hideLoader();
			},
			error: function(object, error) {
				  console.log(error);
			}
		});
	};
	Doc.updateBookDetails = function()
	{
		var bookDate = document.getElementById('book-date').value;
		$('#book-doctor .address-hider').addClass('hide');
		var searchQuery = Parse.Object.extend("role");
		var query = new Parse.Query(searchQuery);
		var User = Parse.Object.extend("User");
		var user = new User();
		user.id = bookDoctor;
		query.equalTo("user_id", user);
		query.include('parent');
		query.find({
			success: function(data)
			{
				var dropdown = document.getElementById('clinic-type-info');
				for (i = 0; i < dropdown.length;  i++)
				{
				   if (dropdown.options[i].value != '0')
					 dropdown.remove(i);
				}
				for (var i = 0; i < data.length; i++)
				{
					var option = document.createElement("option");
					option.text = data[i].get('parent').get('name');
					option.value = data[i].get('parent').id;
					dropdown.add(option);
				}
				Doc.hideLoader();
				$('#book-doctor .place-hider').removeClass('hide');
			},
			error: function(error) {
				alert(error);
			}
		});
	};
	Doc.updateBookAdress = function()
	{
		Doc.showLoader();
		var id = document.getElementById('clinic-type-info').value;
		
		var Tags = Parse.Object.extend("doc_schedule");
		var query = new Parse.Query(Tags);
		var bookDate = document.getElementById('book-date').value;
		var Clinic = Parse.Object.extend("clinic");
		var clinic = new Clinic();
		clinic.id = id;
		query.equalTo("clinic", clinic);
		var User = Parse.Object.extend("User");
		var user = new User();
		user.id = bookDoctor;
		query.equalTo("doctor", user);
		var date = new Date(bookDate);
		query.equalTo("day", (date.getDay()+1)+"");
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
	Doc.confirmAppointment = function()
	{
		Doc.showLoader();
		var Bookings = Parse.Object.extend("bookings");
		var booking = new Bookings();
		var User = Parse.Object.extend("doctors");
		var user = new User();
		user.id = bookDoctorId;
		booking.set('doctor', user);
		var Clinic = Parse.Object.extend("clinic");
		var clinic = new Clinic();
		var clinicId = document.getElementById('clinic-type-info').value;
		clinic.id = clinicId;
		booking.set('clinic', clinic);
		var bookDate = document.getElementById('book-date').value;
		booking.set('date', bookDate);
		var clinicTime = document.getElementById('clinic-type-time').value;
		var Schedule = Parse.Object.extend("doc_schedule");
		var schedule = new Schedule();
		schedule.id = clinicTime;
		booking.set('schedule', schedule);
		booking.set('user', currentUser);
		booking.save(null, {
			success: function(gameScore) {
				var Notif = Parse.Object.extend("notification");
				var notif = new Notif();
				var User = Parse.Object.extend("User");
				var user = new User();
				user.id = bookDoctor;
				notif.set('from', currentUser);
				notif.set('to', user);
				var desc = currentUser.get('username')+' has booked an appointment';
				notif.set('desc', desc);
				notif.set('status', 0);
				notif.save();
				Doc.hideLoader();
				navigator.notification.alert('Booked successfully!',Doc.gotoBack,'Success','Done');
			},
			error: function(gameScore, error) {
				alert('Failed');
				Doc.hideLoader();
			}
		});
	};
	Doc.getMyAppointments = function()
	{
		Doc.showLoader();
		var searchQuery = Parse.Object.extend("bookings");
		var query = new Parse.Query(searchQuery);
		query.equalTo("user", currentUser);
		query.include('doctor');
		query.find({
			success: function(data)
			{
				var searchDoc = '';
				for (var i = 0; i < data.length; i++)
				{
					searchDoc += '<div class="clinic-link"><a class="clinic-link-arrow" href="#my-app-details" data-transition="fade" onclick="Doc.showMyAppoinments(\''+data[i].id+'\')">Dr. '+data[i].get("doctor").get('name').substring(0, 24)+'<span>'+data[i].get("doctor").get('specialist')+'</span></a></div>';
				}
				document.getElementById('my-app-list').innerHTML = searchDoc;
				Doc.hideLoader();
			},
			error: function(error) {
				alert(error);
			}
		});
	};
	Doc.showMyAppoinments = function(id)
	{
		Doc.showLoader();
		var Booking = Parse.Object.extend("bookings");
		var query = new Parse.Query(Booking);
		query.include('clinic');
		query.include('doctor');
		query.include('schedule');
		query.get(id, {
			success: function(data) {
				document.getElementById('app-patient-name').innerHTML = data.get('doctor').get('name');
				document.getElementById('app-patient-spec').innerHTML = data.get('doctor').get('specialist');
				var appDate = new Date(data.get('date'));
				document.getElementById('app-patient-date').innerHTML = 'App Date: '+appDate.getDate()+'-'+(appDate.getMonth()+1)+'-'+appDate.getFullYear();
				document.getElementById('app-patient-time').innerHTML = 'App Time: '+data.get('schedule').get('in_time')+' - '+data.get('schedule').get('out_time');
				document.getElementById('app-patient-addr').innerHTML = data.get('clinic').get('address');
				appClinicId = data.get('clinic').id;
				appDocId = data.get('doctor').id;
				var userId = data.get('doctor').get('parent').id;
				var User = Parse.Object.extend("User");
				var query = new Parse.Query(User);
				query.get(userId, {
					success: function(data) {
						document.getElementById('clinic-app-avatar').src = data.get('avatar').url();
					}
				});
				var Fav = Parse.Object.extend("favourite");
				var query = new Parse.Query(Fav);
				query.equalTo("user", currentUser);
				var Doctor = Parse.Object.extend("doctors");
				var doctor = new Doctor();
				doctor.id = appDocId;
				query.equalTo("doctor", doctor);
				$('.app-map-icon-bg').children('.app-fav-icon').removeClass('app-fav-gold-icon');
				query.find({
					success: function(data)
					{
						
						$('.app-map-icon-bg').children('.app-fav-icon').addClass('app-fav-gold-icon');
					},
					error: function(error) {
						alert(error);
					}
				});
				Doc.hideLoader();
			},
			error: function(object, error) {
				  console.log(error);
			}
		});
	};
	Doc.confirmAppShow = function()
	{
		$('#book-doctor .confirm-app-hider').removeClass('hide');
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
	Doc.showClinicDoc = function(id)
	{
		Doc.showLoader();
		var searchQuery = Parse.Object.extend("role");
		var query = new Parse.Query(searchQuery);
		var Clinic = Parse.Object.extend("clinic");
		var clinic = new Clinic();
		clinic.id = id;
		query.equalTo("parent", clinic);
		query.equalTo("role", "Doctor");
		document.getElementById('speciality-title').style.display = 'none';
		document.getElementById('speciality-desc').style.display = 'none';
		//Query to get list of doctors
		query.find({
			success: function(data)
			{
				
				var searchQuery = Parse.Object.extend("doctors");
				var query = new Parse.Query(searchQuery);
				for (var i = 0; i < data.length; i++)
				{
					var User = Parse.Object.extend("User");
					var user = new User();
					user.id = data[i].get("user_id").id;
					query.equalTo("parent", user);
					
				}
				query.include('parent');
				query.find({
					success: function(data)
					{
						$('#speciality-detail .specialit-srch-res span').text(data.length);
						var doctorHtml = '';
						$('#speciality-details-doctor').empty();
						for (var i = 0; i < data.length; i++)
						{
							if (typeof data[i].get("parent").get("avatar") != 'undefined')
								doctorHtml = '<div class="clinic-link"><div class="clinic-link-arrow"><img src="'+data[i].get("parent").get("avatar").url()+'"/><div class="doc-name">Dr. '+data[i].get("name").substring(0, 24)+'<br/><span>Ent</span></div><input type="button" class="accept-btn" value="Book" data-role="none" onclick="Doc.bookDoctorPage(\''+data[i].id+'\',\''+data[i].get("parent").id+'\')"/></div></div>';
							else
								doctorHtml = '<div class="clinic-link"><div class="clinic-link-arrow"><img src=""/><div class="doc-name">Dr. '+data[i].get("name").substring(0, 24)+'<br/><span>Ent</span></div><input type="button" class="accept-btn" value="Book" data-role="none" onclick="Doc.bookDoctorPage(\''+data[i].id+'\',\''+data[i].get("parent").id+'\')"/></div></div>';
							$('#speciality-details-doctor').append(doctorHtml);
						}
						Doc.hideLoader();
					},
					error: function(error) {
						alert(error);
					}
				});
				Doc.hideLoader();
			},
			error: function(error) {
				alert(error);
			}
		});
	};
	
	Doc.showManualDoctor = function(id)
	{
		manDocId = id;
		Doc.showLoader();
		var User = Parse.Object.extend("doctor_list");
		var query = new Parse.Query(User);
		query.get(id, {
			success: function(data) {
				$('#man-app-doc-name').html(data.get('name'));
				$('#man-app-doc-spec').html(data.get('specialist'));
				
				$('#man-app-doc-addr').html(data.get('address'));
				$('#doc-manual-map-show').hide()
				if (typeof data.get("location") != 'undefined')
				{
					$('#doc-manual-map-show').show();
					$('#man-app-doc-loc').html(parseFloat(Math.round((data.get("location").kilometersTo(myGeoLoc)) * 100) / 100).toFixed(1)+' KM from here.');
				}
				$('#man-app-doc-phone').html('-');
				$('#man-app-doc-call').parent().hide();
				if(data.get('phone'))
				{
					$('#man-app-doc-phone').html(data.get('phone'));
					$('#man-app-doc-call').parent().show();
					$('#man-app-doc-call').attr('href', 'tel:'+data.get('phone'));
				}
				Doc.hideLoader();
			}
		});
	};
	
	Doc.loadDocManualMap = function()
	{
		Doc.showLoader();
		Doc.loadScript('Doc.showDocManualMap');
	};
	
	Doc.showDocManualMap = function()
	{
		var id = manDocId;
		var Doctor = Parse.Object.extend("doctor_list");
		var query = new Parse.Query(Doctor);
		query.get(id, {
			success: function(clinic) {
				var location = clinic.get('location');
				var mapOptions = {zoom: 15};
				map = new google.maps.Map(document.getElementById('clinic-map-canvas'), mapOptions);
				var infowindow = new google.maps.InfoWindow({content: 'You are here'});
				var pos = new google.maps.LatLng(myGeoLoc.latitude, myGeoLoc.longitude);
				marker = new google.maps.Marker({position: pos, map: map});
				infowindow.open(map,marker);
				var image12 = 'images/pin.png';
				var pos1 = new google.maps.LatLng(location.latitude, location.longitude);
				var infowindow = new google.maps.InfoWindow({content: clinic.get('name')});
				marker = new google.maps.Marker({position: pos1, map: map, icon: image12});
				infowindow.open(map,marker);
				map.setCenter(pos1);
				
				Doc.hideLoader();
			},
			error: function(object, error) {
				  console.log(error);
			}
		});
	};
	
	Doc.search = function(ele)
	{
		Doc.showLoader();
		if(searchType == 'speciality')
		{
			var searchText = document.getElementById(ele).value;
			document.getElementById('speciality-title').style.display = 'block';
			document.getElementById('speciality-desc').style.display = 'none';
			$('#speciality-title').text(searchText);
			var searchQuery = Parse.Object.extend("doctors");
			var query = new Parse.Query(searchQuery);
			query.equalTo("specialist", searchText);
			query.include("parent");
			Doc.goto('#speciality-detail');
			var searchLength = 0;
			//Query to get list of doctors
			query.find({
				success: function(data)
				{
					Doc.showLoader();
					$('#speciality-detail .specialit-srch-res span').text(data.length + searchLength);
					searchLength = data.length + searchLength;
					var doctorHtml = '';
					$('#speciality-details-doctor').empty();
					for (var i = 0; i < data.length; i++)
					{
						var docAvatar = 'images/avatar.jpg';
							if (typeof data[i].get("parent").get("avatar") != 'undefined')
								docAvatar = data[i].get("parent").get("avatar").url();
						var docParId = data[i].get("parent").id;
						var docId = data[i].id;
						var docName = data[i].get("name").substring(0, 24);
						var Role = Parse.Object.extend("role");
						var query = new Parse.Query(Role);
						query.include("parent");
						var User = Parse.Object.extend("User");
						var user = new User();
						user.id = data[i].get("parent").id;
						query.equalTo("user_id", user);
						var Clinic = Parse.Object.extend("clinic");
						var innerQuery = new Parse.Query(Clinic);
						innerQuery.near("location", myGeoLoc);
						query.matchesQuery("parent", innerQuery);
						query.find({
							success: function(data1)
							{
								if (data1[0] && typeof data1[0].get("parent").get("location") != 'undefined')
									doctorHtml = '<div class="clinic-link"><div class="clinic-link-arrow"><img src="'+docAvatar+'"/><div class="doc-name">Dr. '+docName+'<br/><span>Ent</span></div><div class="doc-list-r"><input type="button" class="accept-btn" value="Book" data-role="none" onclick="Doc.bookDoctorPage(\''+docId+'\',\''+docParId+'\')"/><span>'+parseFloat(Math.round((data1[0].get("parent").get("location").kilometersTo(myGeoLoc)) * 100) / 100).toFixed(1)+' KM</span></div></div></div>';
								else
									doctorHtml = '<div class="clinic-link"><div class="clinic-link-arrow"><img src="'+docAvatar+'"/><div class="doc-name">Dr. '+docName+'<br/><span>Ent</span></div><input type="button" class="accept-btn" value="Book" data-role="none" onclick="Doc.bookDoctorPage(\''+docId+'\',\''+docParId+'\')"/></div></div>';
								$('#speciality-details-doctor').append(doctorHtml);
							}
						});
						
					}
					Doc.hideLoader();
				},
				error: function(error) {
					alert(error);
				}
			});
			var searchQuery = Parse.Object.extend("doctor_list");
			var query = new Parse.Query(searchQuery);
			query.equalTo("specialist", searchText);
			query.find({
				success: function(data)
				{
					Doc.showLoader();
					$('#speciality-detail .specialit-srch-res span').text(data.length + searchLength);
					searchLength = data.length + searchLength;
					for (var i = 0; i < data.length; i++)
					{
						doctorHtml = '<div class="clinic-link"><div class="clinic-link-arrow"><img src="images/avatar.jpg"/><div class="doc-name">'+data[i].get("name").substring(0, 24)+'<br/><span>Ent</span></div><a href="#manual-doctor" data-transition="fade" onclick="Doc.showManualDoctor(\''+data[i].id+'\')"><input type="button" class="accept-btn" value="View" data-role="none")"/></a></div></div>';
						$('#speciality-details-doctor').append(doctorHtml);
					}
					Doc.hideLoader();
				},
				error: function(error) {
					alert(error);
				}
			});
			return false;
		}
		if(searchType == 'problem')
		{
			$('#search-list #address').empty();
			var searchText = document.getElementById(ele).value;
			var searchQuery = Parse.Object.extend("problems");
			var query = new Parse.Query(searchQuery);
			query.equalTo("problem", searchText);
			query.find({
				success: function(data)
				{
					var searchQuery = Parse.Object.extend("clinic");
					var query = new Parse.Query(searchQuery);
					query.equalTo('specialist', data[0].get('specialist'));
					query.find({
						success: function(data)
						{
							Doc.showLoader();
							var searchDoc = '';
							for (var i = 0; i < data.length; i++)
							{
								searchDoc += '<div class="clinic-link"><a class="clinic-link-arrow" href="#speciality-detail" data-transition="fade" onclick="Doc.showClinicDoc(\''+data[i].id+'\')">'+data[i].get("name").substring(0, 24)+'<span>'+data[i].get("type")+'</span></a></div>';
							}
							$('#search-list #address').append(searchDoc);
							Doc.hideLoader();
						},
						error: function(error) {
							alert(error);
						}
					});
					var searchQuery = Parse.Object.extend("doctor_list");
					var query = new Parse.Query(searchQuery);
					query.equalTo('specialist', data[0].get('specialist'));
					query.near("location", myGeoLoc);
					//Query to get list of doctors
					query.find({
						success: function(data)
						{
							Doc.showLoader();
							var searchDoc = '';
							for (var i = 0; i < data.length; i++)
							{
								if (typeof data[i].get("location") != 'undefined')
									searchDoc += '<div class="clinic-link"><a class="clinic-link-arrow" href="#manual-doctor" data-transition="fade" onclick="Doc.showManualDoctor(\''+data[i].id+'\')">'+data[i].get("name").substring(0, 24)+'<span>'+data[i].get("specialist")+'<span>'+parseFloat(Math.round((data[i].get("location").kilometersTo(myGeoLoc)) * 100) / 100).toFixed(1)+' KM</span></span></a></div>';
								else
									searchDoc += '<div class="clinic-link"><a class="clinic-link-arrow" href="#manual-doctor" data-transition="fade" onclick="Doc.showManualDoctor(\''+data[i].id+'\')">'+data[i].get("name").substring(0, 24)+'<span>'+data[i].get("specialist")+'</span></a></div>';
							}
							$('#search-list #address').append(searchDoc);
							Doc.hideLoader();
						},
						error: function(error) {
							alert(error);
						}
					});
				},
				error: function(error) {
					alert(error);
				}
			});
			
			return false;
		}
		if(searchType == 'clinic' || searchType == 'hospital')
		{
			$('#search-list #address').empty();
			var searchText = document.getElementById(ele).value;
			var searchQuery = Parse.Object.extend("clinic");
			var query = new Parse.Query(searchQuery);
			query.equalTo("name", searchText);
			if(searchType == 'hospital')
				query.equalTo('type', 'Hospital');
			//Query to get list of doctors
			query.find({
				success: function(data)
				{
					
					var searchDoc = '';
					for (var i = 0; i < data.length; i++)
					{
						searchDoc += '<div class="clinic-link"><a class="clinic-link-arrow" href="#speciality-detail" data-transition="fade" onclick="Doc.showClinicDoc(\''+data[i].id+'\')">'+data[i].get("name").substring(0, 24)+'<span>'+data[i].get("type")+'</span></a></div>';
					}
					$('#search-list #address').append(searchDoc);
					Doc.hideLoader();
				},
				error: function(error) {
					alert(error);
				}
			});
			var searchQuery = Parse.Object.extend("doctor_list");
			var query = new Parse.Query(searchQuery);
			query.equalTo("name", searchText);
			//Query to get list of doctors
			query.find({
				success: function(data)
				{
					var searchDoc = '';
					for (var i = 0; i < data.length; i++)
					{
						searchDoc += '<div class="clinic-link"><a class="clinic-link-arrow" href="#manual-doctor" data-transition="fade" onclick="Doc.showManualDoctor(\''+data[i].id+'\')">'+data[i].get("name").substring(0, 24)+'<span>'+data[i].get("specialist")+'</span></a></div>';
					}
					$('#search-list #address').append(searchDoc);
					Doc.hideLoader();
				},
				error: function(error) {
					alert(error);
				}
			});
			return false;
		}
	};
	
	Doc.showClinicInMap = function(data)
	{
								var prev_marker = '';
								var infowindow = Array();
								for (var i = 0; i < data.length; i++)
								{
									
									//Placing markers in map
									var userGeoPoint = data[i].get("location");
									marker = new google.maps.Marker({position: new google.maps.LatLng(userGeoPoint.latitude, userGeoPoint.longitude), map: map});
									 var contentString = '<div id="content">'+
									  '<b>'+data[i].get("name")+'</b>'+
									  '<div id="bodyContent">'+
									  ''+data[i].get("address")+''+
									  '</div>'+
									  '</div>';
									infowindow[i] = new google.maps.InfoWindow({
										content: contentString
									});
									google.maps.event.addListener(marker, 'click', (function(marker, i) {
										return function() {
											infowindow[i].open(map,marker);
											var new_marker = marker;
											if(prev_marker)
											{
											  if(prev_marker.getAnimation() != null)
											  {
												  prev_marker.setAnimation(null);                               
												  new_marker.setAnimation(google.maps.Animation.BOUNCE);
												  prev_marker = new_marker;
											  }
											}
											else
											{
											  new_marker.setAnimation(google.maps.Animation.BOUNCE);
											  prev_marker = new_marker;
											}
										}
									})(marker, i));
								}
								Doc.hideLoader();
	};
	
	
	
	Doc.showDetails = function(id)
	{
		document.getElementById('doctor-name').innerHTML = doctor[id].get("name");
		document.getElementById('doctor-address').innerHTML = doctor[id].get("address");
		window.location.href = '#doctor-details';
		
	};
	
	Doc.showSchedule = function(id)
	{
		window.location.href = '#schedule';
	};
	
	Doc.showMapView = function()
	{
		window.location.href = '#main';
	};
	Doc.showListView = function()
	{
		window.location.href = '#map';
	}
	Doc.fillDocProfile = function(ele)
	{
		if(ele.checked)
		{
			Doc.setElement('country1', currentUser.get("country"));
			Doc.setElement('city1', currentUser.get("city"));
			Doc.setElement('phone1', currentUser.get("phone"));
			Doc.setElement('email1', currentUser.get("email"));
		}
		else
		{
			Doc.setElement('country1', '');
			Doc.setElement('city1', '');
			Doc.setElement('phone1', '');
			Doc.setElement('email1', '');
		}
	};
	Doc.checkDocReg = function()
	{
		Doc.showLoader();
		var user = Parse.User.current();
		var Doctor = Parse.Object.extend("doctors");
		var doctorQuery = new Parse.Query(Doctor);
		doctorQuery.equalTo("parent", user);
		doctorQuery.find({
			success: function(data) {
				Doc.hideLoader();
				if(data.length == 0)
					Doc.fillSpeciality();
				else
				{
					var approved = data[0].get('approved');
					if(approved == 0)
						Doc.goto('#doctor-pending-approval');
					else if(approved == 1)
					{
						Doc.goto('#doctor-mode-setting');
						Doc.setElement('doc-mode-mobile', data[0].get('mobile'));
						Doc.setElement('doc-mode-email', data[0].get('email'));
						document.getElementById('doctor-id').innerHTML = currentUser.id;
						document.getElementById('doc-ful-name').innerHTML = data[0].get('name');
						document.getElementById('doc-spec').innerHTML = data[0].get('email');
					}
				}
			}
		});
	};
	Doc.fillSpeciality = function()
	{
		Doc.goto('#join-doctor');
		Doc.showLoader();
		var searchQuery = Parse.Object.extend("specialist");
		var query = new Parse.Query(searchQuery);
		query.find({
			success: function(data)
			{
				var select = document.getElementById('speciality');
				for (var i = 0; i < data.length; i++)
				{
					select.options[select.options.length] = new Option(data[i].get('name'), data[i].get('name'));
				}
				Doc.hideLoader();
			},
			error: function(error) {
				alert(error);
			}
		});
	};
	Doc.joinDoctor = function()
	{
		var User = Parse.User.current();
		var Doctor = Parse.Object.extend("doctors");
		var doctor = new Doctor();
		doctor.set('specialist', Doc.getElement('speciality').value);
		doctor.set('country', Doc.getElement('country1').value);
		doctor.set('city', Doc.getElement('city1').value);
		doctor.set('mobile', Doc.getElement('phone1').value);
		doctor.set('email', Doc.getElement('email1').value);
		doctor.set("parent", User);
		doctor.set("docmode", false);
		doctor.set("approved", 0);
		doctor.save();
		Doc.goto('#doctor-pending-approval');
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
				if(Doc.getElement('doc-mode-check').value == 'true')
				{
					doctor.set("docmode", true);
					Doc.goto('doctor.html#my-clinic');
				}
				else
					Doc.goto('#setting');
				doctor.save();
			},
			error: function(object, error) {
				Doc.hideLoader();
				alert('Error');
			}
		});
	};
	Doc.goto = function(url)
	{
		window.location.href = url;
	};
	Doc.loadClinicMap = function()
	{
		Doc.showLoader();
		Doc.loadScript('Doc.showCliMap');
	}
	
	Doc.showCliMap = function()
	{
		var id = appClinicId;
		var Doctor = Parse.Object.extend("clinic");
		var query = new Parse.Query(Doctor);
		query.get(id, {
			success: function(clinic) {
				var location = clinic.get('location');
				var mapOptions = {zoom: 18};
				map = new google.maps.Map(document.getElementById('clinic-map-canvas'), mapOptions);
				marker = new google.maps.Marker({position: new google.maps.LatLng(location.latitude, location.longitude), map: map});
				var pos = new google.maps.LatLng(location.latitude, location.longitude);
				map.setCenter(pos);
				Doc.hideLoader();
			},
			error: function(object, error) {
				  console.log(error);
			}
		});
	};
	Doc.addtoFavourite = function(ele)
	{
		Doc.showLoader();
		var User = Parse.User.current();
		var Fav = Parse.Object.extend("favourite");
		var fav = new Fav();
		var Doctor = Parse.Object.extend("doctors");
		var doctor = new Doctor();
		doctor.id = appDocId;
		fav.set('doctor', doctor);
		fav.set('user', User);
		fav.save(null, {
			success: function(gameScore) {
				Doc.hideLoader();
				$(ele).children('.app-fav-icon').addClass('app-fav-gold-icon');
				navigator.notification.alert('Added to favourite list','','Success','Done');
			},
			error: function(gameScore, error) {
				alert('Failed');
				Doc.hideLoader();
			}
		});
	};
	Doc.getMyFavourites = function()
	{
		Doc.showLoader();
		var searchQuery = Parse.Object.extend("favourite");
		var query = new Parse.Query(searchQuery);
		query.equalTo("user", currentUser);
		query.include('doctor');
		query.find({
			success: function(data)
			{
				var searchDoc = '';
				for (var i = 0; i < data.length; i++)
				{
					searchDoc += '<div class="clinic-link"><a class="clinic-link-arrow" href="#favourites-details" data-transition="fade" onclick="Doc.showMyFavourites(\''+data[i].id+'\')">Dr. '+data[i].get("doctor").get('name').substring(0, 24)+'<span>'+data[i].get("doctor").get('specialist')+'</span></a></div>';
				}
				document.getElementById('my-fav-list').innerHTML = searchDoc;
				Doc.hideLoader();
			},
			error: function(error) {
				alert(error);
			}
		});
	};
	Doc.showMyFavourites = function(id)
	{
		$('.star12').rating();
		$('.star123').rating();
		Doc.showLoader();
		var Favourite = Parse.Object.extend("favourite");
		var query = new Parse.Query(Favourite);
		query.include('doctor');
		query.get(id, {
			success: function(data) {
				document.getElementById('app-doc-name').innerHTML = data.get('doctor').get('name');
				document.getElementById('app-doc-spec').innerHTML = data.get('doctor').get('specialist');
				var userId = data.get('doctor').get('parent').id;
				var User = Parse.Object.extend("User");
				var query = new Parse.Query(User);
				query.get(userId, {
					success: function(data) {
						document.getElementById('fav-app-avatar').src = data.get('avatar').url();
					}
				});
				
				Doc.hideLoader();
			},
			error: function(object, error) {
				  console.log(error);
			}
		});
	};
	Doc.showHideMenu = function()
	{
		$('.menu').fadeToggle();
	};
	Doc.showShareDialog = function()
	{
		shareWindow = window.open('https://www.facebook.com/dialog/feed?%20app_id=400201633456132%20&name=Mohan Doc&display=popup&description=dfdf dfd fdf&caption=test&link=https%3A%2F%2Fdevelopers.facebook.com%2Fdocs%2F%20&redirect_uri=https://www.facebook.com/connect/login_success.html', '_blank', 'location=no');
		shareWindow.addEventListener('loadstart', Doc.loginWindowLoadStart);
		shareWindow.addEventListener('exit', Doc.loginWindowExit);
	};
	Doc.loginWindowLoadStart = function(event)
	{
		var url = event.url;
		if (url.indexOf("post_id=") > 0 || url.indexOf("_=_") > 0)
			shareWindow.close();
	};
	Doc.loginWindowExit = function()
	{
		shareWindow.removeEventListener('loadstop', loginWindowLoadStart);
		shareWindow.removeEventListener('exit', loginWindowExit);
		shareWindow = null;
	}
}(this));
document.addEventListener('deviceready', Doc.initialize(), false);
var doctor = Array();