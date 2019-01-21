var csrfToken = $('meta[name="csrf-token"]').attr("content");

$(document).ready(function(){
	$(".submit-payinfo").click(function(){
		checkAndSumbit();
	});
});

function checkAndSumbit(){
	
	var num = $("#money-number").val();
	var factory_account_name = $("#factory_account_name").val();
	var account_name = $("#account_name").val();
	if(checkData(num)){
		alert("付款金额不能为空！");
	}else if(checkData(factory_account_name)){
        alert("加工厂账户名不能为空！");
    }else if(checkData(account_name)){
        alert("账号信息不能为空！");
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
