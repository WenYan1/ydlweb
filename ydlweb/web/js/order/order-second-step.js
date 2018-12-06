// create by feng

/*********************

提交订单第二步js

**********************/
var click_state1 = false;
var click_state2 = false;
var first_pay_flag = false;
$(function(){
	first_pay();
	empty_state();
	portListener();
})

function portListener(){
	/*计算并得出下拉列表的位置和状态*/
	var top_customs_port = getElementTop(document.getElementById('customs_port'));
	var left_customs_port = getElementLeft(document.getElementById('customs_port'));
	$(".down-div1").css("top",top_customs_port+29);
	$(".down-div1").css("left",left_customs_port);
	$(".down-div1").css("display","none");
	var top_arrive_port = getElementTop(document.getElementById('arrive_port'));
	var left_arrive_port = getElementLeft(document.getElementById('arrive_port'));
	$(".down-div2").css("top",top_arrive_port+29);
	$(".down-div2").css("left",left_arrive_port);
	$(".down-div2").css("display","none");



	$('#customs_port').bind('input propertychange', function() {
		
		$(".down-div1").find("p").each(function(){
			$(this).remove();
		});
		var input_val = $(this).val();
		input_val = input_val.replace("(", "");
		input_val = input_val.replace(")", "");
		/*正则匹配*/
		if (!click_state1) {
			if(input_val.length > 0){
				var result1 = findFromChina($.trim(input_val.toUpperCase()));
		        /*无结果则不显示匹配信息框*/
		       	if(result1.length > 0){
		       		var html_code = "";
		       		for (var i = 0; i < result1.length; i++) {
		       			html_code += '<p>'+result1[i]+'</p>';
		       		};
		       		$(".down-div1").append(html_code);
		       		$(".down-div1").css("display","block");
		       		$(".down-div1").find("p").each(function(){
						$(this).click(function(){
							$('#customs_port').val($(this).text());
							click_state1 = true;
							$(".down-div1").css("display","none");
						});
					});
		       	}else{
		       		$(".down-div1").css("display","none");
		       	}
		    }else{
		    	$(".down-div1").css("display","none");
		    }
		}else{
			click_state1 = false;
		}
        
    });

    $('#arrive_port').bind('input propertychange', function() {
    	$(".down-div2").find("p").each(function(){
			$(this).remove();
		});
		var input_val = $(this).val();
		input_val = input_val.replace("(", "");
		input_val = input_val.replace(")", "");
		/*正则匹配*/
		if (!click_state2) {
			if(input_val.length > 0){
				var result2 = findFromGlobal($.trim(input_val.toUpperCase()));
		        /*无结果则不显示匹配信息框*/
		       	if(result2.length > 0){
		       		var html_code = "";
		       		for (var i = 0; i < result2.length; i++) {
		       			html_code += '<p>'+result2[i]+'</p>';
		       		};
		       		$(".down-div2").append(html_code);
		       		$(".down-div2").css("display","block");
		       		$(".down-div2").find("p").each(function(){
						$(this).click(function(){
							$('#arrive_port').val($(this).text());
							click_state2 = true;
							$(".down-div2").css("display","none");
						});
					});
		       	}else{
		       		$(".down-div2").css("display","none");
		       	}
		    }else{
		    	$(".down-div2").css("display","none");
		    }
		}else{
			click_state2 = false;
		}
    });
}

function findFromChina(key){
    var chinaPorts = JSON.parse(localStorage.getItem("chinaPorts"));
    var chinaArrays = new Array();
    for(var i=0;i<chinaPorts.length;i++){
        if(regEn(key,chinaPorts[i].name)){
            chinaArrays.push(chinaPorts[i].name);
        }
    }
    return chinaArrays;
}

function findFromGlobal(key){
    var globalPorts = JSON.parse(localStorage.getItem("globalPorts"));
    var globalArrays = new Array();
    for(var i=0;i<globalPorts.length;i++){
        if(regEn(key,globalPorts[i].name)){
            globalArrays.push(globalPorts[i].name);
        }
    }
    return globalArrays;
}

function regEn(key,str){
    var re = new RegExp("^"+key);
    return re.test(str);
}

// 首付输入框控制
function first_pay() {
	
	$("#pay-has").attr("checked","checked");
	$("#first-price").val("");
	$("#first-price-2").val("");
	$("#first-price-2").attr("readonly","readonly");
	first_pay_check();
	lookBigImg();
}

function lookBigImg(){
	jQuery.noConflict();
	$("#table").find("img").each(function(){
		$(this).click(function(){
			var img_url = $(this).attr("src");
			$(".big-img").attr("src",img_url);
			$("#big-dialog").modal('show');
		});
	});
}

function first_pay_check(){
	var hide_input_html = '<input style="display:none;" name="order_info[firstpayment_amount]" id="firstpay_real">';
	var order_total = parseFloat($("#order_total").text());
	$('input:radio').change(function(){
		if($("#firstpay_real").length > 0){
			$("#firstpay_real").remove();
		}
		switch($('input:radio:checked').attr("title")){
			case '0':
				$("#first-price").val("");
				$("#first-price-2").val("");
				$("#first-price").attr("readonly","readonly");
				$("#first-price-2").attr("readonly","readonly");
				$("#first-price-hint1").text("");
				$("#first-price-hint2").text("");
				result = 0;
			break;
			case '1':
				$("#first-price").append(hide_input_html);
				$("#first-price").removeAttr("readonly");
				$("#first-price").val("");
				$("#first-price-2").val("");
				$("#first-price-2").attr("readonly","readonly");
				$("#first-price-hint1").text("");
				$("#first-price-hint2").text("");
				$("#first-price").bind('input propertychange', function() { 
					var price = $("#first-price").val();
					if(checkIntType(price) || checkFloatType(price)){
						var i = parseFloat(price);
						$("#first-price-hint1").text("应支付首付款金额为"+  i.toFixed(2) + "元");
						if(i > parseFloat(order_total)){
							$("#first-price-hint1").text("首付款金额不能大于订单总金额！");
							first_pay_flag = false;
						}else if(price < 1){
							$("#first-price-hint1").text("金额不能低于1元！");
							first_pay_flag = false;
						}else{
							$("#firstpay_real").val(i.toFixed(2));
							first_pay_flag = true;

						}
					}else{
						$("#first-price-hint1").text("输入内容必须为正整数或是有效数字为2位的小数，如：10.00");
						first_pay_flag = false;
					}
				});
			break;
			case '2':
				$("#first-price").append(hide_input_html);
				$("#first-price").val("");
				$("#first-price-2").val("");
				$("#first-price").attr("readonly","readonly");
				$("#first-price-2").removeAttr("readonly");
				$("#first-price-hint1").text("");
				$("#first-price-hint2").text("");
				$("#first-price-2").bind('input propertychange', function() {  
					if(checkIntType($("#first-price-2").val())){
						var price2 = parseFloat($("#first-price-2").val());
						var i = parseFloat(price2 * order_total/100);
			        	$("#first-price-hint2").text("应支付首付款金额为"+ price2 + "% * " + order_total + " = " + i.toFixed(2) + "元");
						if(price2 > 100){
							$("#first-price-hint2").text("百分比不能大于100%！");
							first_pay_flag = false;
						}else if(price2 < 1){
							$("#first-price-hint2").text("百分比不能低于1%！");
							first_pay_flag = false;
						}else{
							$("#firstpay_real").val(i.toFixed(2));
							first_pay_flag = true;
						}
					}else{
						$("#first-price-hint2").text("输入内容必须为正整数！");
						first_pay_flag = false;
					}
					
			    });
			break;
		}
	});
	$('input:radio').trigger('change');
}

function empty_state() {

	$('#submit-all-info').click(function(){

		if($('#supplier_principal').val()==''){
			showFailHint("供应商联系人不能为空！");
			$('#supplier_principal').focus();
		}else if($('#supplier_tel').val()==''){
			showFailHint("供应商联系电话不能为空！");
			$('#supplier_tel').focus();
		}else if($('#user_company').val()==''){
			showFailHint("我方公司名不能为空！");
			$('#user_company').focus();
		}else if($('#user_principal').val()==''){
			showFailHint("我方联系人不能为空！");
			$('#user_principal').focus();
		}else if($('#user_tel').val()==''){
			showFailHint("我方联系电话不能为空！");
			$('#user_tel').focus();
		}
		// else if($('#firstpay_real').length > 0 && $('#firstpay_real').val()==''){
		// 	showFailHint("首付款不能为空！");
		// }else if(!first_pay_flag){
		// 	showFailHint("请检查首付款输入是否有误！");
		// }
		else{
			$('#submit-all-info-hidden').click();
		}
	});
	
}

function showFailHint(msg){
    var str = '';
    if($(".hint-dialog_fail").length <= 0){
        str += '<div class="hint-dialog_fail"><p class="hint-info_fail"></p></div>';
        $(".button-div").after(str);
    }
    $(".hint-dialog_fail").css("width",msg.length * 18);
    $(".hint-info_fail").text(msg);
    $(".hint-dialog_fail").show();
    setTimeout("hideFailHint()",3000);
}


function hideFailHint(){
    $(".hint-dialog_fail").hide();
}

function checkIntType(obj) { 
	var int_type = new RegExp("^[0-9]*[1-9][0-9]*$");
	if (int_type.test($.trim(obj))){
		return true; 
	}else{ 
		return false; 
	} 
} 

function checkFloatType(obj){
	var float_type = new RegExp("^\\d+(\\.\\d{2})?$");
	if (float_type.test($.trim(obj))){
		return true; 
	}else{ 
		return false; 
	} 
}

function getElementLeft(element){
　　var actualLeft = element.offsetLeft;
　　var current = element.offsetParent;
　　while (current !== null){
　　　　actualLeft += current.offsetLeft;
　　　　current = current.offsetParent;
　　}
　　return actualLeft;
}

function getElementTop(element){
　　var actualTop = element.offsetTop;
　　var current = element.offsetParent;
　　while (current !== null){
　　　　actualTop += current.offsetTop;
　　　　current = current.offsetParent;
　　}
　　return actualTop;
}