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

function validate(data){

	if(data.length < 8){
		alert("密码长度不能低于8位,请重新输入！");
		return false;
	}else if(data.length > 16){
		alert("密码长度不能超过16位,请重新输入！");
		return false;
	}
	return true;

}

function ajaxSumbit(){

	var email = $("#email").val();
	var password = $("#password").val();
	if(validate(password)){
		var password_compare = $("#password_compare").val();
		var verify_code = $("#loginform-verifycode").val();
		$.post("login/register",
				{
					"email":email,
					"password":password,
					"password_compare":password_compare,
					"verify_code":verify_code,
					"_csrf":csrfToken
				},
		function(data){
			var jsonObj = eval("("+data+")");
	    		alert(jsonObj.message);
			/*if(data.code == 200){
				alert(data.message);
			} else {
				alert("error！");
			}*/
			    
		});
	}

}