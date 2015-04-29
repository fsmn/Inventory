$(document).on("click",".create,.edit",function(e){
	e.preventDefault();
	show_popup(this);
	
});

function show_popup(me){
	target = $(me).attr("href");
	form_data = {
			ajax: 1
	};
	console.log(form_data);
	$.ajax({
		type: "get",
		data: form_data,
		url: target,
		success: function(data){
			$("#popup").html(data);
			$("#my_dialog").modal("show");	
			
		}
	});
}