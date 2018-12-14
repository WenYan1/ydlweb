$(document).ready(function(){
	search();
	// 下拉框状态设定
	setStatus();
	// 回车事件
	backFun();

    bindSettlementType();
});

function backFun(){
	$('input').bind('keypress',function(event){
		if(event.keyCode == "13")    
		{
			$('.search-button').click();
		}
	});
}

function setStatus(){
	var state = parseInt($("#state_num").val());
	$("#order_status option[value=" + state + "]").attr("selected","true");

	var state_firstpay = parseInt($("#state_firstpay").val());
	$("#first_pay option[value=" + state_firstpay + "]").attr("selected","true");
}

function search(){
	$(".search-button").click(function(){
		var order_number = $("#order_number").val();
		var order_status = $("#order_status").val();
		var start_time = $("#start_time").val();
		var end_time = $("#end_time").val();
		var user_account = $("#user_account").val();
		var supplier_manage = $("#supplier_manage").val();
		var first_pay = $("#first_pay").val();

		if (order_number.length != 0) {
			$('#order_number').val($.trim(order_number));
			$("#order_number").attr("name","order_sn");
		}
		if (order_status.length != 0) {
			$('#order_status').val($.trim(order_status));
			$("#order_status").attr("name","state");
		}
		if (start_time.length != 0) {
			$('#start_time').val($.trim(start_time));
			$("#start_time").attr("name","start_time");
		}
		if (end_time.length != 0) {
			$('#end_time').val($.trim(end_time));
			$("#end_time").attr("name","end_time");
		}
		if (user_account.length != 0) {
			// $('#user_account').val($.trim(user_account));
			$("#user_account").attr("name","email");

		}
		if (supplier_manage.length != 0) {
			$('#supplier_manage').val($.trim(supplier_manage));
			$("#supplier_manage").attr("name","supplier_name");
		}
		if (first_pay.length != 0) {
			$('#first_pay').val($.trim(first_pay));
			$("#first_pay").attr("name","down_payment");
		}
		$('#submit').click();
	});
}

function bindSettlementType() {
    $(".table-border").on("blur","[data-settlement-type='true']",function () {
        var id = $(this).attr("data-order-id");
        var val = $(this).val();
        var csrfToken = $("#_csrf").val();

        $.post("/ydlbam/order/change-settlement-type",
            {
                "order_id":id,
                "settlement_type":val,
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

    $(".table-border").on("change","[data-service-type='true']",function () {
        var id = $(this).attr("data-order-id");
        var val = $(this).val();
        var csrfToken = $("#_csrf").val();

        $.post("/ydlbam/order/change-service-type",
            {
                "order_id":id,
                "service_type":val,
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