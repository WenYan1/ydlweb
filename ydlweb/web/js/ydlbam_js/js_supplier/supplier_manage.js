$(document).ready(function(){
	search();
	setStatus();
	enter_search();
    bindAllowance();
});

function enter_search(){
	$(document).keyup(function(event){
		if (event.keyCode === 13) {
			start_search();
		}
	});
}

function search(){
	$(".search-button").click(function(){
		start_search();
	});

}

function start_search(){
	var supplier = $("#supplier").val();
		var user_account = $("#user_account").val();
		var product_status = $("#product_status option:selected").val();
		var page = $("#page").val();

		if (supplier.length == 0) {
			$("#supplier").removeAttr("name");
		}
		if (user_account.length == 0) {
			$("#user_account").removeAttr("name");
		}

		if (product_status.length == 0) {
			$("#product_status").removeAttr("name");
		}

		if (page.length == 0) {
			$("#page").removeAttr("name");
		}

		$("#submit").click();
}

function setStatus(){
	var state = parseInt($("#state_num").val());
	$("#product_status option[value=" + state + "]").attr("selected","true");
}


function bindAllowance() {
    $(".table-border").on("blur","[data-allowance-type='true']",function () {
        var id = $(this).attr("data-id");
        var val = $(this).val();
        var csrfToken = $("#_csrf").val();

        $.post("/ydlbam/supplier/change-sllowance",
            {
                "id":id,
                "allowance":val,
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