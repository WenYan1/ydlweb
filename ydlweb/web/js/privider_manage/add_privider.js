var csrfToken = $('meta[name="csrf-token"]').attr("content");
var source;
var bl_size = 0;
var tr_size = 0;
var oc_size = 0;
$(document).ready(function(){
    customListner();
    aboutUploadImg();
    submitForm();
});

function aboutUploadImg(){

    $("#business-license-btn").click(function(){
        $("#business-license-input").click();
    });
    $("#tax-reg-btn").click(function(){
        $("#tax-reg-input").click();
    });
    $("#organization-code-btn").click(function(){
        $("#organization-code-input").click();
    });
    $("#other_image-btn").click(function(){
        $("#other_image-input").click();
    });
    /*var ei = $("#large");
    ei.hide();
    $("#business-license-btn").mousemove(function(e){
            ei.css({top:350,left:500}).html('<img style="border:1px solid gray; width:300px;height: 300px;" src="' + this.src + '" />').show();
    }).mouseout( function(){
            ei.hide("slow");
    });
    $("#tax-reg-btn").mousemove(function(e){
            ei.css({top:350,left:500}).html('<img style="border:1px solid gray; width:300px;height: 300px;" src="' + this.src + '" />').show();
    }).mouseout( function(){
            ei.hide("slow");
    });
    $("#organization-code-btn").mousemove(function(e){
            ei.css({top:e.pageX,left:e.pageY}).html('<img style="border:1px solid gray; width:300px;height: 300px;" src="' + this.src + '" />').show();
    }).mouseout( function(){
            ei.hide("slow");
    });
*/

    $("#business-license-input").change(function(){
        var src = window.URL.createObjectURL(this.files[0]);
        bl_size = this.files[0].size;
        if(bl_size > 15*1024*1024){
            showFailHint("上传图片不能大于7MB");
        }
        $("#business-license-btn").attr("src",src);

    });
    $("#tax-reg-input").change(function(){
        var src = window.URL.createObjectURL(this.files[0]);
        tr_size = this.files[0].size;
        if(this.files[0].size > 1024*1024){
            showFailHint("上传图片不能大于1MB");
        }
        $("#tax-reg-btn").attr("src",src);

    });
    $("#organization-code-input").change(function(){
        var src = window.URL.createObjectURL(this.files[0]);
        oc_size = this.files[0].size;
        if(oc_size >1024*1024){
            showFailHint("上传图片不能大于1MB");
        }
        $("#organization-code-btn").attr("src",src);

    });
    $("#other_image-input").change(function(){
        var src = window.URL.createObjectURL(this.files[0]);
        oc_size = this.files[0].size;
        if(oc_size >1024*1024){
            showFailHint("上传图片不能大于1MB");
        }
        $("#other_image-btn").attr("src",src);

    });
}

function customListner(){

    $("#province_id").change(function(){

        var parent_id = $("#province_id option:selected").val();
        var province_name = $("#province_id option:selected").text();
        $("#province_hide").val(province_name);
        $.post("lower-area",
            {
                "parent_id":parent_id,
                "_csrf":csrfToken
            },
            function(data){
                var contentData = $.parseJSON(data).data;
                createCitySelect(contentData);
            });

    });


    $('#detail-address').bind('input propertychange', function() {
        $("#source").html();
        source = $("#province_id option:selected").text()
            + $("#city_id option:selected").text()
        //+  $("#county_id option:selected").text()
        //  + $("#detail-address").val();
        $("#source").html(source);
    });


    $("#province_id").trigger("change");

}

function createCitySelect(data){

    var _selected = $("#city_hide").attr('data-id');

    var str = '';
    str += '<select id="city_id" name="city_id">';
    for(var i=0;i<data.length;i++){
        if(i == 0){
            str += '<option selected="selected" value="'+ data[i].region_id +
                '">' + data[i].region_name +'</option>';
        }else{
            str += '<option value="'+ data[i].region_id + '" '+(_selected == data[i].region_id ? 'selected' : '')+'>' + data[i].region_name +'</option>';
        }
    }

    str += '</select>';

    if($("#city_id").length > 0){
        $("#city_id").remove();
    }
    $("#province_hide").after(str);

    $("#city_id").change(function(){

        var city_id = $("#city_id option:selected").val();
        var city_name = $("#city_id option:selected").text();
        $("#city_hide").val(city_name);

        $.post("lower-area",
            {
                "parent_id":city_id,
                "_csrf":csrfToken
            },
            function(data){
                var contentData = $.parseJSON(data).data;
                createCountySelect(contentData);
            });

    });

    $("#city_id").trigger("change");
}

function createCountySelect(data){
    var _selected = $("#county_hide").attr('data-id');

    var str = '';
    str += '<select id="county_id" name="county_id">';
    for(var i=0;i<data.length;i++){
        if(i == 0){
            str += '<option value="'+ data[i].region_id + '">' + data[i].region_name +'</option>';
        }else{
            str += '<option value="'+ data[i].region_id + '" '+(_selected == data[i].region_id ? 'selected' : '')+'>' + data[i].region_name +'</option>';
        }
    }

    str += '</select>';

    if($("#county_id").length > 0){
        $("#county_id").remove();
    }
    $("#city_hide").after(str);

    $("#county_id").change(function(){

        var county_name = $("#county_id option:selected").text();

        $("#county_hide").val(county_name);

        var source = $("#province_id option:selected").text()
            + $("#city_id option:selected").text()
        // +  $("#county_id option:selected").text()
        // + $("#detail-address").val();
        $("#source").html(source);
    });

    $("#county_id").trigger("change");

}

function submitForm(){
    $(".submit-btn").click(function(){
        checkAndSubmit();
    });
}

function checkAndSubmit(){

    var code = $("#code").val();
    var name = $("#name").val();
    var date = $("#date").val();
    var linkMen = $("#link-men").val();
    var linkMenPhone = $("#link-men-phone").val();
    var province = $("#province_id option:selected").val();
    var city = $("#city_id option:selected").val();
    var counties = $("#county_id option:selected").val();
    var detail_address = $("#detail-address").val();
    $("#source-hide").val(source);
    //$("#tax-rate").trigger("change");
    var taxRate = $("#tax-rate").val();
    var exportRight = $('input:radio[name="export_right"]:checked').val();
    var img1 = $("#business-license-input").val() || $("#business-license-hide").val();
    var img2 = $("#tax-reg-input").val() || $("#tax-reg-hide").val();
    var img3 = $("#organization-code-input").val() || $("#organization-code-hide").val();

    if(checkData(code)){
        showFailHint("纳税人识别号内容不能为空！");
    }else if(checkData(name)){
        showFailHint("开票公司名称内容不能为空！");
    }else if(checkData(date)){
        showFailHint("一般纳税人认定时间内容不能为空！");
    }else if(checkData(linkMen)){
        showFailHintalert("开票人财务联系人内容不能为空！");
    }else if(checkData(linkMenPhone)){
        showFailHint("开票人财务联系人电话内容不能为空！");
    }else if(checkData(detail_address)) {
        showFailHint("开票人详细地址内容不能为空！");
        // }else if(checkData(source)){
        //     showFailHint("境内资源地内容不能为空！");
        // }
        //else if(checkData(taxRate)){
        //  showFailHint("开票人增值税率内容为空！");
        //}
    }else if(checkData(img1)){
        showFailHint("请上传营业执照！");
    }else if(checkData(img2)){
        showFailHint("请上传一般纳税人认证书！");
    }else if(checkData(img3)){
        showFailHint("请上传以往开发的发票样本！");
    }else if(bl_size > 7*1024*1024){
        showFailHint("上传图片不能大于7MB");
    }else if(tr_size > 1024*1024){
        showFailHint("上传图片不能大于1MB");
    }else if(oc_size > 1024*1024){
        showFailHint("上传图片不能大于1MB");
    }
    //else if(checkPhone(linkMenPhone)){
    //     alert("手机格式不正确！");
    //}
    else{
        $("#sumbit-real").click();
    }
}

function checkPhone(data){
    var pattern = /^[0-9]*$/g;
    var phone = pattern.exec(data);
    return !!!phone;
}

function checkData(data){
    return data.length <= 0;
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
