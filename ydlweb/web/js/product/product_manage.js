var refreshData;
var ALL = "";
var WAIT ="0";
var PASS ="1";
var NOPASS = "-1";
var STATE_ARRAY = [ALL,WAIT,PASS,NOPASS];
var privider_id ="";


$(document).ready(function(){
	filter();
});

function filter(){
	var state ;
	privider_id = $("#supplier option:selected").val() + "";
	$("#all").click(function(){
		state = ALL;
		createForm(state);
	});
	$("#checking").click(function(){
		state = WAIT;
		createForm(state);
	});
	$("#checked").click(function(){
		state = PASS;
		createForm(state);
	});
	$("#not-pass").click(function(){
		state = NOPASS;
		createForm(state);
	});
	$(".button_query").click(function(){
		createForm(getState());
	});
	$("#supplier").change(function(){
		privider_id = $("#supplier option:selected").val() + "";
		createForm(getState());
	});
}


function getState(){
	
	var a = $("#all").attr("class").length;
	var b = $("#checking").attr("class").length;
	var c = $("#checked").attr("class").length;
	var d = $("#not-pass").attr("class").length;
	var array = [a,b,c,d];
	return STATE_ARRAY[select(array)];
}

function select(list){

	var p = 0;
	for(var i=0;i<1;i++){
		p = i;
		for(var j=i+1;j<list.length;j++){
			if(list[j] > list[p]){
				p = j;
			}
		}
	}
	return p;
}

function createForm(state){
	if ($("#state").length > 0) {
		$("#state").remove();
	}
	if ($("#query").length > 0) {
		$("#query").remove();
	}
	if ($("#privider").length > 0) {
		$("#privider").remove();
	}
	var str = "";
	if (state.length > 0) {
		str += '<input id="state" type="text" name="state" value="'+ state +'"/>';
	}
	if (privider_id.length >= 1) {
		str += '<input id="privider" type="text" name="supplier" value="'+ privider_id +'"/>';
	}

	var query = $("#product_query").val();
	if (query.length > 0) {
		str += '<input id="query" type="text" name="search" value="'+ query +'"/>';
	}

	$("#submit-btn").before(str);
	submitForm();

}

function submitForm(){
	$("#submit-btn").click();
	//alert("state: " + $("#state").val() + " query: " + $("#query").val() + " privider:"+ $("#privider").val());
}