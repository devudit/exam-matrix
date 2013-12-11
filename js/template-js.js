/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
/* Registration Ajax */
jQuery.noConflict();
(function ($) {
$('document').ready(function(){
	 $('#register-me').on('click',function(){
		 var action = 'register_action';
		 var username = $("#st-username").val();
		 var mail_id = $("#st-email").val();
		 var firname = $("#st-fname").val();
		 var lasname = $("#st-lname").val();
		 var passwrd = $("#st-psw").val();
                 var addr = $('#st-address').val();
	 
		var ajaxdata = {
			 action: 'register_action',
			 username: username,
			 mail_id: mail_id,
			 firname: firname,
			 lasname: lasname,
			 passwrd: passwrd,
                         address: addr,
		};
	 
		$.post( ajaxurl, ajaxdata, function(res){ // ajaxurl must be defined previously
                        if(res=='goToImageUpload'){
                            $('.user_registration_form').remove();
                            $('.avtar_upload').show();
                        }
			$("#error-message").html(res);
		});
	 });
});
})(jQuery)

