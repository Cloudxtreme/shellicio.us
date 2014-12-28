$(document).ready(function() {

	$('.getCredentials').click( function() {  
		//$.modal.close();
		//$('#getCredentialsPage').modal({
			//minHeight: '480',
			//minWidth: '80%',
			//position: ["70px"]
		//});
		//$('.simplemodal-container').corner('30px');
		window.location = '#signupSection';
		$('#signupSection').slideDown(1000);
	});
	$('.TermsOfUseButton').click( function() {  
		$.modal.close();
		$('#TermsOfUse').modal({
			position: ["70px"]
		});
		$('.simplemodal-container').corner('30px');		
	});	
	$('.PrivacyPolicyButton').click( function() {  
		$.modal.close();
		$('#PrivacyPolicy').modal({
			position: ["70px"]
		});
		$('.simplemodal-container').corner('30px');		
	});	
	$('.terminalModalButton').click( function() {  
		//$.modal.close();
		$('.simplemodal-container').css('display','block');
		$('#terminalModal').slideDown().show();	
		$('#simplemodal-overlay').show();
		$('#terminalModal').modal({
			minHeight: '500',
			minWidth: '80%',
			position: ["70px"],
			persist: 'true',
			onClose: function (dialog) {
				dialog.data.fadeOut(1000, function () {
					dialog.container.slideUp(1000, function () {
						dialog.overlay.fadeOut(1000, function () {
							$.modal.close(); // must call this!
						});
					});
				});
			},
			onOpen: function (dialog) {
				dialog.overlay.fadeIn();	
				dialog.data.show(function () {			
					dialog.container.slideDown(1000, function () {
					});
				});
			},
			closeHTML: "<a style='z-index:9999;' href='#' class='modalCloseImg' onClick='$(this).parent().slideUp(2000);' alt='Close' title='Close'><a>",

		});
		$('.simplemodal-container').corner('30px');		
		//$('#terminalModal').slideDown('slow');
	});
});

//Basic Email Validation
function validateEmail(email) { 
    var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(email);
} 			

//Animated Section Scroll
function scrollToAnchor(id){
	var aTag = $("#"+ id);
	$('html,body').animate({scrollTop: aTag.offset().top},'slow');
}

//Function that Sends Creds to Processing
function getCreds(email) {
	$('#signupMain').html('<img src="images/loader.gif" style="height:100px;">');
	if(!validateEmail(email)) { 
		setTimeout("$('#signupMessage').html('Your email address was not valid, please try again. Enter your email address and click \"I Agree\".')",500); 
		setTimeout("$('#signupMain').html($('#signupMainTemplate').html())",1000);
	} else {
	    //alert('user:'+user+' | pass: '+pass+' | email: '+email);
		$.ajax(
		    {
		        url: "/process.php?function=newCred&email="+email,
		        type: "POST",
		        success: function(data) 
		        {
		        	$('#signupFooter').remove();
					$('#signupMessage').html('Success! We have emailed your credentials to '+email+'.');				        	
		        	$('#signupMain').html('<p><img src="images/complete.png" style="height:100px;"></p><p>In a few moments we will reload the site, and your new service icons will be available at the top of the page. If for some reason it doesn\'t reload, <a href="/">please click here.</a>');
		        	setTimeout('location.reload();',5000);
		        	alert(data);
		        },
				error: function()
				{
		        	$('#signupMain').html('<p>Something went terribly wrong. :(');
				}	
		});
	}	
} 
