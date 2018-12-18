var csrfToken = $('meta[name="csrf-token"]').attr("content");
var start_time="";
var end_time="";

$(document).ready(function(){
	filter();
	hint();
	bind_order_id();
});

function filter(){

	var state;

	$("#type-1").click(function(){
		state = 1;
		createForm(state);
	});

	$("#type-2").click(function(){
		state = 2;
		createForm(state);
	});

	$("#type-3").click(function(){
		state = 3;
		createForm(state);
	});
	
	$("#type-4").click(function(){
		state = 4;
		createForm(state);
	});

	$(".button_fileter").click(function(){
		start_time = $("#start_time").val();
		end_time = $("#end_time").val();
		if(start_time.length == 0){
			alert("开始时间没有选择！");
		}else if(end_time.length == 0){
			alert("结束时间没有选择！");
		}else{
			createForm(getState());
		}
	});


}

function getState(){

	var type = $("#type-val").text();
	console.log(type);
	return type;
}

function createForm(state){

	if($("#filter").length > 0){
		$("#filter").remove();
	}

	var str ="";
	
	str += '<input type="text" name="type" value="'+ state +'"/>';
	console.log(state);
	if(start_time.length != 0){
		str += '<input name="start_time" type="text" value="'+ start_time +'"/>';
	}
	if(end_time.length != 0){
		str += '<input name="end_time" type="text" value="'+ end_time +'"/>';
	}

	$("#submit-btn").before(str);
	submitForm();

}

function submitForm(){
	$("#submit-btn").click();
}

function hint(){
	jQuery.noConflict();
	$('[data-toggle="tooltip"]').tooltip(100);
} 

function bind_order_id() {
	$("#bill").on("change",'[data-order=true]',function () {
        var id = $(this).attr("data-id");
        var val = $(this).val();

        $.post("/capital/change-order",
            {
                "id":id,
                "val":val,
                "_csrf":csrfToken
            },
            function(data){
                var contentData = $.parseJSON(data);
                if (contentData.state == 1){
                   alert("操作成功");
                }else{
                    alert("操作失败，稍后重试");
                }
            });
    });

	$("#bill").on('click','[data-apply="true"]',function () {
		alert("申请成功")
    })
}