var csrfToken = $('meta[name="csrf-token"]').attr("content");

$(document).ready(function(){
	$(".submit-payinfo").click(function(){
		$("#submit-real").click();
	});
});
