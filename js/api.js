//Api
const base_url = window.location.origin;
const token = localStorage.getItem('id_token');

if (token != null) {
    var decode = jwt_decode(token);
      function isAuthenticated(decode) {
        try {
            var clockTime = Math.floor(Date.now() / 1000);
            if (clockTime >= decode.exp ) {
                return false;
            }
        } catch (err) {
            return false;
        }
        return true;
    }
    if (isAuthenticated(decode) === true) {
	    //user may have more roles than just Admin
	    if (Array.isArray(decode.role)){
		   if (decode.role.indexOf("Admin") > -1){
            $(window).attr('location', base_url + '/admin/');
		   }
            $(window).attr('location', base_url + '/requests/discover');
        }
        else {
            $(window).attr('location', base_url + '/requests/discover');
            // user only has 1 role?
        }
        if (decode.role === "Admin") {
            $(window).attr('location', base_url + '/admin/');
        }
    } else {
        localStorage.clear();
    }
    
}

function login() {
	$('.active').show();
    $.ajax({
        type: "POST",
        data: $('#appLogin').serialize(),
        dataType: 'json',
        timeout: 5000,
        cache: false,
        async: true,
        success: function (data) {
            console.log(data);
            if (data.success === true) {
                $('.active').hide();
                var api_key = data.token;
                var key = jwt_decode(api_key);

                localStorage.setItem('id_token', api_key);
             if (Array.isArray(key.role)){
		   if (key.role.indexOf("Admin") > -1){
            $(window).attr('location', base_url + '/admin/');
		   }
                 $(window).attr('location', base_url + '/requests/discover');
	    } else {
                 $(window).attr('location', base_url + '/requests/discover');
             }
        if (key.role === "Admin") {
            $(window).attr('location', base_url + '/admin/');
        }
                }
             if (data.success === false) {
	            $('.req-pw').slideToggle(); //Remove this if Ombi requires pw
                $('.active').hide();
                UIkit.notification({
                    message: '<span uk-icon=\'icon: warning\'></span> ' + data.msg,
                    pos: 'top-center',
                    status: 'danger'
                });
                	     
            }
            
        },
        error: function (xhr, status, error) {
            $('.active').hide();
            UIkit.notification({
                message: '<span uk-icon=\'icon: warning\'></span> Request Timeout, Please try again.',
                pos: 'top-center',
                status: 'danger'
            });
            console.log(xhr);
            $('#result').append(xhr.responseText);
        }
    });
}

$(document).ready(function () {
    $("#appRegister").validate({
        rules: {
            remail: {required: true, email: true},
            rusername: {required: true, minlength: 3},
            pwd: {required: true, minlength: 6}
        },
        messages: {
            rusername: {
                minlength: "Username should be at least 3 characters",
            },
            remail: {
                email: "The email should be in the format: abc@domain.com",
            },
            pwd: {minlength: "Passwords should be at least 6 characters"}
        },
        errorElement: 'label'
    });
});

function isEmpty(obj) {
    for (var key in obj) {
        if (obj.hasOwnProperty(key))
            return false;
    }
    return true;
}

function forgot() {
    $('.active').show();
    $.ajax({
        type: "POST", data: $('#appForgot').serialize(), dataType: 'json', success: function (data) {
            console.log(data);
            if (data.success === true) {
                $('.active').hide();
                UIkit.notification({
                    message: '<span uk-icon=\'icon: check\'></span> ' + data.msg,
                    pos: 'bottom-left',
                    status: 'success'
                });
                $('.login-box').show();
                $('.register-box').hide();
                $('.forgot-box').hide();
            }
            if (data.success === false) {
                $('.active').hide();
                UIkit.notification({
                    message: '<span uk-icon=\'icon: warning\'></span> ' + data.msg,
                    pos: 'bottom-left',
                    status: 'danger'
                });
            }
        }, error: function (xhr, status, error) {
            console.log(xhr);
            $('#result').append(xhr.responseText);
        }
    });
}

$(document).on("click", ".join", function () {
    $('.login-box').hide();
    $('.join-box').show();
    $('.forgot-box').hide();
});
$(document).on("click", ".login", function () {
    $('.login-box').show();
    $('.join-box').hide();
    $('.forgot-box').hide();
});
$(document).on("click", ".forgot", function () {
    $('.login-box').hide();
    $('.join-box').hide();
    $('.forgot-box').show();
});
$("#appLogin").submit(function (e) {
    e.preventDefault();
});
$('#password-j').change(function () {
    $('#password').val($(this).val());
});

function terms() {
    $('.terms.modal').modal({blurring: true}).modal('show');
}

$(document).ready(function () {
    $("#appJoin").validate({
        rules: {remail: {required: true, email: true}, rusername: {required: true, minlength: 2}},
        messages: {
            rusername: {minlength: "Names should be at least 2 characters"},
            remail: {email: "The email should be in the format: abc@domain.com"}
        },
        errorElement: 'label'
    });
});
$('#appJoin').submit(function (event) {
    event.preventDefault();
    if ($('#appJoin').valid()) {
        $('.active').show();
        $.ajax({
            type: "POST", data: $('#appJoin').serialize(), dataType: 'json', success: function (data) {
                console.log(data);
                if (data.success === true) {
                    msg();
                    $('.active').hide();
                }
                if (data.success === false) {
                    $('.active').hide();
                    UIkit.notification({
                        message: '<span uk-icon=\'icon: warning\'></span> ' + data.msg,
                        pos: 'bottom-left',
                        status: 'danger'
                    });
                }
            }
        });
    }
});

function msg() {
    $('.success-msg.modal').modal({blurring: true, closable: false}).modal('show');
}

function info() {
    $('.info-panel.modal').modal({blurring: true, closable: true}).modal('show');
}

$(document).on("click", ".info", function () {
    info();
});
function bg() {
    const backgrounds = base_url + '/requests/api/v1/Images/background/';
    fetch(backgrounds).then((resp) => resp.json()).then(function (data) {
        $('body').css('background-image', 'linear-gradient(-10deg, transparent 20%, rgba(0,0,0,0.7) 20.0%, rgba(0,0,0,0.7) 80.0%, transparent 80%), url(' + data.url + ')');
    });
}

setInterval(bg, 25000);

$(function () {
    bg();
    //UIkit.notification({message: '<span uk-icon=\'icon: info\'></span> This site is currently going through maintenance. Sorry for the inconvenience!', pos: 'top-left', status:'warning', timeout: 0});
});

