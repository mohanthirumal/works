function domOnLoadEvents()
{alert(1);
	$('.doc-clinic-app-user').on('click', function(){alert(2);
		var id = $(this).attr('rel');
		var Booking = Parse.Object.extend("bookings");
		var query = new Parse.Query(Booking);
		query.include('user');
		query.include('schedule');
		query.get(id, {
			success: function(data) {
				document.getElementById('doc-app-patient-name').value = data.get('user').get('username');
				document.getElementById('doc-app-patient-age').value = getAge(data.get('user').get('dob'));
				document.getElementById('doc-app-patient-gender').value = data.get('user').get('gender');
				document.getElementById('doc-app-patient-contact').value = data.get('user').get('phone');
				document.getElementById('doc-app-patient-date').value = data.get('date');
				document.getElementById('doc-app-patient-bid').value = data.id;
				document.getElementById('doc-clinic-app-patie-stat').value = data.get('status');
			},
			error: function(object, error) {
				  console.log(error);
			}
		});
	});
}
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