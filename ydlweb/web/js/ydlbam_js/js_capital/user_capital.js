$(document).ready(function(){
	$(".capital-child").css("display","block");
	$(".capital-child").show(500);
	$(".search-button").click(function(){
		checkData();
	});

});

function checkData(){
	var account_val = $("#email").val();

	if(!isNull(account_val)){
		$("#submit-real").click();
	}

}

function isNull(data){
    return $.trim(data).length == 0;
}



