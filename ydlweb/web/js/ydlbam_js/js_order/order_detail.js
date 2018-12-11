var csrfToken = $('meta[name="csrf-token"]').attr("content");
$(function(){
	// 设置下拉框状态
	set_status();
	// 请求
	change_status();

    bindFk();
})

function set_status(){
	var state = parseInt($(".order_state").attr("id"));
	$("#select_state option[value=" + state + "]").attr("selected","true");
}


function change_status(){
	$("#sure-edit").click(function(){
		var state = $("#select_state option:selected").val();
		var order_id = $("#order_id").val();
		if (state.length == 0) {
			alert("订单状态为空！");
		}else if(order_id.length == 0){
			alert("订单id为空！");
		}else{
			$.ajax({
				type:"POST",
				url:"/ydlbam/order/auditing-order",
				data:{"order_id":order_id,"state":state,'_csrf':csrfToken},
				success:function(msg){
					var data = JSON.parse(msg);
					if (data.status) {
						window.location.reload();
					}else{
						alert(data.message);
					}
				},
				error:function(msg){
					alert(msg);
				}
			})
		}
	});
}

function bindFk() {
    $(".main-content").on("blur","[data-fk='true']",function () {
        var id = $(this).attr("data-id");
        var val = $(this).val();
        var name = $(this).attr('name');
        var csrfToken = $('meta[name="csrf-token"]').attr("content");

        $.post("/ydlbam/order/change-fk",
            {
                "order_id":id,
                "val":val,
                "name":name,
                "_csrf":csrfToken
            },
            function(data){
                var contentData = $.parseJSON(data);
                if (contentData.state == 1){
                    art.dialog.tips("操作成功");
                }else{
                    art.dialog.tips("操作失败，稍后重试");
                }
            });
    });
}





