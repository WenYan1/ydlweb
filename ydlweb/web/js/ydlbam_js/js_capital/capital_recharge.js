var csrfToken = $('meta[name="csrf-token"]').attr("content");
$(document).ready(function(){
	$(".capital-child").css("display","block");
	$(".capital-child").show(500);
	$(".search-button").click(function(){
		checkData();
	});
	aboutAgree();
    bind_exchange_rate();
});

function aboutAgree(){
	$(".agree").each(function(){
		$(this).click(function(){
			$(this).parent().parent().find(".td-id").each(function(){
				var id_val = $(this).text();
				$.post("/ydlbam/capital/auditing-recharge"
					,{
						id:id_val,
						state:1,
						_csrf:csrfToken
					},function(data){
					 var data = $.parseJSON(data);
					if (data.status === false){
						alert(data.message);
					}else{
                        history.go(0);
					}

					});
			});
		});
	});
	$(".disagree").each(function(){
		$(this).click(function(){
			$(this).parent().parent().find(".td-id").each(function(){
				var id_val = $(this).text();
				$.post("/ydlbam/capital/auditing-recharge"
					,{
						id:id_val,
						state:-1,
						_csrf:csrfToken
					},function(data){
						history.go(0);
					});
			});
		});
	});
}

function checkData(){
	var email = $("#email").val();
	var start_time = $("#start_time").val();
	var end_time = $("#end_time").val();

	if(isNull(email)){
		$("#email").removeAttr("name");	
	}

	if(isNull(start_time)){
		$("#start_time").removeAttr("name");
	}

	if(isNull(end_time)){
		$("#end_time").removeAttr("name");
	}


	$("#submit-real").click();

}

function isNull(data){
    return $.trim(data).length == 0;
}

function bind_exchange_rate() {
    $(".table-border").on("blur","[data-exchange-rate='true']",function () {
        var id = $(this).attr("data-id");
        var val = $(this).val();
        var csrfToken = $("#_csrf").val();

        $.post("/ydlbam/capital/exchange-rate",
            {
                "id":id,
                "val":val,
                "_csrf":csrfToken
            },
            function(data){
                var contentData = $.parseJSON(data);
                if (contentData.status == 1){
                    alert("操作成功");
                    window.location.reload();
                }else{
                    alert("操作失败，稍后重试");
                }
            });
    });
}