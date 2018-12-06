$(document).ready(function(){
	search();
	setStatus();
	enter_search();
});

function enter_search(){
	$(document).keyup(function(event){
		if (event.keyCode === 13) {
			get_search();
		}
	})
}

function search(){
	$(".search-button").click(function(){
		get_search();
	});
}

function get_search(){
	var account = $("#account").val();
		var supplier_name = $("#supplier_name").val();
		var product_status = $("#product_status option:selected").val();
		var product_name = $("#product_name").val();
		var page = $("#page").val();

		if (account.length == 0) {
			$("#account").removeAttr("name");
		}
		if (supplier_name.length == 0) {
			$("#supplier_name").removeAttr("name");
		}
		if (product_status.length == 0) {
			$("#product_status").removeAttr("name");
		}
		if (product_name.length == 0) {
			$("#product_name").removeAttr("name");
		}

		if (page.length == 0) {
			$("#page").removeAttr("name");
		}

		$('#submit').click();
}

function setStatus(){
	var state = parseInt($("#state_num").val());
	$("#product_status option[value=" + state + "]").attr("selected","true");
}