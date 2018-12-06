$(document).ready(function(){
	$(".search-button").click(function(){
		checkData();
	});
});

function checkData(){
	var email = $("#email").val();

	if(!isNull(email)){
		$("#submit-real").click();
	}

}

function isNull(data){
    return $.trim(data).length == 0;
}
