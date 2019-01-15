var csrfToken = $('meta[name="csrf-token"]').attr("content");
var source;
var bl_size = 0;
var tr_size = 0;
$(document).ready(function(){
    aboutUploadImg();
    submitForm();
	
});

function aboutUploadImg(){

    $("#purchasing_order_btn").click(function(){
        $("#purchasing_order_input").click();
    });
    $("#other_file_btn").click(function(){
        $("#other_file_input").click();
    });

    $("#purchasing_order_input").change(function(){
        var src = window.URL.createObjectURL(this.files[0]);
        bl_size = this.files[0].size;
        if(bl_size > 8*1024*1024){
            showFailHint("上传采购订单或PI不能大于8MB");
        }

        var ext_img = get_file_ext(this.files[0].name);

        $("#purchasing_order_btn").attr("src",(ext_img === '' ? src : ext_img));

    });

    $("#other_file_input").change(function(){
        var src = window.URL.createObjectURL(this.files[0]);
        tr_size = this.files[0].size;
        if(tr_size > 8*1024*1024){
            showFailHint("上传其他附件不能大于8MB");
        }

        var ext_img = get_file_ext(this.files[0].name);

        $("#other_file_btn").attr("src",(ext_img === '' ? src : ext_img));

    });

}


function submitForm(){
    $(".submit-btn").click(function(){
        checkAndSubmit();
    });
}

function checkAndSubmit(){

    var drawback_brokerage = $("#drawback_brokerage").val();
    var interest_offer = $("#interest_offer").val();
    var deposit_ratio = $("#deposit_ratio").val();
    var order_amount = $("#order_amount").val();
    var customs_port = $("#customs_port").val();
    var customs_contact = $("#customs_contact").val();
    var customs_contact_tel = $("#customs_contact_tel").val();
    var destination_country_or_area = $("#destination_country_or_area").val();
    var arrive_port = $("#arrive_port").val();
    var transport_package_count = $("#transport_package_count").val();
    var pack_type_list = $("#pack_type_list").val();
    var delivery_time = $("#delivery_time").val();
    var buyers_name = $("#buyers_name").val();
    var buyers_address = $("#buyers_address").val();
    var buyers_contact = $("#buyers_contact").val();
    var trading_country = $("#trading_country").val();
    var goods_supply_id = $("#goods_supply_id").val();
    var goods_save_adr = $("#goods_save_adr").val();
    var contract_type = $("#contract_type").val();

    if (checkData(drawback_brokerage)) {
        showFailHint("退税手续费内容不能为空！");
    } else if (checkData(interest_offer)) {
        showFailHint("年化利息报价内容不能为空！");
    } else if (checkData(deposit_ratio) || checkData(order_amount)) {
        showFailHint("订金比例内容不能为空！或订金金额内容不能为空！");
    } else if (checkData(customs_port)) {
        showFailHint("报关口岸内容不能为空！");
    }  else if (checkData(customs_contact)) {
        showFailHint("报关联系人内容不能为空！");
    }  else if (checkData(customs_contact_tel)) {
        showFailHint("联系方式内容不能为空！");
    } else if (checkData(destination_country_or_area)) {
        showFailHint("运抵国（地区）内容不能为空！");
    } else if (checkData(arrive_port)) {
        showFailHint("到达口岸内容不能为空！");
    } else if (checkData(transport_package_count)) {
        showFailHint("整体包装件数内容不能为空！");
    } else if (checkData(pack_type_list)) {
        showFailHint("包装种类内容不能为空！");
    } else if (checkData(delivery_time)) {
        showFailHint("预计出货日期内容不能为空！");
    } else if (checkData(buyers_name)) {
        showFailHint("境外收货人内容不能为空！");
    } else if (checkData(buyers_address)) {
        showFailHint("地址内容不能为空！");
    }else if (checkData(buyers_contact)) {
        showFailHint("联系方式内容不能为空！");
    } else if (checkData(trading_country)) {
        showFailHint("贸易国（地区）内容不能为空！");
    } else if (checkData(goods_supply_id)) {
        showFailHint("境内货源地内容不能为空！");
    } else if (checkData(goods_save_adr)) {
        showFailHint("目前货物存放地址内容不能为空！");
    }else if (checkData(contract_type)) {
        showFailHint("合同编号内容不能为空！");
    } else if (bl_size > 8 * 1024 * 1024) {
        showFailHint("上传采购订单或PI不能大于8MB");
    } else if (tr_size > 8 * 1024 * 1024) {
        showFailHint("上传其他附件不能大于8MB");
    } else {
        $("#sumbit-real").click();
    }
}

function checkPhone(data){
    var pattern = /^[0-9]*$/g;
    var phone = pattern.exec(data);
    return !!!phone;
}

function checkData(data){
    return data===undefined ? true : data.length <= 0;
}

function showSuccessHint(msg){
    var str = '';
    if($(".hint-dialog_success").length <= 0){
        str += '<div class="hint-dialog_success"><p class="hint-info_success"></p></div>';
        $(".submit-btn").after(str);
    }
    $(".hint-dialog_success").css("width",msg.length * 18);
    $(".hint-info_success").text(msg);
    $(".hint-dialog_success").show();
    setTimeout("hideSuccessHint()",3000);
}

function hideSuccessHint(){
    $(".hint-dialog_success").hide();
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



