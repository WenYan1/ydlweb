var csrfToken = $('meta[name="csrf-token"]').attr("content");
$(document).ready(function(){
	changeStatus();

	//设置select默认选中
	setStatus();
	jQuery.noConflict();
   
	$("#business-license-btn").click(function(){
		$("#bl-dialog").modal('show');
	});
	$("#tax-reg-btn").click(function(){
		$("#tr-dialog").modal('show');
	});
	$("#organization-code-btn").click(function(){
		$("#oc-dialog").modal('show');
	});
});
function changeStatus(){
	$("#change_state").click(function(){
		var state = $("#supplier-status option:selected").val();
		var supplier_id = $("#supplier-hide").val();
		var state_text = $("#supplier-status option:selected").text();
		if (state.length == 0) {
			alert("供应商状态为空！");
		}else if(supplier_id.length == 0){
			alert("供应商id为空！");
		}else{
			$.ajax({
				type:"POST",
				url:"/ydlbam/supplier/auditing-supplier",
				data:{"supplier_id":supplier_id,"state":state,'_csrf':csrfToken},
				success:function(msg){
					var data = JSON.parse(msg);
					if (data.status) {
						$(".status-ing").text(state_text);
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

function setStatus(){
	var state = parseInt($(".status-ing").attr("id"));
	$("#supplier-status option[value=" + state + "]").attr("selected","true");
}
