var csrfToken = $('meta[name="csrf-token"]').attr("content");
$(document).ready(function(){

	$("#submit").click(function(){
		ajaxSumbit();
	});
});


function ajaxSumbit(){
	var email = $("#account").val();
	var verifyCode = $("#verification-input").val();

	$.ajax({
			type:"POST",
			url:"login/password",
			data:{
					"email":email,
					"verifyCode":verifyCode,
					"_csrf":csrfToken,
				},
			success:function(data){
				// var msg = JSON.parse(data);
				// if (msg.status) {
				// 	alert(msg.message);
				// }else{
				// 	alert(msg.message);
				// }
			}
		});
}