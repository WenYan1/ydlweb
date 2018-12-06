var csrfToken = $('meta[name="csrf-token"]').attr("content");
$(document).ready(function(){
	$("#submit").click(function(){
		ajaxSumbit();
	});
});


function ajaxSumbit(){
	var newPassword = $("#newPassword").val();
	var oldPassword = $("#oldPassword").val();
	var verifyPassword = $("#verifyPassword").val();

	if (checkData(oldPassword)) {
		alert("原始密码不能为空！");
	}else if(checkData(newPassword)){
		alert("新密码不能为空！");
	}else if(checkData(verifyPassword)){
		alert("确认密码不能为空！");
	}else if(checkPassoword(newPassword,verifyPassword)){
		alert("新密码与确认密码不相等!");
	}else if (checkLength(newPassword)) {
		alert("设置不符合要求,请重新设置！");
	}else{
		$.ajax({
			type:"POST",
			url:"account/reset-password",
			data:{
					"oldPassword":oldPassword,
					"newPassword":newPassword,
					"verifyPassword":verifyPassword,
					"_csrf":csrfToken,
				},
			success:function(data){
				var msg = JSON.parse(data);
				if (msg.status) {
					alert(msg.message);
				}else{
					alert(msg.message);
				}
			}
		});
	}
}

function checkLength(data){
	return data.length <8;
}

function checkData(data){
	return data==null || data.length <=0;
}

function checkPassoword(newPassword,verifyPassword){
	return newPassword !== verifyPassword;
}