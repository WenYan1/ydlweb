var csrfToken = $('meta[name="csrf-token"]').attr("content");
var source;
var bl_size = 0;
var tr_size = 0;
var oc_size = 0;
$(document).ready(function(){
	aboutUploadImg();
    submitForm();
});

function aboutUploadImg(){

	$("#tax_refund_btn").click(function(){
		$("#tax_refund_input").click();
	});
	$("#supply_contract_btn").click(function(){
		$("#supply_contract_input").click();
	});
	$("#invoice_btn").click(function(){
		$("#invoice_input").click();
	});

    $("#tax_refund_input").change(function(){
        var src = window.URL.createObjectURL(this.files[0]);
        bl_size = this.files[0].size;
        if(bl_size > 4*1024*1024){
            showFailHint("上传图片不能大于4MB");
        }
        $("#tax_refund_btn").attr("src",src);
    });

    $("#supply_contract_input").change(function(){
        var src = window.URL.createObjectURL(this.files[0]);
        tr_size = this.files[0].size;
        if(tr_size > 4*1024*1024){
            showFailHint("上传图片不能大于4MB");
        }
        $("#supply_contract_btn").attr("src",src);
    });

    $("#invoice_input").change(function(){
        var src = window.URL.createObjectURL(this.files[0]);
        oc_size = this.files[0].size;
        if(oc_size > 4*1024*1024){
            showFailHint("上传图片不能大于4MB");
        }
        $("#invoice_btn").attr("src",src);
    });
}


function submitForm(){
    $(".submit-btn").click(function(){
        checkAndSubmit();
    });
}

function checkAndSubmit(){

    var order_number = $("#order_number").val();
    var anticipated_tax_refund = $("#anticipated_tax_refund").val();
    var img1 = $("#tax_refund_input").val() || $("#tax_refund_hide").val();
    var img2 = $("#supply_contract_input").val() || $("#supply_contract_hide").val();
    var img3 = $("#invoice_input").val() || $("#invoice_hide").val();

    if(checkData(order_number)){
        showFailHint("订单号内容不能为空！");
    }else if(checkData(anticipated_tax_refund)){
        showFailHint("预计退税款内容不能为空！");
    }else if(checkData(img1)){
        showFailHint("上传报关单退税联、供货合同、增值税发票信息不完整！");
    }else if(checkData(img2)){
        showFailHint("上传报关单退税联、供货合同、增值税发票信息不完整！");
    }else if(checkData(img3)){
        showFailHint("上传报关单退税联、供货合同、增值税发票信息不完整！");
    }else if(bl_size > 4*1024*1024){
        showFailHint("上传图片不能大于4MB");
    }else if(tr_size > 4*1024*1024){
        showFailHint("上传图片不能大于4MB");
    }else if(oc_size > 4*1024*1024){
        showFailHint("上传图片不能大于4MB");
    }
	else{
        $("#sumbit-real").click();
    }
}


function checkData(data){
    if (data === undefined){
        return true;
    }
    return data.length <= 0;
}

function showFailHint(msg){
    var str = '';
    if($(".hint-dialog_fail").length <= 0){
        str += '<div class="hint-dialog_fail"><p class="hint-info_fail"></p></div>';
        $(".submit-btn").after(str);
    }
    $(".hint-dialog_fail").css("width",msg.length * 18);
    $(".hint-info_fail").text(msg);
    $(".hint-dialog_fail").show();
    setTimeout("hideFailHint()",3000);
}


function hideFailHint(){
    $(".hint-dialog_fail").hide();
}
