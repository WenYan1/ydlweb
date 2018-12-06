var csrfToken = $('meta[name="csrf-token"]').attr("content");
$(document).ready(function(){
	$("#btn-submit").click(function(){
		submitInfo();
	});
});

function submitInfo(){
	
		if(checkData($("#bank_name").val())){
			alert("银行名称不能为空！");
		}else if(checkData($("#bank_account").val())){
			alert("银行账号不能为空！");
		}else if (checkData($("#recharge_amount").val())) {
			alert("充值金额不能为空！");
		}else if(!check_number($("#recharge_amount").val())){
			alert("充值金额必须为正整数！");
		}else if (checkData($("#recharge_time").val())){
			alert("充值日期不能为空！");
		}else{
			$("#submit-real").click();
		}
	
}

function checkData(data){
    return data.length <= 0;
}

function check_number(obj) { 
	var e = new RegExp("^[0-9]*[1-9][0-9]*$");
	if (e.test(obj)) { 
		return true; 
	}else{ 
		return false; 
	} 
} 
