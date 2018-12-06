 // 公司认证的两个两个页面（认证公司列表页面和认证公司详情页面js为同一js文件）
 var csrfToken = $('meta[name="csrf-token"]').attr("content");
 $(document).ready(function(){
	// 搜索
	search();
	//修改开户账号
	modify_account();

	change_status();
	// 公司详情里面的状态
	set_status();
	// 公司认证列表里面的状态
	set_manage_status();
	// 回车事件
	backFun();
});

function backFun(){
	$('input').bind('keypress',function(event){
		if(event.keyCode == "13")    
		{
			$('.search-button').click();
		}
	});
}

 function set_status(){
 	var state = parseInt($("#company_state").val());
 	$("#select_state_company option[value=" + state + "]").attr("selected","true");
 }

 function set_manage_status(){
 	var state = parseInt($("#company-mange-state").val());
 	$("#company-status option[value=" + state + "]").attr("selected","true");
 }


 function search(){
 	$(".search-button").click(function(){
 		var company = $("#company").val();
 		var account = $("#user_account").val();
 		if (company.length != 0 ) {
 			$('#company').val($.trim(company));
 			$("#company").attr("name","company_name");
 		}
 		if (account.length != 0 ) {
 			$('#account').val($.trim(account));
 			$("#account input:text").attr("name","email");
 		} 
 		$('#submit').click();
 	});
 }

//修改开户账号
function modify_account(){
	$("#modify").click(function(){
		var span_text = $(this).text();
		if (span_text == "修改") {
			$("#account_opening").removeClass("border-none");
			$("#account_opening").removeAttr("disabled");
			$(this).text("完成");
		}else if(span_text == "完成"){
			var account = $("#account_opening").val();
			if (account.length == 0 ) {
				alert("开户账号不能为空");
			}else{
				$(this).text("修改");
				$("#account_opening").addClass("border-none");
				$("#account_opening").attr("disabled","true");
			}
		}
	});
}

function change_status(){
	$("#sure-edit-company").click(function(){
		var state = $("#select_state_company option:selected").val();
		var company_id = $("#company_id").val();
		if (state.length == 0) {
			alert("认证公司状态为空！");
		}else if(company_id.length == 0){
			alert("认证公司id为空！");
		}else{
			$.ajax({
				type:"POST",
				url:"/ydlbam/company/auditing-company",
				data:{"company_id":company_id,"state":state,'_csrf':csrfToken},
				success:function(msg){
					var data = JSON.parse(msg);
					if (data.status) {
						$('#test').show().delay(3000).fadeOut();
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