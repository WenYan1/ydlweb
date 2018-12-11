var csrfToken = $('meta[name="csrf-token"]').attr("content");
var suttle_weight = 0.0;
var gross_weight = 0.0;
$(document).ready(function () {
	product_list();
	
	// delete_product();
	
	setSuttleWeight();
	setGrossWeight();
	submitForm();
	edit_product();
	delete_product_item();
	complete_product_item();
	add_product();
	setHideDelete();

	
	numberOnly(".suttle");
	numberOnly(".gross");
	numberOnly(".length");
	numberOnly(".width");
	numberOnly(".height");

	//商品
	productNumberOnly("#length");
	productNumberOnly("#width");
	productNumberOnly("#height");

    searchRateFun();
    loadImage();
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

		var _html = '<li> <div class="number"><p class="font-content-size spacing-left number-space-top">编号：<span id="count">' + count +'</span> - <span class="num">' + (num+1) + '</span></p>'+
                ' <div class="setting"><p class="font-content-size default-blue edit"><a  class="linked delete" " href="javascript:;" id="" >删除</a></p><p class="font-content-size edit-line">|</p>' +
                ' <p class="font-content-size default-blue edit editor" ><a href="javascript:;" class="linked edit" >编辑</a></p></div> </div><div class="pack"><div class="container-fluid">'+
                ' <div class="row "><div class="col-md-4 col-lg-4"><div class="product-message-left space-vertical space--left" id=""><div class=" space-top">'+
                ' <p class="font-content-size font--title title-width">净重(kg):</p> '+'<input type="text"  class="suttle font--content input-padding" name="attr'+ num +'[gross_weight]"></div> <div class="space-top"> <p class="font-content-size font--title title-width">毛重(kg)：</p>'+
                ' <input type="text"  class="gross font--content input-padding" name="attr'+ num +'[net_weight]"> </div> <div class="space-top"><p class="font-content-size font--title title-width">包装箱尺寸(cm)：</p>'+
                ' <input type="text" class="p-input length font--content input-padding" name="attr'+ num +'[goods_long]" placeholder="长度" >'+
                ' <input type="text"  style="margin-left: 7px" class="p-input width font--content input-padding"  name="attr'+ num +'[goods_wide]" placeholder="宽度">' +
                ' <input type="text" style="margin-left: 7px" class="p-input height font--content input-padding"  name="attr'+ num +'[goods_height]" placeholder="高度"> </div><span id="" style="border: 1px solid #4e99b8" class="complete font-content-size">完成</span>' +
                '</div> </div> <div class="row div col-md-4 col-lg-4"><div class="pack-message pack-space-left space-vertical">'+
                ' <p class="content-size spacing-left product-add-tip font--title" >包装箱内物品描述：</p>'+                  
                '<textarea class="spacing-left describe font--content input-padding" rows="3" cols="30" name="attr'+ num +'[attr_describe]" placeholder="请添加不多于二十字的描述信息" style="margin-left: 161px;"></textarea>'+
                ' </div> </div></div></div></div></li>' ;
       
	   changeTotalNum(count);
	   changeCount(count);

	   	$("#product-list ul li .delete").removeClass("complete-hide");
		$("#product-list ul li .edit-line").removeClass("complete-hide");

    	$("#product-list ul").append(_html);
    		$(document).off("click","#product-list ul li .complete");
    		$(document).on("click","#product-list ul li .complete",function(){
				var element = $(this).parent();
				var suttle_weight = element.find(".suttle").val();
				var gross_weight = element.find(".gross").val();
				var length = element.find(".length").val();
				var width = element.find(".width").val();
				var height = element.find(".height").val();
				var describe = element.parent().parent().find(".describe").val();
				var product_id = $("#goods_id").val();
				if(checkData(suttle_weight)) {
					showFailHint('商品净重不能为空');
				}else if(checkData(gross_weight)){
					showFailHint('商品毛重不能为空');
				}else if (checkData(length)) {
					showFailHint("商品长度不能为空");
				}else if (checkData(width)) {
					showFailHint("商品宽度不能为空");
				}else if (checkData(height)) {
					showFailHint("商品高度不能为空");
				}else if(checkData(product_id)){
					showFailHint("商品商品id不能为空!");
				}else if(checkData(describe)){
					showFailHint("商品描述不能为空");
				}else{
					$.ajax({
						url:"add-goods-attr",
						type:"POST",
						data:{"_csrf":csrfToken,"goods_id":product_id,"goods_long":length,"goods_wide":width,"goods_height":height,"gross_weight":gross_weight,"net_weight":suttle_weight,"attr_describe":describe},

						success:function(msg){
							data = JSON.parse(msg)
							if (data.status) {
								// showFailHint(data.message);
								var element_node = element.parents("li");
								element_node.attr("id",data.data.id);
								element_node.find(".delete").attr("id",data.data.id);
								element_node.find(".complete").addClass("complete-edit");
								element_node.find(".complete-edit").removeClass("complete");
								element_node.find(".complete-edit").addClass("complete-hide");
								element.parent().find(".complete-edit").attr("id",data.data.id);
								edit_status_add(element_node,".suttle");
								edit_status_add(element_node,".gross");
								edit_status_add(element_node,".length");
								edit_status_add(element_node,".width");
								edit_status_add(element_node,".height");
								edit_status_add(element_node,".describe");
								getProductMessage();
							}else{
								showFailHint(data.message);
							}
						},
						error:function(data){
							console.log(data.message);
						}

					});
				}

			});
	});
	
    // $("#add-product").click();

    var name = $("#supplier_id option:selected").text().trim();
	$("#supplier_name").val(name);
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
			$("#total-suttle").val(suttle_weight);
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
			$("#total-gross").val(gross_weight);
		});
	});
	
}



// 编辑产品

//修改总箱数
function changeTotalNum(count){
	$("#total-num").val(count);
}
function changeCount(count){
	//修改编号
	    $("#product-list .number #count").each(function(){
	    	$(this).text(count);
	    });
}

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


function getProductMessage(){
	var length = $("#length").val();
	var width = $("#width").val();
	var height = $("#height").val();
	var total_suttle = $("#total-suttle").val();
	var total_gross = $("#total-gross").val();
	var total_num = $("#total-num").val();
	//if (checkData(length)) {
		//showFailHint("长度不能为空");
	//}else if (checkData(width)) {
		//showFailHint("宽度不能为空");
	//}else if (checkData(height)) {
		//showFailHint("高度不能为空");
	//}else if (checkData(total_suttle)) {
	//	showFailHint("净重不能为空");
//	}else if (checkData(total_gross)) {
	//	showFailHint("毛重不能为空");
	//}else if (checkData( total_num)) {
		//showFailHint("总箱数不能为空");
	//}else{
		$("#sumbit-real").click();
	//}
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
			showFailHint('净重不能为空');
		}else if(checkData(gross_weight)){
			showFailHint('毛重不能为空');
		}else if (checkData(length)) {
			showFailHint("长度不能为空");
		}else if (checkData(width)) {
			showFailHint("宽度不能为空");
		}else if (checkData(height)) {
			showFailHint("高度不能为空");
		}
	});
}

function checkData(data){
	return data==null || data.length <=0;
}

//只能输入数字和.
function numberOnly(selector){
	$("#product-list ").find("ul").on("keyup",selector,function(){
		$(this).val($(this).val().replace(/[^0-9.]/g,''));
	});
}

function edit_product(){
	$(document).on("click","#product-list ul li .editor",function(){
		var data = $(this).find("a").html();
		var element = $(this).parent().parent().parent();
		

		if (data == "编辑") {
			$(this).html('<a href="javascript:;" class="linked edit " >取消编辑</a>');
			edit_status_change(element,".suttle");
			edit_status_change(element,".gross");
			edit_status_change(element,".length");
			edit_status_change(element,".width");
			edit_status_change(element,".height");
			edit_status_change(element,".describe");

			net_edit = element.find(".suttle").val();
			gross_edit = element.find(".gross").val();
			length_edit = element.find(".length").val();
			width_edit = element.find(".width").val();
			height_edit = element.find(".height").val();
			describe_edit = element.find(".describe").val();
			$(this).parent().parent().parent().find(".complete-edit").removeClass("complete-hide");
		}else{
			$(this).html('<a href="javascript:;" class="linked edit " >编辑</a>');
			edit_status_add(element,".suttle");
			edit_status_add(element,".gross");
			edit_status_add(element,".length");
			edit_status_add(element,".width");
			edit_status_add(element,".height");
			edit_status_add(element,".describe");

			element.find(".suttle").val(net_edit);
			element.find(".gross").val(gross_edit);
			element.find(".length").val(length_edit);
			element.find(".width").val(width_edit);
			element.find(".height").val(height_edit);
			element.find(".describe").val(describe_edit);

			$(this).parent().parent().parent().find(".complete-edit").addClass("complete-hide");
		}
	});
}

function complete_product_item(){
	$(document).on("click","#product-list ul .complete-edit",function(){
		var element = $(this).parent().parent();
		var suttle_weight = element.find(".suttle").val();
		var gross_weight = element.find(".gross").val();
		var length = element.find(".length").val();
		var width = element.find(".width").val();
		var height = element.find(".height").val();
		var describe = element.parent().find(".describe").val();
		var product_id = $(this).attr("id");
		if(checkData(suttle_weight)) {
			showFailHint('净重不能为空');
		}else if(checkData(gross_weight)){
			showFailHint('毛重不能为空');
		}else if (checkData(length)) {
			showFailHint("长度不能为空");
		}else if (checkData(width)) {
			showFailHint("宽度不能为空");
		}else if (checkData(height)) {
			showFailHint("高度不能为空");
		}else if(checkData(product_id)){
			showFailHint("id不能为空");
		}else if(checkData(describe)){
			showFailHint("描述不能为空");
		}else{
			$.ajax({
				url:"update-goods-attr",
				type:"POST",
				data:{"_csrf":csrfToken,"id":product_id,"goods_long":length,"goods_wide":width,"goods_height":height,"gross_weight":gross_weight,"net_weight":suttle_weight,"attr_describe":describe},

				success:function(msg){
					data = JSON.parse(msg)
					if (data.status) {
								showFailHint(data.message);
								edit_status_add(element,".suttle");
								edit_status_add(element,".gross");
								edit_status_add(element,".length");
								edit_status_add(element,".width");
								edit_status_add(element,".height");
								edit_status_add(element.parent(),".describe");

								element.parent().find(".complete-edit").addClass("complete-hide");
								element.parent().parent().parent().parent().find(".editor").html('<a href="javascript:;" class="linked edit " >编辑</a>');
								getProductMessage();
							}else{
								showFailHint(data.message);
							}
				},
				error:function(data){
					console.log(data.message);
				}

			});
		}

	});
}

function edit_status_change(selector1,selector2){
	selector1.find(selector2).removeClass("delete-border");
	selector1.find(selector2).removeAttr("disabled");
}
function edit_status_add(selector1,selector2){
	selector1.find(selector2).addClass("delete-border");
	selector1.find(selector2).attr("disabled","true");
}
function changeNum(num){
	var index = 1;
	 $("#product-list .number .num").each(function(){
	    	$(this).text(index);
	    	index++;
	    });
}


// 删除已提交的包箱
function delete_product(element){

	$(element).remove();

	// $("#product-list ul li").change(function(){
	// 	showFailHint("change");
	// })
	//修改总净重
		suttle_weight = 0.0;
		gross_weight = 0.0;
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
		var count = $("#product-list ul li").length;
		// showFailHint(count);
		changeTotalNum(count);
		var num = $("#product-list ul li:last").index()+1;
		changeCount(num);
		changeNum(num);
		hide_delete(count);

}

//只有一个包箱时隐藏删除按钮

function hide_delete(count){
	if (count == 1) {
		$("#product-list ul li .delete").addClass("complete-hide");
		$("#product-list ul li .edit-line").addClass("complete-hide");
	}
	
}

function delete_product_item(){
	$(document).off("click","#product-list ul li .delete");
	$(document).on("click","#product-list ul li .delete" ,function(){
		// $(".delete").stopPropagation();
		var num = $(this).parents("ul").children().length;
		var product_id = $(this).parents("li").attr("id");
		console.log(product_id);
		if(checkData(product_id)) {
			delete_item();
		}else{
			$.ajax({
				url:"delete-goods-attr",
				type:"POST",
				data:{"_csrf":csrfToken,"id":product_id},
				success:function(msg){
					data = JSON.parse(msg)
					if (data.status){
								// showFailHint(data.message);
								delete_product("ul li#" + product_id);
								getProductMessage();
							}else{
								console.log(data.message);
							}
					
				},
				error:function(data){
					console.log(data.message);
					showFailHint("error");
				}

			})
		}

	});
}

//删除未提交的包箱
function delete_item(){
		$("#product-list").find("ul").on("click",".delete",function(){
			
					$(this).parent().parent().parent().parent().remove();
					var count = $("#product-list ul li").length;
					changeTotalNum(count);
					changeNum(count);
					changeCount(count);
					hide_delete(count);
					var p = 0;
					$("#product-list ul li").each(function(){
						console.log("p ：" + p);
						$(this).find(".num").text(p + 1);
						var i = 0;
						$(this).find("input").each(function(){
							console.log("i ：" + i);
							if(i == 0){
								$(this).attr("name","attr"+ p +"[gross_weight]");
							}else if(i == 1){
								$(this).attr("name","attr"+ p +"[net_weight]");
							}else if(i == 2){
								$(this).attr("name","attr"+ p +"[goods_long]");
							}else if(i == 3){
								$(this).attr("name","attr"+ p +"[goods_wide]");
							}else{
								$(this).attr("name","attr"+ p +"[goods_height]");
							}
							i++;
						});
						//$(this).find("textarea").attr("name","attr"+ p +"[describe]");
						p++;
					});
					suttle_weight = 0.0;
					gross_weight = 0.0;

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
		
		
		});
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

