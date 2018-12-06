$(document).ready(function(){
	var csrfToken = $('meta[name="csrf-token"]').attr("content");
	var default_phone;
	$("#add_phone").click(function(){
		$("#add_phone").addClass("hide");
		$("#bind-phone").removeClass("hide");
		$("#cancel").attr("title","1");
	});
	$("#modify_phone").click(function(){
		$("#modify").addClass("hide");
		default_phone = $("#default_phone").text();
		$("#bind-phone").removeClass("hide");
		$("#cancel").attr("title","2");
	});
	$("#modify_phone2").click(function(){
		$("#phone-div").addClass("hide");
		$("#bind-phone").removeClass("hide");
		$("#cancel").attr("title","3");
	});
	$("#save_phone").click(function(){
		var phone_input = $("#phone_input").val();
		if (phone_input && phone_input.length === 0) {
			alert("手机号不能为空！");
		}else{

			$.ajax({
				type: "POST",
				url: "/account/reset-telephone",
				data: {"_csrf":csrfToken,"telephone":phone_input},
				success: function(msg){
					var data = JSON.parse(msg);
					if (data.status) {
						$("#bind-phone").addClass("hide");
						$("#phone").text(phone_input);
						$("#phone-div").removeClass("hide");
					}
				}
			});
		}
	});

	$("#cancel").click(function(){
		var title = $(this).attr("title");
		if (title == 1) {
			$("#bind-phone").addClass("hide");
			$("#add_phone").removeClass("hide");
		}else if(title == 2){
			$("#bind-phone").addClass("hide");
			$("#modify").removeClass("hide");
			$("#default_phone").text(default_phone);
		}else{
			$("#bind-phone").addClass("hide");
			$("#phone-div").removeClass("hide");
		}
	})
});