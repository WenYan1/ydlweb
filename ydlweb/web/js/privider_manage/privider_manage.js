var refreshData;
var ALL = "";
var WAIT ="0";
var PASS ="1";
var NOPASS = "-1";
var NEED_PERFECT = "2";
var STATE_ARRAY = [ALL,WAIT,PASS,NOPASS,NEED_PERFECT];
var select_str = "font-size-default default-blue under-line";
var no_select_str = "font-size-default";
$(document).ready(function(){
	filter();
});

function filter(){

	var state;

	$("#all-state").click(function(){
		state = ALL;
		createForm(state);
	});

	$("#state-1").click(function(){
		state = WAIT;
		createForm(state);
	});

	$("#state-2").click(function(){
		state = PASS;
		createForm(state);
	});

	$("#state-3").click(function(){
		state = NOPASS;
		createForm(state);
	});

	$("#state-4").click(function(){
		state = NEED_PERFECT;
		createForm(state);
	});

	$(".button_query").click(function(){
		
		createForm(getState());
	});

}

function getState(){
	
	var a = $("#all-state").attr("class").length;
	var b = $("#state-1").attr("class").length;
	var c = $("#state-2").attr("class").length;
	var d = $("#state-3").attr("class").length;
	var e = $("#state-4").attr("class").length;
	var array = [a,b,c,d,e];

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
	};
	if($("#search").length > 0){
		$("#search").remove();
	}

	var str ="";
	if(state.length > 0){
		str += '<input id="state" type="text" name="state" value="'+ state +'"/>';
	}

	var key = $("#key").val();
	if(key.length > 0){
		str += '<input id="search" type="text" name="search" value="'+ key +'"/>';
	}

	$("#submit-btn").before(str);

	submitForm();

}

function submitForm(){
	$("#submit-btn").click();
}