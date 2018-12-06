$(document).ready(function(){
	$(".search-button").click(function(){
		checkData();
	});
	search();
});

function checkData(){
	var email_val = $("#email").val();
	var company_name_val = $("#company_name").val();

	if(isNull(email_val)){
		$("#email").removeAttr("name");
	}

	if(isNull(company_name_val)){
		$("#company_name").removeAttr("name");
	}

	if(isNull(company_name_val) && isNull(company_name_val)){
		var html_code = '<input type="hidden" value="全部" id="state">';
		$("#submit-real").after(html_code);
	}

}

function isNull(data){
    return $.trim(data).length == 0;
}

function search(){
	$(".search-button").click(function(){
		var email = $("#email").val();

		if (email.length == 0) {
			$("#email").removeAttr("name");
		}
		
		$("#submit").click();
	});
	


}
