var csrfToken = $('meta[name="csrf-token"]').attr("content");
var source;
var bl_size = 0;
var tr_size = 0;
var oc_size = 0;
$(document).ready(function(){
    submitForm();
});


function submitForm(){
    $(".submit-btn").click(function(){
        checkAndSubmit();
    });
}

function checkAndSubmit(){

    var order_number = $("#order_number").val();
    var anticipated_tax_refund = $("#anticipated_tax_refund").val();

    var img1 = $('[data-category="1"] [data-box="true"]').length;
    var img2 = $('[data-category="2"] [data-box="true"]').length;
    var img3 = $('[data-category="3"] [data-box="true"]').length;
    var img4 = $('[data-category="4"] [data-box="true"]').length;

    if(checkData(order_number)){
        showFailHint("订单号内容不能为空！");
    }else if(checkData(anticipated_tax_refund)){
        showFailHint("预计退税款内容不能为空！");
    }else if(img1 <= 0){
        showFailHint("请上传报关退税联！");
    }else if(img2 <= 0){
        showFailHint("请上传供货合同！");
    }else if(img3 <= 0){
        showFailHint("请上传增值税发票！");
    }else if(img4 <= 0){
        showFailHint("请上传提单！");
    } else{
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
