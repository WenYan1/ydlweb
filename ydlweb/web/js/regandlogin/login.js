var csrfToken = $('meta[name="csrf-token"]').attr("content");
$(document).ready(function(){

	$("#submit").click(function(){
		ajaxSumbit();
	});

	$(document).keyup(function(event){
		if (event.keyCode === 13) {
			ajaxSumbit();
		}
	});
});


function ajaxSumbit(){
	
	var email = $("#account").val();
	var password = $("#password").val();
	
	$.post("login/login",
				{
					"email":email,
					"password":password,
					"_csrf":csrfToken
				},
		function(data){
			var jsonObj = eval("("+data+")");
	    		alert(jsonObj.message);
			    
		});

}