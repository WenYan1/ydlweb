var csrfToken = $('meta[name="csrf-token"]').attr("content");
var PAY = 1;
var SETTLEMENT_EXCHANGE = 2;
var OVERDUE_FUND = 3;
var DUTY_RATE = 4;
var STATE_ARRAY = [1,2,3,4];
$(document).ready(function(){
	filter();
	hint();
});

function filter(){
	var state;
	$("#state-pay").click(function(){
		state = PAY;
		createForm(state);
	});
	$("#state-se").click(function(){
		state = SETTLEMENT_EXCHANGE;
		createForm(state);
	});
	$("#state-of").click(function(){
		state = OVERDUE_FUND;
		createForm(state);
	});
	$("#state-dr").click(function(){
		state = DUTY_RATE;
		createForm(state);
	});
	
	$(".button_query").click(function(){
		createForm(getState());
	});
}

function getState(){
	
	var a = $("#state-pay").attr("class").length;
	var b = $("#state-se").attr("class").length;
	var c = $("#state-of").attr("class").length;
	var d = $("#state-dr").attr("class").length;
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

	if($("#filter").length > 0){
		$("#filter").remove();
	}

	if($("#search").length > 0){
		$("#search").remove();
	}

	var str ="";
	str += '<input id="filter" type="text" name="filter" value="'+ state +'"/>';
	

	var key = $("#key").val();
	if(key.length > 0){
		str += '<input id="search" type="text" name="search" value="'+ key +'"/>';
	}

	$("#submit-btn").before(str);

	$("#submit-btn").click();

}

function hint(){
	jQuery.noConflict();
	$('[data-toggle="tooltip"]').tooltip(100);
} 




