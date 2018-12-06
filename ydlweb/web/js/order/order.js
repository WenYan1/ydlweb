// create by feng

/*********************

提交订单第一步js

**********************/
var j;//指向jQuery
var num;
var csrfToken = $('meta[name="csrf-token"]').attr("content");
var img_source = "/uploads/";
$(document).ready(function(){
	load();
	calc_total();
	first_add_goods();
	choose_supplier();
});

// 第一次进来加载数据
function load() {
	var id = $(".option-supplier").val();
	$.ajax({
		url: 'supplier-goods',
		type: "post",
		async: true,
		data: {
			supplier_id:id,
			"_csrf":csrfToken
		},
		dataType: "json",
		headers: {
			'X-CSRF-Token': $('meta[name=_token]').attr('content')
		},
		error: function() {
			showFailHint('something was wrong');
		},
		success: function(data) {
			
			if (data.status) {
				$('tbody').children().remove();
					for (var i = data.data.length - 1; i >= 0; i--) {
						var _html = "<tr>";
						_html +="<td>"+"<input class='test' name='test' type='checkbox'/>"+"</td>"
						+"<td class='product-number'>"+(data.data[i].id)+"</td>"
						+"<td class='product-image'>"+"<a target='_Blank' href='"+img_source + data.data[i].goods_image+"'><img style='height='40' width='60' value='"+(data.data[i].goods_image)+"' src='"+(img_source + data.data[i].goods_image)+"'></a></td>"
						+"<td class='product-name'>"+(data.data[i].goods_name)+"</td>"
						+"<td style='display:none;' class='goods-volume'>"+(data.data[i].goods_volume)+"</td>"
						+"<td class='mao-weight'>"+(data.data[i].gross_weight)+"</td>"
						+"<td class='jing-weight'>"+(data.data[i].net_weight)+"</td>"
						+"<td class='box-number'>"+(data.data[i].box_number)+"</td>"
						+"<td class='price'>"+"<input class='input-padding' type='text' style='width: 100px' value='"+ data.data[i].original_price +"'/>"+"</td>"
						+"<td class='count'>"+"<input class='input-padding' type='text' style='width: 50px' />"+"</td>"
							+"<td class='hs_code'>"+"<input type='hidden' value='"+ data.data[i].hs_code +"'/>"+"</td>"
							+"<td class='goods_taxrate'>"+"<input type='hidden' value='"+ data.data[i].goods_taxrate +"'/>"+"</td>"
						+"</tr>";
						$('tbody').append(_html);
					}
					bindInputListener();
			} else {
				showFailHint('选用经历失败，请刷新重试');
			}
		}
	})
}

function bindInputListener(){

	$("input[type=checkbox]").change(function() {
		calc_total();
	});
	$("input[type=text]").bind('input propertychange', function() {  
        calc_total();
    });
}

// 计算总价，总净重，总毛重，总箱数，总数量
function calc_total() {
	var unit_price = parseFloat(0);
	var net_weight_count = parseFloat(0);
	var gross_weoght_count = parseFloat(0); 
	var total_box_count = parseFloat(0);
	var total_count = parseFloat(0);
	var total_volume = parseFloat(0);

	$("td").find("input[type=checkbox]:checked").each(function(){

		var price_val = $(this).parent().siblings('.price').children().val();
		if(price_val == ""){
			price_val = 0;
		}
		var count_val = $(this).parent().siblings('.count').children().val();
		if(count_val == ""){
			count_val = 0;
		}
		var goods_volume = $(this).parent().siblings('.goods-volume').children().val();
		var mao_weight_val = $(this).parent().siblings('.mao-weight').children().val();
		var jing_weight_val = $(this).parent().siblings('.jing-weight').children().val();
		var box_number_val = $(this).parent().siblings('.box-number').children().val();

		unit_price += parseFloat(price_val)*parseFloat(count_val);
		gross_weoght_count +=  parseFloat(mao_weight_val);
		net_weight_count +=  parseFloat(jing_weight_val);
		total_box_count +=  parseFloat(box_number_val);
		total_count +=  parseFloat(count_val);
		total_volume += parseFloat(goods_volume);

		$('#total-price').text(unit_price.toFixed(2));
		$('#net-weight').text(net_weight_count.toFixed(2));
		$('#gross-weoght').text(gross_weoght_count.toFixed(2));
		$('#total-box').text(total_box_count);
		$('#total-quantity').text(total_count);
		$('#total-volume').text('');		
	});

}

function calc_total_final(){
	var unit_price = parseFloat(0);
	var net_weight_count = parseFloat(0);
	var gross_weoght_count = parseFloat(0); 
	var total_box_count = parseFloat(0);
	var total_count = parseFloat(0);
	var total_volume = parseFloat(0);
	cyslecheck = $("input[name='cycledays90']:checked").val();
	num = 0;
	$("td").find("input[type=checkbox]:checked").each(function(){
		num ++ ;
	});

	var each_num = 0;
	$("td").find("input[type=checkbox]:checked").each(function(){
		var val_tmp1 = $(this).parent().siblings('.price').children().val();
		var val_tmp2 = $(this).parent().siblings('.count').children().val();
		if ($.trim(val_tmp1) =='') {
			showFailHint("商品价格不能为空！");
			$(this).parent().siblings('.price').children().focus();
		} else if($.trim(val_tmp2) ==''){
			showFailHint("商品数量不能为空！");
			$(this).parent().siblings('.count').children().focus();
		} else if(!checkIntType(val_tmp1) && !checkFloatType(val_tmp1)){ 
			showFailHint("商品价格必须为整数或精确度为小数点后2位的有效数字！");
		} else if(!checkIntType(val_tmp2)){
			showFailHint("商品数量必须为整数！");
		} else if(checkNotZero(val_tmp1)){
			showFailHint("商品价格不能为零！");
			$(this).parent().siblings('.price').children().focus();
		} else if(checkNotZero(val_tmp2)){
			showFailHint("商品数量不能为零！");
			$(this).parent().siblings('.price').children().focus();
		}else{
			each_num ++;
			
			var price_val = $(this).parent().siblings('.price').children().val();
			if(price_val == ""){
				price_val = 0;
			}
			var count_val = $(this).parent().siblings('.count').children().val();
			if(count_val == ""){
				count_val = 0;
			}
			var goods_volume = $(this).parent().siblings('.goods-volume').text();
			var mao_weight_val = $(this).parent().siblings('.mao-weight').children().val();
			var jing_weight_val = $(this).parent().siblings('.jing-weight').children().val();
			var box_number_val = $(this).parent().siblings('.box-number').children().val();

			unit_price += parseFloat(price_val)*parseFloat(count_val);
			gross_weoght_count +=  parseFloat(mao_weight_val);
			net_weight_count +=  parseFloat(jing_weight_val);
			total_box_count +=  parseFloat(box_number_val);
			total_count +=  parseFloat(count_val);
			total_volume += parseFloat(goods_volume);

			$('#total-price').text(unit_price.toFixed(2));
			$('#net-weight').text(net_weight_count.toFixed(2));
			$('#gross-weoght').text(gross_weoght_count.toFixed(2));
			$('#total-box').text(total_box_count);
			$('#total-quantity').text(total_count);
			$('#total-volume').text('');
		}									
	});
	if(num == 0){
		showFailHint("需要勾选至少一件商品！");
	}else if(num == each_num ){
		goToNextStep();
	}
}

function goToNextStep(){
	var supplier_id;
		var supplier_name;
		var product = new Array();
		var order_total;
		var net_weight;
		var total_volume;
		var gross_weoght;
		var total_box;
		var total_quantity;	
		var total_price;
		var cycledays;
		supplier_id=$('.option-supplier').find("option:selected").val();
		supplier_name=$('.option-supplier').find("option:selected").html();
		total_price=$('#total-price').html();
		order_total=$('#total-price').text();
		total_volume=$('#total-volume').text();
		net_weight=$('#net-weight').text();
		gross_weoght=$('#gross-weoght').text();
		total_box=$('#total-box').text();
		total_quantity=$('#total-quantity').text();
		
		$('input[name="test"]:checked').each(function(){    
				var data = {
					product_number:$(this).parents().siblings('.product-number').text(),
					product_image:$(this).parents().siblings('.product-image').children().children().attr("value"),
					product_name:$(this).parents().siblings('.product-name').text(),
					gross_weoght:$(this).parents().siblings('.mao-weight').children().val(),
					net_weight:$(this).parents().siblings('.jing-weight').children().val(),
					single_box:$(this).parents().siblings('.box-number').children().val(),
					single_prince:$(this).parents().siblings('.price').children().val(),
					put_box_number:$(this).parents().siblings('.count').children().val(),
					hs_code:$(this).parents().siblings('.hs_code').children().val(),
					goods_taxrate:$(this).parents().siblings('.goods_taxrate').children().val(),
				};
				console.log(data+"111");
				
				product.push(data);
		});
		
		//获取结汇周期
		cyslecheck = $(".test:checked").val();
			$.post("add-first-step",
					{
						supplier_id:supplier_id,
						supplier_name:supplier_name,
						total_price:total_price,
						product:product,
						order_total:order_total,
						total_volume:total_volume,
						net_weight:net_weight,
						gross_weight:gross_weoght,
						total_box:total_box,
						total_quantity:total_quantity,
						settlement_cycle:cycledays,
						"_csrf":csrfToken
					},
			function(data){
				//showFailHint(data);
			});
		
}

// 添加订单第一步
function first_add_goods() {
	$('#next-step').click(function(){
		calc_total_final();
	});
}




// 选择供应商接口
function choose_supplier() {
	$('.option-supplier').change(function(){
		var id = $(this).find("option:selected").val();
		$.ajax({
			url: 'supplier-goods',
			type: "post",
			async: true,
			data: {
				supplier_id:id,
				"_csrf":csrfToken
			},
			dataType: "json",
			headers: {
				'X-CSRF-Token': $('meta[name=_token]').attr('content')
			},
			error: function() {
				showFailHint('something was wrong');
			},
			success: function(data) {
				if (data.status) {
					$('tbody').children().remove();
					for (var i = data.data.length - 1; i >= 0; i--) {
						var _html = "<tr>";
						_html +="<td>"+"<input class='test' name='test' type='checkbox'/>"+"</td>"
						+"<td class='product-number'>"+(data.data[i].id)+"</td>"
						+"<td class='product-image'>"+"<a target='_Blank' href='" + img_source + data.data[i].goods_image + "'><img style='cursor:pointer;' height='40' width='60' value='"+(data.data[i].goods_image)+"' src='"+(img_source + data.data[i].goods_image)+"'></a>"+"</td>"
						+"<td class='product-name'>"+(data.data[i].goods_name)+"</td>"
						+"<td style='display:none;' class='goods-volume'>"+(data.data[i].goods_volume)+"</td>"
						+"<td class='mao-weight'>"+"<input class='input-padding' type='text' style='width: 100px' value=''/>"+"</td>"
						+"<td class='jing-weight'>"+"<input class='input-padding' type='text' style='width: 100px' value=''/>"+"</td>"
						+"<td class='box-number'>"+"<input class='input-padding' type='text' style='width: 100px' value=''/>"+"</td>"
						+"<td class='price'>"+"<input class='input-padding' type='text' style='width: 100px' value='"+ data.data[i].original_price +"'/>"+"</td>"
						+"<td class='count'>"+"<input class='input-padding' type='text' style='width: 50px'/>"+"</td>"
							+"<td class='hs_code'>"+"<input type='hidden' value='"+ data.data[i].hs_code +"'/>"+"</td>"
							+"<td class='goods_taxrate'>"+"<input type='hidden' value='"+ data.data[i].goods_taxrate +"'/>"+"</td>"
						+"</tr>";

						$('tbody').append(_html);
					}
					bindInputListener();
				} else {
					showFailHint('选用经历失败，请刷新重试');
				}

			}
		})
	})

}

function showSuccessHint(msg){
    var str = '';
    if($(".hint-dialog_success").length <= 0){
        str += '<div class="hint-dialog_success"><p class="hint-info_success"></p></div>';
        $("#next-step").after(str);
    }
    $(".hint-dialog_success").css("width",msg.length * 24);
    $(".hint-info_success").text(msg);
    $(".hint-info_success").show();
    setTimeout("hideSuccessHint()",3000);
}


function hideSuccessHint(){
    $(".hint-dialog_success").hide();
}

function showFailHint(msg){
    var str = '';
    if($(".hint-dialog_fail").length <= 0){
        str += '<div class="hint-dialog_fail"><p class="hint-info_fail"></p></div>';
        $("#next-step").after(str);
    }
    $(".hint-dialog_fail").css("width",msg.length * 24);
    $(".hint-info_fail").text(msg);
    $(".hint-dialog_fail").show();
    setTimeout("hideFailHint()",3000);
}


function hideFailHint(){
    $(".hint-dialog_fail").hide();
}

function checkNotZero(data){
    return $.trim(data) == 0;
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

