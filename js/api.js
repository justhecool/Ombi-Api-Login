function login()
{
		$('.active').show();
	$.ajax({

                type: "POST",
				data: $('#appLogin').serialize(),
				dataType: 'json',
                success: function(data) {
	                console.log(data);
					if (data.success == true){
						$('.active').hide();
						  var api_key = data.token;
						  localStorage.setItem('id_token', api_key);
						$(window).attr('location', data.url);
						//location.reload(true);
						//window.location.href =  "profile";
					}
					if (data.g_auth == true){
						$('.mini.modal').modal({
						    blurring: true,
						    closable: false,
						    onDeny : function(){
							   // $('#prov').val('');
								$('#password').val('');
								$('.active').hide();
						    },
						    onApprove: function(){
							    	//$('#prov').val('totp');
							    	login();
							    	//$('.mini.modal').close();
							    	$('.active').hide();
						    }
						  })
						  .modal('show')
						;
					}
					if (data.success == false){
						var u = data;
						$.ajax({
                type: "post",
                data: $('#appLogin').serialize()+'uname',
                dataType: 'json',
                success: function (data) {

                }
            });
						$('.active').hide();
					UIkit.notification({message: '<span uk-icon=\'icon: warning\'></span> '+ data.msg, pos: 'top-center', status:'danger'});


					}
					if (data.code == false){
						$('.mini.modal').modal({
						    blurring: true,
						    closable: false,
						    onDeny : function(){
							    $('#prov').val('');
								$('#mfacode').val('');
								$('.active').hide();
						    },
						    onApprove: function(){
							    	$('#prov').val('totp');
							    	login();
							    	$('.mini.modal').modal('close');
						    }
						  })
						  .modal('show')
						;
						UIkit.notification({message: '<span uk-icon=\'icon: warning\'></span> '+ data.msg, pos: 'bottom-left', status:'danger'});
}
					//console.log(data.success);

		        },
                 error: function(xhr, status, error) {
	                 $('.active').hide();
	                 UIkit.notification({message: '<span uk-icon=\'icon: warning\'></span> Request Timedout. Try again'+xhr.responseText, pos: 'top-center', status:'danger'});
	                 console.log(xhr);
	                 $('#result').append(xhr.responseText);
                }
            });

}


	$(document).ready(function() {
  $("#appRegister").validate({
	  rules: {
		  remail: {
			  required: true,
			  email:true,
			  remote: "check.php",

		  },
		  rusername: {
			  required: true,
			  minlength: 3,
			  remote: "check.php"
		  },
		  pwd: {
			  required: true,
			  minlength: 6
		  }

	  },
	  messages: {
		  rusername: {
			  minlength: "Username should be at least 3 characters",
			  remote: jQuery.validator.format("{0} is already in use!")
		  },
		  remail:{
			  email: "The email should be in the format: abc@domain.com",
			  remote: jQuery.validator.format("{0} is already in use!")
		  },
		  pwd: {
			  minlength: "Passwords should be at least 6 characters"
		  }
	  },
	  errorElement : 'label'
});
});




$('#appRegister').submit(function(event){
    event.preventDefault();
    if($('#appRegister').valid()){

			$('.active').show();

	$.ajax({

                type: "POST",
				data: $('#appRegister').serialize(),
				dataType: 'json',
                success: function(data) {
	                console.log(data);

if (data.success == true ){
	$('.active').hide();
	$(window).attr('location',data.url+permalink);

}

if (data.g_auth == true){
	$('.active').hide();

	openMfa();
	$('#prov').val('totp');
}
if (data.code == false){
	$('.code').append(data.message).slideDown("slow");
	setTimeout(function() { $('.code').slideUp();$('.code').empty();}, 5000);
}

if (data.success == false){
	$('.active').hide();
					UIkit.notification({message: '<span uk-icon=\'icon: warning\'></span> '+ data.msg, pos: 'bottom-left', status:'danger'});

}

	}
});
}
});
function isEmpty(obj) {
    for(var key in obj) {
        if(obj.hasOwnProperty(key))
            return false;
    }
    return true;
}
function forgot(){
	$('.active').show();
	$.ajax({

                type: "POST",
				data: $('#appForgot').serialize(),
				dataType: 'json',
                success: function(data) {
	                console.log(data);
					if (data.success == true){
						$('.active').hide();
UIkit.notification({message: '<span uk-icon=\'icon: check\'></span> '+ data.msg, pos: 'bottom-left', status:'success'});
						$('.login-box').show();
						$('.register-box').hide();
						$('.forgot-box').hide();
					}

	if (data.success == false){
						$('.active').hide();
					UIkit.notification({message: '<span uk-icon=\'icon: warning\'></span> '+ data.msg, pos: 'bottom-left', status:'danger'});
					}
					},

error: function(xhr, status, error) {
	                 console.log(xhr);
	                 $('#result').append(xhr.responseText);
                }
            });

}
$(document).on("click", ".info",function() {
	info();
	});

$(document).on("click", ".join",function() {
	$('.login-box').hide();
	$('.join-box').show();
	$('.forgot-box').hide();
});
$(document).on("click", ".login",function() {
	$('.login-box').show();
	$('.join-box').hide();
	$('.forgot-box').hide();
});
$(document).on("click", ".forgot",function() {
	$('.login-box').hide();
	$('.join-box').hide();
	$('.forgot-box').show();
});
	$("#appLogin").submit(function(e) {
    e.preventDefault();
});
$('#password-j').change(function() {
    $('#password').val($(this).val());
});
function terms(){
$('.terms.modal')
.modal({
    blurring: true
  })
  .modal('show')
;
}
$(document).ready(function(){$("#appJoin").validate({rules:{remail:{required:true,email:true},rusername:{required:true,minlength:2}},messages:{rusername:{minlength:"Names should be at least 2 characters"},remail:{email:"The email should be in the format: abc@domain.com"}},errorElement:'label'});});$('#appJoin').submit(function(event){event.preventDefault();if($('#appJoin').valid()){$('.active').show();$.ajax({type:"POST",data:$('#appJoin').serialize(),dataType:'json',success:function(data){console.log(data);if(data.success==true){msg();$('.active').hide();}
if(data.success==false){$('.active').hide();UIkit.notification({message:'<span uk-icon=\'icon: warning\'></span> '+data.msg,pos:'bottom-left',status:'danger'});}}});}});function msg(){$('.success-msg.modal').modal({blurring:true,closable:false}).modal('show');}



const base_url = window.location.origin;
$(function(){
   bg();
});
function bg()
{
	var backgrounds = base_url + '/requests/api/v1/Images/background/';
	 fetch(backgrounds).then((resp)=>resp.json()).then(function(data){
		 $('body').css('background-image','linear-gradient(-10deg, transparent 20%, rgba(0,0,0,0.7) 20.0%, rgba(0,0,0,0.7) 80.0%, transparent 80%), url('+data.url+')');
		 console.log(data.url);
		});
}
setInterval(bg, 25000);


  const token = localStorage.getItem('id_token');
 if (token != null){
  const decode = jwt_decode(token);
if (isAuthenticated() == true ){
	if (decode.role == "Admin"){
		 base_url = window.location.origin;
		$(window).attr('location', base_url + '/admin/');
	}
	else{
	$(window).attr('location', base_url + '/requests/discover');}
	}
	else {localStorage.clear();}
}
function isAuthenticated() {
  try {
    const { exp } = decode.exp;
    if (Date.now() >= exp * 1000) {
  return false;
}
  } catch (err) {
    return false;
  }
  return true;
}
