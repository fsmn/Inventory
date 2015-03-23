/*$(document).on("click",".create",function(e){
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
			show_popup("Creating",data,"auto");
			
		}
	});
	
});*/


function show_popup(my_title,data,popup_width,x,y){
	if(!popup_width){
		popup_width=300;
	}
	var myDialog=$('<div id="popup">').html(data).modal({
		autoOpen:false,
		title: my_title,
		modal: true,
		width: popup_width
	});
	
	if(x) {
		myDialog.dialog({position:x});
	}


	myDialog.fadeIn().dialog('open',{width: popup_width});

	return false;
}