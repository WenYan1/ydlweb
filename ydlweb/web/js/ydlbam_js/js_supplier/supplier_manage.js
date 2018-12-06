$(document).ready(function(){
	search();
	setStatus();
	enter_search();
});

function enter_search(){
	$(document).keyup(function(event){
		if (event.keyCode === 13) {
			start_search();
		}
	});
}

function search(){
	$(".search-button").click(function(){
		start_search();
	});

}

function start_search(){
	var supplier = $("#supplier").val();
		var user_account = $("#user_account").val();
		var product_status = $("#product_status option:selected").val();
		var page = $("#page").val();

		if (supplier.length == 0) {
			$("#supplier").removeAttr("name");
		}
		if (user_account.length == 0) {
			$("#user_account").removeAttr("name");
		}

		if (product_status.length == 0) {
			$("#product_status").removeAttr("name");
		}

		if (page.length == 0) {
			$("#page").removeAttr("name");
		}

		$("#submit").click();
}

function setStatus(){
	var state = parseInt($("#state_num").val());
	$("#product_status option[value=" + state + "]").attr("selected","true");
}


