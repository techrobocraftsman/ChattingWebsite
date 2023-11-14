(function($){
jQuery(document).ready(function(){

function changed(person){
	var second_person = person.children(".choice").attr('value');
	var second_img = person.children(".pic").children("img").attr('src');
	var id2 = person.children(".choice").attr('userid');
	$.ajax({
		'url' : 'person_change.php',
		'type' : 'POST',
		'data' :{
			'second_person' : second_person,
			'id2' : id2,
			'second_img' : second_img,
			'person_change' : 'koro'
		},
		'success':function(output){
			$('body').append(output);
		}
	});
	jQuery('.friend-list .friends').removeClass('focused');
	person.addClass('focused');
	return false;
}

function button_info_update(person){
	var inbox_name = person.children(".choice").attr('value');
	var id2 = person.children(".choice").attr('userid');
	$.ajax({
		'url' : 'person_change.php',
		'type' : 'POST',
		'data' :{
			'button_info_update' : 'koro'
		},
		'success':function(output){
			$('button.btn').html(output);
		}
	});
	return false;
}
function inbox_info_update(person){
	var inbox_name = person.children(".choice").attr('value');
	var id2 = person.children(".choice").attr('userid');
	$.ajax({
		'url' : 'inbox_info_update.php',
		'type' : 'POST',
		'data' :{
			'inbox_info_update' : 'koro'
		},
		'success':function(output){
			$('.inbox-info').html(output);
			jQuery('.chat-area .back').click(function(){
				$('.chat-area').animate({
					'opacity' : '0'
				},300);
				setTimeout(function(){
					$('.chat-area').hide();
				},600)
				$('.friend-list').show();
				$('.user-info').show();	
			});
		}
	});
	return false;
}

var height = $(window).height();
$('.friend-list, .squarebox .messages').height(height-200);

jQuery(window).resize(function(){
	var height = $(window).height();
	$('.friend-list, .squarebox .messages').height(height-200);
});

jQuery('.friend-list .friends').click(function(){
	changed(jQuery(this));
	button_info_update(jQuery(this));
	inbox_info_update(jQuery(this));
		$('.chat-area').show().animate({
			'opacity' : '1'
		},500);
		$('.friend-list').hide();
		$('.user-info').hide();	
	$.ajax({
		'url':'show_messages.php',
		'type' : 'POST',
		'data':{
			'updatehoise':''
		},
		'success':function(output){
			$('.squarebox .messages').html(output);
		}
	});
});


$('.chatform .form-control').focus(function(){
	$(this).attr('id' , 'focused');
});
$('.chatform .form-control').blur(function(){
	if($(this).val() == ''){$(this).attr('id' , '');}
	else $(this).attr('id' , 'blured');
});

jQuery('.chatform').submit(function(){
	var message = $('.chatform input[name=message]').val();
	var forbidden = /['\\]/g;
	if(!forbidden.test(message) && message != ' ' && message != ''){
		$.ajax({
			'url' : 'send_message.php',
			'type': 'POST',
			'data': {
				'message' : message,
				'chatupdate' : 'sent'
			},
			'success' : function(output){
				jQuery(".scrollable").scrollTop(0);
				$('.chatform input[name=message]').val('');
				$('.squarebox').append(output);
			//	location.reload();
			}
		});
		$.ajax({
			'url':'show_messages.php',
			'type' : 'POST',
			'data':{
				'updatehoise':''
			},
			'success':function(output){
				$('.squarebox .messages').html(output);
			}
		});
		$('.chatform .form-control').attr('id' , '');
	}
	else $('.chatform .form-control').attr('id' , 'alert');
	return false;
});

jQuery('.userregistration').submit(function(){

	var username = $('input[name=username]').val(),
	 	email = $('input[name=email]').val(),
		password = $('input[name=password]').val();
	var forbidden = /[\]\[!@#{}$%^&*(),.<?>/\-~\\`|'"]/g;
	var exists = forbidden.test(username);
	if(!exists){
	$.ajax({
		'url' : 'register.php',
		'type' : 'POST',
		'data' : {
			'reg' : 'hoise',
			'username' : username,
			'email' : email,
			'password' : password
		},
		'success' : function(output){
			$('.my-inputs').val('');
		}
	});
	$('.userregistration input').attr('id' , '');
	}else {
		$('.success').html('Forbidden charecter used in username');
		$('.userregistration input[name=username]').attr('id' , 'alert');
	}
});



jQuery('.userlogin').submit(function(){

	var email = $('input[name=email]').val(),
		password = $('input[name=password]').val();

	$.ajax({
		'url' : 'login.php',
		'type' : 'POST',
		'data' : {
			'login' : 'hoise',
			'email' : email,
			'password' : password
		},
		'success' : function(output){
		}
	});
	jQuery('.alert').toggle();
});
//	jQuery('.alert .btn-close').click();
var prev1,prev2;
setInterval(function(){

	$.ajax({
		'url':'checkdatabase.php',
		'type' : 'POST',
		'data':{
			'check_database':''
		},
		'success':function(output){
			prev1=output;
		}
	});
	if(prev1>prev2){
			jQuery(".scrollable").scrollTop(0);
		$.ajax({
			'url':'show_messages.php',
			'type' : 'POST',
			'data':{
				'updatehoise':''
			},
			'success':function(output){
				$('.squarebox .messages').html(output);
			}
		});
//	console.log(prev1);
	}
	prev2=prev1;
},1000);


});
}(jQuery))