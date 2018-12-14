var suttle_weight = 0.0;
var gross_weight = 0.0;
var total_volume = 0.0;
var csrfToken = $('meta[name="csrf-token"]').attr("content");
$(document).ready(function () {
	product_list();
	add_product();
	delete_product();
	setSuttleWeight();
	setGrossWeight();
	setTotalVolume();
	loadImage();
	//包箱
	numberOnly(".suttle");
	numberOnly(".gross");
	numberOnly(".length");
	numberOnly(".width");
	numberOnly(".height");

	//商品
	productNumberOnly("#length");
	productNumberOnly("#width");
	productNumberOnly("#height");
	submitForm();
	setHideDelete();

	searchRateFun();
});

function searchRateFun(){
	$('#search-rate').click(function(){
		var rate = $('#hs-code').val();
		if (rate=='') {
			showFailHint('HScode不能为空');
		}else{
			$.ajax({
				url: '/goods/tax-tsl',
				type: "post",
				async: true,
				data: {
					hscode:rate,
					"_csrf":csrfToken
				},
				dataType: "json",
				headers: {
					'X-CSRF-Token': $('meta[name=_token]').attr('content')
				},
				error: function() {
					alert('error');
				},
				success: function(data) {
					if (data.status) {
						$('#goods-rate').val(data.data['tsl']);
					}else{
						$('#goods-rate').val(data.message);
					}
				}
			})
		}
	})
}

//只能输入数字和.
function numberOnly(selector){
	$("#product-list ").find("ul").on("keyup",selector,function(){
		$(this).val($(this).val().replace(/[^0-9.]/g,''));
	});
}
//商品
function productNumberOnly(selector){
	$(selector).keyup(function(){
		$(this).val($(this).val().replace(/[^0-9.]/g,''));
	});
}

function submitForm(){

	$(".submit-button").click(function(){

		getProductMessage();
		
	});
}
function setHideDelete(){
	var count = $("#product-list ul li").length;
	hide_delete(count);
}
// 产品列表
function product_list(){

}
// 添加产品
function add_product(){
	var i = 1;
	var num,count=1;
	
	$("#add-product").click(function(){
		num = $("#product-list ul li:last").index()+1;
		count = $("#product-list ul li").length + 1;

		$("#product-list ul li .delete").removeClass("complete-hide");

		var _html = '<li> <div class="number"><p class="font-content-size spacing-left number-space-top">编号：<span id="count">' + count +'</span> - <span class="num">' + (num+1) + '</span></p>'+
		' <div class="setting"><p class="font-content-size default-blue edit"><a href="javascript:;" class="linked delete" >删除</a></p>' +
		' </div> </div><div class="pack"><div class="container-fluid">'+
		' <div class="row "><div class="col-md-4 col-lg-4"><div class="product-message-left space-vertical space--left" id=""><div class=" space-top">'+
		' <p class="font-content-size font--title title-width">单个商品净重(kg):</p> '+'<input type="text"  class="suttle font--content input-padding" name="attr'+ num +'[net_weight]" required></div> <div class="space-top"> <p class="font-content-size font--title title-width">单个毛重(kg)：</p>'+
		' <input type="text"   class="gross font--content input-padding" name="attr'+ num +'[gross_weight]" required> </div> <div class="space-top"><p class="font-content-size font--title title-width">单个产品尺寸(cm)：</p>'+
		' <input type="text"  class="p-input length font--content input-padding" name="attr'+ num +'[goods_long]" placeholder="长度"  required>'+
		' <input type="text" style="margin-left: 7px" class="p-input width font--content input-padding"  name="attr'+ num +'[goods_wide]" placeholder="宽度" required>' +
		' <input type="text" style="margin-left: 7px" class="p-input height font--content input-padding" name="attr'+ num +'[goods_height]" placeholder="高度" required> </div><span id="write-product-info" style="border: 1px solid #4e99b8" class="complete complete-hide font-content-size">完成</span>' +
		'</div> </div> <div class="row div col-md-4 col-lg-4"><div class="pack-message pack-space-left space-vertical">'+
		' <p class="content-size spacing-left product-add-tip font--title" >包装箱内物品描述：</p>'+                  
		'<textarea class="spacing-left describe font--content input-padding" rows="3" cols="30" name="attr'+ num +'[attr_describe]" placeholder="请添加不多于二十字的描述信息" style="margin-left: 161px;" required></textarea>'+
		' </div> </div></div></div></div>  </li>' ;

		changeTotalNum(count);
		changeNum(count);
		$("#product-list ul").append(_html);
	});
	
	$("#add-product").click();

	
}

function setSuttleWeight(){

	$("#product-list ").find("ul").on("change",".suttle",function(){
		suttle_weight = 0.0;
		$("#product-list ul li ").each(function(){
			var weight = $(this).find(".suttle").val();
			if (weight == null || weight == "") {
				weight = 0;
			}
			suttle_weight += parseFloat(weight);
			$("#total-suttle").val(suttle_weight.toFixed(2));
		});
	});
}
function setGrossWeight(){

	$("#product-list ").find("ul").on("change",".gross",function(){
		gross_weight = 0.0;
		$("#product-list ul li ").each(function(){
			var weight = $(this).find(".gross").val();
			if (weight == null || weight == "") {
				weight = 0;
			}
			gross_weight += parseFloat(weight);
			$("#total-gross").val(gross_weight.toFixed(2));
		});
	})
	
}
function setTotalVolume(){

	$("#product-list ").find("ul").on("change",".length",function(){
		total_volume = 0.0;
		changeVolume();
	});
	$("#product-list ").find("ul").on("change",".width",function(){
		total_volume = 0.0;
		changeVolume();
	});
	$("#product-list ").find("ul").on("change",".height",function(){
		total_volume = 0.0;
		changeVolume();
	});
}

function changeVolume(){
	$("#product-list ul li ").each(function(){
			/*var weight = $(this).find(".suttle").val();
			if (weight == null || weight == "") {
				weight = 0;
			}suttle_weight += parseFloat(weight);
			$("#total-suttle").val(suttle_weight);*/

			var length = $(this).find(".length").val();
			var width = $(this).find(".width").val();
			var height = $(this).find(".height").val();
			
			if(length == null || length == ""){
				length = 0
			}
			if(width == null || width == ""){
				width = 0
			}
			if(height == null || height == ""){
				height = 0
			}
			total_volume += parseFloat(length)*parseFloat(width)*parseFloat(height);
			$("#total-volume").val(total_volume.toFixed(2));
		});
}
//只有一个包箱时隐藏删除按钮
function hide_delete(count){
	if (count == 1) {
		$("#product-list ul li .delete").addClass("complete-hide");
	}
	
}

// 删除包箱
function delete_product(){
	$(document).off("click","#product-list ul .delete");
	$(document).on("click","#product-list ul .delete",function(){
		
		$(this).parent().parent().parent().parent().remove();
		var count = $("#product-list ul li").length;
		changeTotalNum(count);
		changeNum(count);
		hide_delete(count);
		var p = 0;
		$("#product-list ul li").each(function(){
					//console.log("p ：" + p);
					$(this).find(".num").text(p + 1);
					var i = 0;
					$(this).find("input").each(function(){
						console.log("i ：" + i);
						if(i == 0){
							$(this).attr("name","attr"+ p +"[net_weight]");
						}else if(i == 1){
							$(this).attr("name","attr"+ p +"[gross_weight]");
						}else if(i == 2){
							$(this).attr("name","attr"+ p +"[goods_long]");
						}else if(i == 3){
							$(this).attr("name","attr"+ p +"[goods_wide]");
						}else{
							$(this).attr("name","attr"+ p +"[goods_height]");
						}
						i++;
					});
					$(this).find(".describe").attr("name","attr"+ p +"[attr_describe]");
					//$(this).find("textarea").attr("name","attr"+ p +"[describe]");
					p++;
				});
		suttle_weight = 0.0;
		gross_weight = 0.0;
		total_volume = 0.0;

				//修改总净重
				$("#product-list ul li").each(function(){
					var weight = $(this).find(".suttle").val();
					if (weight == null || weight == "") {
						weight = 0;
					}
					suttle_weight += parseFloat(weight);
					$("#total-suttle").val(suttle_weight);
				});
				//修改总毛重
				$("#product-list ul li").each(function(){
					var weight = $(this).find(".gross").val();
					if (weight == null || weight == "") {
						weight = 0;
					}
					gross_weight += parseFloat(weight);
					$("#total-gross").val(gross_weight);
				});
				//修改总体积
				changeVolume();


			});
	
}

//修改总箱数
function changeTotalNum(count){
	$(".background-white .message .row .total-middle .total .total-box #total-num").val(count);
}
function changeNum(count){
	//修改编号
	$("#product-list .number #count").each(function(){
		$(this).text(count);
	});
}
//加
function getPlusWeight(weight,category){
	if (category === "suttle") {
		suttle_weight += parseFloat(weight);
		$("#total-suttle").val(suttle_weight);
	}else{
		gross_weight += weight;
	}
}
//减
function getDecrWeight(weight,category){
	if (category == "suttle") {
		suttle_weight += weight;
		$("#total-suttle").val(suttle_weight);
	}else{
		gross_weight += weight;
	}
}
//添加商品图片
function loadImage(){
	$("#product_image").click(function(){
		$("#up_image").click();
	});
	$("#up_image").change(function(){
		var src = window.URL.createObjectURL(this.files[0]);
		var path = $("#up_image").val();
		var bool = imageSize(path);
		if (bool) {
			$("#product_image").attr("src",src);
			$("#up_image").attr("src",src);
		}
		
	});
}

function imageSize(argument) {
	var filepath= argument;
	var extStart=filepath.lastIndexOf(".");
	var ext=filepath.substring(extStart,filepath.length).toUpperCase();

	if(ext!=".BMP"&&ext!=".PNG"&&ext!=".GIF"&&ext!=".JPG"&&ext!=".JPEG"){
		alert("图片限于bmp,png,gif,jpeg,jpg格式");
		return false;
	}

	var fileSize = document.getElementById("up_image").files[0].size;
	if(fileSize>1024 * 1024){      
		alert("图片不能大于1M。");
		return false;
	}
	return true;
}

function getProductMessage(){
	var name = $("#supplier_id option:selected").text().trim();
	console.log("name: " + name);
	$("#supplier_name").val(name);
	var product_name = $("#product-name").val().trim();
	var product_code = $("#product-name").val();
	var length = $("#length").val();
	var width = $("#width").val();
	var height = $("#height").val();
	var total_suttle = $("#total-suttle").val();
	var total_gross = $("#total-gross").val();
	var total_num = $("#total-num").val();
	var product_image = $("#up_image").attr("src");
	if (checkData(product_name)) {
		showFailHint('商品名称不能为空！');
	}else if (checkData(product_code)) {
		showFailHint("HS code 不能为空！");
	}
	//else if (checkData(length)) {
	//	showFailHint("长度不能为空！");
	//}else if (checkData(width)) {
		//showFailHint("宽度不能为空！");
	//}else if (checkData(height)) {
		//showFailHint("高度不能为空！");
	//}else if (checkData(total_suttle)) {
		//showFailHint("净重不能为空！");
	//}else if (checkData(total_gross)) {
		//showFailHint("毛重不能为空！");
	//}else if (checkData( total_num)) {
		//showFailHint("总箱数不能为空！");
	//}
	else if (checkData(product_image)) {
		showFailHint("请选择图片！");
	}else{
		$("#sumbit-real").click();
	}
}
function getBoxMessage(){
	$("#product-list ul li ").each(function(){
		var suttle_weight = $(this).find(".suttle").val();
		var gross_weight = $(this).find(".gross").val();
		var length = $("#product-list ul li .length").val();
		var width = $("#product-list ul li .width").val();
		var height = $("#product-list ul li .height").val();
		var describe = $("#product-list ul li .describe").val();
		if(checkData(suttle_weight)) {
			showFailHint('净重不能为空！');
		}else if(checkData(gross_weight)){
			showFailHint('毛重不能为空！');
		}else if (checkData(length)) {
			showFailHint("长度不能为空！");
		}else if (checkData(width)) {
			showFailHint("宽度不能为空！");
		}else if (checkData(height)) {
			showFailHint("高度不能为空！");
		}
	});
}

function checkData(data){
	return data==null || data.length <=0;
}

function suttleNumberOnly(){
	$("#product-list ").find("ul").on("keyup",".suttle",function(){
		$(this).val($(this).val().replace(/[^0-9.]/g,''));
	})
}
function grossNumberOnly(){
	$("#product-list ").find("ul").on("keyup",".gross",function(){
		$(this).val($(this).val().replace(/[^0-9.]/g,''));
	})
}

function showFailHint(msg){
	var str = '';
	if($(".hint-dialog_fail").length <= 0){
		str += '<div class="hint-dialog_fail"><p class="hint-info_fail"></p></div>';
		$(".submit").after(str);
	}
	$(".hint-dialog_fail").css("width",msg.length * 18);
	$(".hint-info_fail").text(msg);
	$(".hint-dialog_fail").show();
	setTimeout("hideFailHint()",3000);
}


function hideFailHint(){
	$(".hint-dialog_fail").hide();
}

