$(document).on("click",".create,.edit",function(e){
	e.preventDefault();
	target = $(this).attr("href");
	form_data = {
			ajax: 1
	};
	$.ajax({
		type: "get",
		data: form_data,
		url: target,
		success: function(data){
			$("#popup").html(data);
			$("#my_dialog").modal("show");
			
		}
	});
	
});

