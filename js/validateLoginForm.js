$(document).on('pageinit', '#portalLogin', function(){
	$(document).on('click', '#submit', function(){
		$("#frmLogin").validate({
			submitHandler: function(form) {
				console.log("Ajax call...");
				// Send data to server through ajax call
				// action is functionality we want to call and outputJSON is our data
				$.ajax({url: 'js/checkUserIdentity.php',
					data: {action : 'login', formData : $('#frmLogin').serialize()}, 
					type: 'post',                   
					async: true,
					beforeSend: function() {
						// This callback function will trigger before data is sent
						$.mobile.loadingMessage = 'Loading...Please wait';
						$.mobile.loading('show'); // This will show ajax spinner
					},
					complete: function() {
						// This callback function will trigger on data sent/received complete
						$.mobile.loading('hide'); // This will hide ajax spinner
					},
					success: function (result) {
							resultObject.formSubmitionResult = result;
										$.mobile.changePage("#welcome", {transition: "slide"});
										//$( "#loginSuccess" ).popup("open");
					},
					error: function (request,error) {
						// This callback function will trigger on unsuccessful action                
						alert('Network error has occurred please try again!');
					}
				});           
			}
		});
	});
});

/*
$(document).on('pagebeforeshow', '#welcome', function(){     
    $('#welcome [data-role="content"]').replaceWith('Welcome ' + resultObject.formSubmitionResult + '!');  
});*/

var resultObject = {
    formSubmitionResult : null  
}