var csrfToken = $('meta[name="csrf-token"]').attr("content");
$(document).ready(function(){
	changeStatus();
	setStatus();
	jQuery.noConflict();
	showImg();
});
function changeStatus(){
	$("#change_state").click(function(){
		var state = $("#option_state option:selected").val();
		var goods_id = $("#goods-hide").val();
		var state_text = $("#option_state option:selected").text();
		if (state.length == 0) {
			alert("供应商状态为空！");
		}else if(goods_id.length == 0){
			alert("供应商id为空！");
		}else{
			$.ajax({
				type:"POST",
				url:"/ydlbam/goods/auditing-goods",
				data:{"goods_id":goods_id,"state":state,'_csrf':csrfToken},
				success:function(msg){
					var data = JSON.parse(msg);
					if (data.status) {
						$(".status-ing").text(state_text);
					}else{
						alert("error:" + data.message);
					}

				},
				error:function(msg){
					alert("error:" + msg);
				}
			});
		}
	});

}

function setStatus(){
	var state = parseInt($(".status-ing").attr("id"));
	$("#option_state option[value=" + state + "]").attr("selected","true");
}
function showImg(){
	$("#product_img").click(function(){
		$("#product-dialog").modal('show');
	});
}