var csrfToken = $('meta[name="csrf-token"]').attr("content");
$(document).ready(function(){
    //出口产品以及大类转数组
    arrFun();
    //重新审核
    companyNewly();
});

function companyNewly() {
    var day = parseInt($('#company-expect-days').val());
    var apply = parseInt($('#company-apply').val());
    var product = $('#export-range').val();
    $("#expect-days>input").attr("checked",day);
    $("#expect-apply>input").attr("checked",apply);
}

function arrFun() {
    $('#company-submit').click(function(){
        var chk_value =[];    
        $('input[type="checkbox"]:checked').each(function(){    
            chk_value.push($(this).val());    
        });  
        $('#export-range').val(chk_value);
        var company_name = $("#company-name").val();
        var country = $("#company-country").val();
        var city = $("#company-city").val();
        var detail = $("#company-detail-address").val();
        var company_tel = $("#company-tel").val();
        var company_expect_money = $("#company-expect-money").val();
        if (company_name=='') {
            $("#company-name").focus();
        }else if(country==''){
            $("#company-country").focus();
        }else if(city==''){
            $("#company-city").focus()
        }else if(detail==''){
            $("#company-detail-address").focus()
        }else if(checkPhone(company_tel)){
            alert('请填写正确的电话号码！');
            $("#company-tel").focus();
        }else if(company_expect_money==''){
            $("#company-expect-money").focus()
        }else {
         $('#company-btn').click();
     }
 })
}

function checkPhone(data){
    var pattern = /^(13[0-9]|14[5|7]|15[0|1|2|3|5|6|7|8|9]|18[0|1|2|3|5|6|7|8|9])\d{8}$/g;
    var phone = pattern.exec(data);
    return !!!phone;
}



