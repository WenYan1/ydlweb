$(document).ready(function(){
	$(".capital-child").css("display","block");
	$(".capital-child").show(500);
	switchType();
});

function switchType(){
	$(".select-row").find("td").each(function(){
		$(this).click(function(){
			if($(this).children().text() == "充值记录"){
				$("#type").val(3);
			}else if($(this).children().text() == "可用资金流水"){
				$("#type").val(2);
			}else{
				$("#type").val(1);
			}
			$("#submit-real").click();
		});
	});
}