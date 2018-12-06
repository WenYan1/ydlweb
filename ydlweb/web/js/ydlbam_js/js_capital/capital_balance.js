$(document).ready(function(){
	$(".capital-child").css("display","block");
	$(".capital-child").show(500);
	switchType();
	$(".search-button").click(function(){
		checkData();
	});
});

function switchType(){
	$(".select-row").find("td").each(function(){
		$(this).click(function(){
			if($(this).children().text() == "充值记录"){
				$("#type").val(3);
				checkData();
			}else if($(this).children().text() == "可用资金流水"){
				$("#type").val(2);
				checkData();
			}else{
				$("#type").val(1);
				checkData();
			}
		});
	});
}

function checkData(){
	var email = $("#email").val();
	if(isNull(email)){
		$("#email").removeAttr("name");
	}else{
		$("#email").val(email);	
	}
	var email2 =$("#email").val();
	$("#submit-real").click();
}

function isNull(data){
    return $.trim(data).length == 0;
}