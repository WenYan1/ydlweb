var csrfToken = $('meta[name="csrf-token"]').attr("content");

$(document).ready(function(){
	$(".submit-payinfo").click(function(){
		checkAndSumbit();
	});
});

function checkAndSumbit(){
	
	var num = $("#money-number").val();
	if(checkData(num)){
		alert("付款金额不能为空！");
	}else if(!check_number(num)){
		alert("付款金额必须是正整数！");
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
