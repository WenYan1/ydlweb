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
    var customs_port = $("#customs_port").val();
    var customs_contact = $("#customs_contact").val();
    var customs_contact_tel = $("#customs_contact_tel").val();
    var destination_country_or_area = $("#destination_country_or_area").val();
    var transport_package_count = $("#transport_package_count").val();
    var pack_type_list = $("#pack_type_list").val();
    var arrive_port = $("#arrive_port").val();
    var net_weight = $("#net_weight").val();

    var gross_weight = $("#gross_weight").val();
    var box_number = $("#box_number").val();
    var box_unit = $("#box_unit").val();
    var goods_price = $("#goods_price").val();
    var subtotal = $("#subtotal").val();
    var standard_count = $("#standard_count").val();
    var standard_count2 = $("#standard_count2").val();
    var supplier_id = $("#supplier_id").val();
    var invoice_amount = $("#invoice_amount").val();
    var estimate = $("#estimate").val();
    var delivery_time = $("#delivery_time").val();
    var buyers_name = $("#buyers_name").val();
    var buyers_address = $("#buyers_address").val();
    var buyers_contact = $("#buyers_contact").val();
    var trading_country = $("#trading_country").val();
    var goods_supply_id = $("#goods_supply_id").val();
    var goods_save_adr = $("#goods_save_adr").val();
    var contract_type = $("#contract_type").val();



    var img1 = $("#purchasing_order_input").val() || $("#purchasing_order_hide").val();
    var img2 = $("#other_file_input").val() || $("#other_file_hide").val();

    //else if (checkData(img1)) {
    //         showFailHint("请上传采购订单或PI！");
    //     } else if (checkData(img2)) {
    //         showFailHint("请上传其他！");
    //     }

    if (checkData(drawback_brokerage)) {
        showFailHint("退税手续费内容不能为空！");
    } else if (checkData(interest_offer)) {
        showFailHint("年化利息报价内容不能为空！");
    } else if (checkData(customs_port)) {
        showFailHint("报关口岸内容不能为空！");
    } else if (checkData(customs_contact)) {
        showFailHint("报关联系人内容不能为空！");
    } else if (checkData(customs_contact_tel)) {
        showFailHint("报关联系方式内容不能为空！");
    } else if (checkData(destination_country_or_area)) {
        showFailHint("运抵国（地区）内容不能为空！");
    }else if (checkData(arrive_port)) {
        showFailHint("到达口岸内容不能为空！");
    } else if (checkData(transport_package_count)) {
        showFailHint("整体包装件数内容不能为空！");
    } else if (checkData(pack_type_list)) {
        showFailHint("包装种类内容不能为空！");
    } else if (checkData(goods_id)) {
        showFailHint("出货产品内容不能为空！");
    } else if (checkData(net_weight)) {
        showFailHint("总净重(KG)内容不能为空！");
    } else if (checkData(gross_weight)) {
        showFailHint("总毛重(KG)内容不能为空！");
    } else if (checkData(box_number)) {
        showFailHint("产品数量和单位内容不能为空！");
    } else if (checkData(box_unit)) {
        showFailHint("产品数量和单位内容不能为空！");
    } else if (checkData(goods_price)) {
        showFailHint("单价内容不能为空！");
    } else if (checkData(subtotal)) {
        showFailHint("货值内容不能为空！");
    } else if (checkData(standard_count)) {
        showFailHint("法定数量和单位内容不能为空！");
    } else if (checkData(supplier_id)) {
        showFailHint("开票人内容不能为空！");
    } else if (checkData(invoice_amount)) {
        showFailHint("开票金额内容不能为空！");
    } else if (checkData(estimate)) {
        showFailHint("估算汇率内容不能为空！");
    } else if (checkData(delivery_time)) {
        showFailHint("预计出货日期内容不能为空！");
    } else if (checkData(buyers_name)) {
        showFailHint("境外收货人内容不能为空！");
    } else if (checkData(buyers_address)) {
        showFailHint("地址内容不能为空！");
    } else if (checkData(buyers_contact)) {
        showFailHint("联系方式内容不能为空！");
    } else if (checkData(trading_country)) {
        showFailHint("贸易国（地区）内容不能为空！");
    } else if (checkData(goods_supply_id)) {
        showFailHint("境内货源地内容不能为空！");
    } else if (checkData(goods_save_adr)) {
        showFailHint("目前货物存放地址内容不能为空！");
    } else if (checkData(contract_type)) {
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



