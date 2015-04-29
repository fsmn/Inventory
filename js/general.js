$(document).on("click",".create,.edit",function(e){
	e.preventDefault();
	show_popup(this);
	
});

$(document).on('click','.delete',function(e){
	e.preventDefault();
	delete_entity(this);
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

function delete_entity(me){
	target = $(me).attr("href");
	my_id = me.id.split("_")[1];
	question = confirm("Are you sure you want to delete this order? This cannot be undone!");
	if(question){
		console.log(question);
		form_data = {
				ajax : 1,
				id: my_id
		}
		
		$.ajax({
			type: "post",
			data: form_data,
			url: target,
			success: function(data){
				console.log(data);
				$("#popup").html(data);
				$("#my_dialog").modal("show");
			},
			error: function(data){
				console.log(data);
			}
		});
	}
}