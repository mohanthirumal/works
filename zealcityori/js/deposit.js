if (typeof(zealdep)=='undefined')
{
	// We will recreate our joms namespace
	// with joms.jQuery pointing to their jQuery.
	zealdep = {
		jQuery: window.jQuery,
		extend: function(obj){
			this.jQuery.extend(this, obj);
		}
	}
}
zealdep.extend({
	deposit:{
		priceadd:function(id,amount){
			
			$(".depostContainnor-class").removeClass('hoverClassOne');
			$(".innerContainor-likeTwo").removeClass('hoverClassTwo');
			$("#dopsite-"+id).addClass('hoverClassOne');
			$("#dopsitetwo-"+id).addClass('hoverClassTwo');
			$('#productid').val(id);
			$('#depositAmountId').html('Deposit amount : '+amount);
		},
		uservalidate:function(){
			//var name =$('#fullname').val();
			//var email =$('#email').val();
			var address =$('#address').val();
			var state =$('#state').val();
			var country =$('#country').val();
			var city =$('#city').val();
			var pincode = $('#pincode').val();
			var mobileno = $('#mobileno').val();
			
			var msg = '';
			
			 if (/[^a-zA-Z0-9\-\ /]/.test(name))
				msg = 'Special characters not allowed in First name !';
			//else if(name.length == 0)
				//msg = 'First name are Require !';
			//else if(email.length == 0)
				//msg = 'Email are Require !';
			else if(mobileno.length == 0)
				msg = 'mobile no Required !';
			else if(country.length == 0)
				msg = 'country Required !';
			else if(state.length == 0)
				msg = 'state Required !';
			else if(city.length == 0)
				msg = 'city Required !';
			else if(address.length == 0)
				msg = 'address Required !';
			else if(/^[0-9\n ]*$/.test(mobileno) == false)
				msg = 'Mobile no  incorrect';
			else if(/^[0-9\n ]*$/.test(pincode) == false)
				msg = 'Pin code   incorrect';
			else if(mobileno.length > 0 && isNaN(mobileno))
				msg = 'Special characters not allowed in mobile number!';
			else if(pincode.length > 0 && isNaN(pincode))
				msg = 'Special characters not allowed in Pin code number!';
			else if(/^[a-zA-Z0-9-\n ]*$/.test(address) == false)
				msg = 'Special characters not allowed in address!';
			else if(/^[a-zA-Z0-9-\n ]*$/.test(country) == false)
				msg = 'Special characters not allowed in Country!';
			else if(/^[a-zA-Z0-9-\n ]*$/.test(state) == false)
				msg = 'Special characters not allowed in State!';
			else if(/^[a-zA-Z0-9-\n ]*$/.test(city) == false)
				msg = 'Special characters not allowed in City!';
			else if($('#productid').val() == 7 &&  $('#userAmount').val() < 100)
				msg = 'Deposit ammount should not be less dhan 100!';
			if(msg.length > 0)
			{
				alert(msg);
				return false;
			}
			return true;
		},
		userprice:function(){
			var amount = $('#userAmount').val();
			$('#depositAmountId').html('Deposit amount : '+amount);
			$('#productid').val(7);
		}
	}
});