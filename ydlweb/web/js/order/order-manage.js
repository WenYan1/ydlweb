
var csrfToken = $('meta[name="csrf-token"]').attr("content");
$(function(){
	request_status();
	request_search();
    bindSettlementType();
});
// 获取地址栏参数 
function GetQueryString(name) { 
	var reg = new RegExp("(^|&)"+ name +"=([^&]*)(&|$)"); 
	var r = window.location.search.substr(1).match(reg); 
	if(r!=null)return  unescape(r[2]); return null; 
} 
// 状态的请求
function request_status() {
	$('#search-hide').remove();
	var val_state=GetQueryString("state"); 
	console.log(val_state);
	if (val_state==0) {
		$('select')[0].selectedIndex = 1;
		request();
	} else if(val_state==null){
		$('select')[0].selectedIndex = 0;
		request();
	} else if(val_state==1){
		location.href='/order'
	}else {
		// $('select#order-status')[0].selectedIndex = val_state;
		$("select#order-status").find('option[value='+val_state+']').attr("selected",true);
		request();
	}
	function request(){
		$("#order-status").change(function(){
			$('#state-hide').val($(this).val());
			$("#request-btn").click();	
		});
	}	
}
// 搜索的请求
function request_search() {
	$('.search-btn').click(function() {
		var search_val = $('.write-supply-name').val();
		$('form').append("<input id='search-hide' type='hidden' name='search'/>");
		var content = $('.write-supply-name').val();
		$('#search-hide').val(content);
		$("#request-btn").click();
	})
}

function bindSettlementType() {
    $("#table").on("blur","[data-settlement-type='true']",function () {
        var id = $(this).attr("data-order-id");
        var val = $(this).val();
        var csrfToken = $("#_csrf").val();

        $.post("/order/change-settlement-type",
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
}

