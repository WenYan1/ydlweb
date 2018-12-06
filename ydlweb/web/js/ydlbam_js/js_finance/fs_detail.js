var csrfToken = $('meta[name="csrf-token"]').attr("content");
$(document).ready(function(){
	$("#modefiy").click(function(){
		$("#modefiy").css("display","none");
		$("#total-span").css("display","none");
		$("#modefiy-ok").css("display","block");
		$("#total-input").css("display","block");
	});
	$("#modefiy-ok").click(function(){
		submitAjax();
	});
	$(".btn-red").click(function(){
		$("#state-text").text("冻结");
		//ajax
		$(this).css("display","none");
		$(".btn-blue").css("display","block");
	});
	$(".btn-blue").click(function(){
		$("#state-text").text("正常");
		//ajax
		$(this).css("display","none");
		$(".btn-red").css("display","block");
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


function submitAjax(){
	var id = $("#user-id").text();
	var money = $("#total-input").val();
	$.post("edit-credit",
			{
				id:id,
				money:money,
				_csrf:csrfToken
			},function(data){
				var obj = JSON.parse(data);
				if(obj.status){
					showSuccessHint(obj.message,obj.lastCredit);
				}else{
					showFailHint(obj.message,obj.lastCredit);
				}
			}
			);
}

function showSuccessHint(msg,money){
    var str = '';
    if($(".hint-dialog_success").length <= 0){
        str += '<div class="hint-dialog_success"><p class="hint-info_success"></p></div>';
        $(".main-content").after(str);
    }
    $(".hint-dialog_success").css("width",msg.length*18);
    $(".hint-info_success").text(msg);
    $(".hint-dialog_success").show();
    setTimeout("hideSuccessHint()",3000);
    $("#total-span").text(money);
    var already_use = $("#already-use").text();
    $("#surplus-use").text(money-already_use);
    $("#modefiy-ok").css("display","none");
	$("#total-input").css("display","none");
	$("#modefiy").css("display","block");
	$("#total-span").css("display","block");
}

function hideSuccessHint(){
    $(".hint-dialog_success").hide();
}

function showFailHint(msg,meney){
    var str = '';
    if($(".hint-dialog_fail").length <= 0){
        str += '<div class="hint-dialog_fail"><p class="hint-info_fail"></p></div>';
        $(".main-content").after(str);
    }
    $(".hint-dialog_fail").css("width",msg.length*18);
    $(".hint-info_fail").text(msg);
    $(".hint-dialog_fail").show();
    setTimeout("hideFailHint()",3000);
    $("#modefiy-ok").css("display","none");
	$("#total-input").css("display","none");
	$("#modefiy").css("display","block");
	$("#total-span").css("display","block");
}


function hideFailHint(){
    $(".hint-dialog_fail").hide();
}