$(document).on('pageinit', '#portalLogin', function(){
	$(document).on('click', '#submit', function(){
		$("#frmLogin").validate({
			submitHandler: function(form) {
				$.ajax({url: 'DB/checkUserIdentity.php',
					data: {action : 'login', formData : $('#frmLogin').serialize()}, 
					type: 'post',                   
					async: true,
					beforeSend: function() {
						$.mobile.loadingMessage = 'Loading...Please wait';
						$.mobile.loading('show'); 
					},
					complete: function() {
						$.mobile.loading('hide'); 
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