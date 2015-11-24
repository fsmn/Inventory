$(document).on("click",".create.dialog,.edit.dialog",function(e){
	e.preventDefault();
	show_popup(this);
	
});

$(document).on('click','.checkbox-required :checkbox',function(e){
	me = $(this);
	my_siblings = me.parents(".checkbox-required").children(".checkbox").children("label");
	if(my_siblings.children("input:checked").length > 0){
my_siblings.children("input").attr("required",false);
	}else{
		my_siblings.children("input").attr("required",true);

	}
});

$(document).on('click','.delete',function(e){
	e.preventDefault();
	delete_entity(this);
});

$(document).on("blur",".year",function(){
	my_id = this.id;
	my_val = Number($(this).val());
	$("#" + my_id + "-next").val(my_val + 1);
});

$(document).on("click",".po-details",function(e){
	e.preventDefault();
	me = this;
	my_parent = $(me).parents("tr");
	my_id = my_parent.attr("id").split("_")[1];
	if($(me).hasClass("hider")){
		$(me).html("Show Items").removeClass("hider");
		$("#details-row_" + my_id).fadeOut();

	}else{
		$(me).html("Hide Items").addClass("hider");
		$(".details-row").fadeOut();
		$("#details-row_" + my_id).fadeIn();
	}
});

$(document).on("click",".insert-time",function(){
	me = $(this);
	target = false;
	time = new Date();
	hours = format_time(time.getHours());
	minutes = format_time(time.getMinutes());
	console.log(minutes)
	if(me.hasClass("start_time")){
		target = "#start_time";
	}else if(me.hasClass("end_time")){
		target = "#end_time";
	}
	if(target){
		$(target).val(hours + ":" + minutes);
	}
});

/* Insert New Code for Assets */

$(document).on("click",".create.inline",function(e){
	e.preventDefault();
	me = this;
	$(me).fadeOut();
	my_parent = $(me).parents(".rows");
	my_url = $(me).attr("href");
	form_data = {
		inline: true
	}
	$.ajax({
		type: "get",
		url: my_url,
		data: form_data,
		success: function(data){
			$(my_parent).append(data);
			$(".new-row input[type='text']").focus();
		}
	});
});

$(document).on("click",".edit.inline",function(e){
	e.preventDefault();
	me = $(this);
	my_id = me.parent().attr("id");
	my_url = me.attr("href");
	form_data = {
		inline: 1	
	};
	$.ajax({
		type: "get",
		data: form_data,
		url: my_url,
		success: function(data){
			me.parent().html(data);
		}
	});
	
	
});

$(document).on("change","select",function(){
	me = $(this);
	if(me.val() == "other"){
		my_name = me.attr('name');
	me.parent().html("<input type='text' name='" + my_name+ "' class='form-control' value=''/>");
}
});

$(document).on("blur","#item_count,#price",function(){
	my_count = Number($("#item_count").val());
	my_total = Number($("#price").val());
	product = my_count * my_total;
	$("#total").val(product);
	
});


$(document).on("keyup","#order-editor #po",function(){
	me = $(this);
	po = me.val();
	$.ajax({
		type:"get",
		url: base_url + "po/po_exists/" + po,
		success: function(data){
			if(data){
			$("#valid-po").addClass("fa-thumbs-down").removeClass("fa-thumbs-up");
			me.addClass("error");
			}else{
				$("#valid-po").removeClass("fa-thumbs-down").addClass("fa-thumbs-up");
				me.removeClass("error");
			}
		}
	});
});

$(document).ready(function() {
    // put the footer at the bottom of the window
    move_footer();

    // run test on resize of the window
    $(window).resize(move_footer);
});

$(document).on("click",".editor .field-envelope .edit-field.editable",function(){
	//if($("body").hasClass("editor")){
		me = $(this);
		my_parent = me.parent().attr("id");
		my_attr = my_parent.split("__");
		my_type = "text";
		my_category = me.attr('menu');
		my_name = me.attr("name");
			if(me.hasClass("dropdown")){
				my_type = "dropdown";
			}else if(me.hasClass("checkbox")){
				my_type = "checkbox";
			}else if(me.hasClass("multiselect")){
				my_type = "multiselect";
			}else if(me.hasClass("textarea")){
				my_type = "textarea";
			}else if(me.hasClass("autocomplete")){
				my_type = "autocomplete";
			}
			form_data = {
					table: my_attr[0],
					field: my_name,
					id: my_attr[2],
					type: my_type,
					category: my_category,
					value: me.html()
			};
			$.ajax({
				type:"get",
				url: base_url +  "variable/edit_value",
				data: form_data,
				success: function(data){
					$("#" + my_parent + " .edit-field").html(data);
					$("#" + my_parent + " .edit-field").removeClass("edit-field").removeClass("field").addClass("live-field").addClass("text");
					$("#" + my_parent + " .live-field input").focus();
					
				}
			});
	//}
	});
$(document).on("blur",".field-envelope .live-field.text input",function(){
	if($(this).hasClass("ui-autocomplete-input")){
		update_field(this, "autocomplete");
	
	}else{
		update_field(this, "text");
	}
	return false;
});
$(document).on("blur",".field-envelope .live-field input[type='checkbox']",function(){
	update_field(this, "checkbox");
});

$(document).on("blur",".field-envelope .live-field textarea",function(){
	update_field(this, "textarea");
});
$(document).on("blur",".field-envelope .live-field.category-dropdown select",function(){
	console.log("here");
	update_field(this, "category-dropdown");
});

$(document).on("blur",".field-envelope .live-field.subcategory-dropdown select",function(){
	update_field(this, "subcategory-dropdown");
});


$(document).on("blur",".field-envelope .live-field select",function(){
	update_field(this, "select");
});

//*/

$(document).on("click", ".field-envelope .save-multiselect",function(){
	console.log(this);
	update_field(this, "multiselect");
	
});

function update_field(me,my_type){
	my_parent = $(me).parents(".field-envelope").attr("id");
	my_attr = my_parent.split("__");
	my_value = $("#" + my_parent).children(".live-field").children("input"|"textarea").val();
	my_category = false;
	if(my_type == "autocomplete"){
		my_value = $("#" + my_parent).children(".live-field").children("input").val();

	}else if(my_type == "multiselect"){
		my_value = $("#" + my_parent).children(".multiselect").children("select").val();
	}else if(my_type == "checkbox"){
		my_category = "checkbox";
		if($(me).attr("checked") == true){
			my_value = 1;
		}else {
			my_value = 0;
		}
	}
	
	is_persistent = $(me).hasClass("persistent");
	
	//don't do anything if the value is empty and it is a persistent field 
	if(is_persistent && my_value == ""){
		return false;
	}
	
	form_data = {
			table: my_attr[0],
			field: my_attr[1],
			id: my_attr[2],
			value: my_value,
			category: my_category
	};
	console.log(form_data);

	$.ajax({
		type:"post",
		url: base_url + my_attr[0] + "/update_value",
		data: form_data,
		success: function(data){
			if(!is_persistent){
			$("#" + my_parent + " .live-field").html(data);
			$("#" + my_parent + " .live-field").addClass("edit-field field").removeClass("live-field text");
			}
		}
	});
}

//function to put the footer always at the bottom of the page no matter how big the document contents are. 
function move_footer(){
	win_height = $(window).height();
	doc_height = $(document).height();
	if(win_height > doc_height){
		height = win_height;
	}else if(doc_height > win_height ){
		height = doc_height;
	}else{
		height = win_height;
	}
	$("footer").css("top",height - 25 + "px").addClass("js-positioning");
	
}

function show_popup(me){
	target = $(me).attr("href");
	form_data = {
			ajax: 1
	};
	window_width = $(window).width();
	$.ajax({
		type: "get",
		data: form_data,
		url: target,
		success: function(data){
			$("#popup").html(data);
			$("#my_dialog").modal("show");
			//on larger screens, shrink the dialog to a more friendly size
//			if(window_width > 768){
//				my_content = $(".modal-body form").css("max-width");
//				$(".modal-dialog").css("width",my_content);
//			}
			
		}
	});
}



function delete_entity(me){
	target = $(me).attr("href");
	my_id = me.id.split("_")[1];
	console.log(my_id);

	question = confirm("Are you sure you want to delete this? This cannot be undone!");
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
				if($(me).hasClass("inline")){
					$("#file_row_" + my_id).remove();
					
				}else{
					$("#popup").html(data);
					$("#my_dialog").modal("show");
				}
			},
			error: function(data){
				$("#file_row_" + my_id).remove();
				console.log(data);
			}
		}); 
	}
}

$(document).on('blur','.view-inline', function(){
	$(this).removeClass("active");
});

$(document).on("click | focus",".view-inline",function(e){
	e.preventDefault();
	$(".view-inline.active").removeClass("active");
	me = $(this);
	console.log(me.parent().attr("id").split("_")[1]);
	pose = me.position();
	my_left = pose.left;
	my_top = pose.top;
	my_width = me.css("width");
	my_url = me.attr("href");
	if(! me.hasClass("active") ){;
		me.addClass("active");
		form_data = {
				ajax: 1
		};
		$.ajax({
			type:"get",
			url: my_url,
			data: form_data,
			success: function(data){
				details_block = $(".details-block");
				details_block.html(data).css("position","relative").css("width","auto");
				me.parent("li").append(details_block);
				details_block.fadeIn();
//				$(".details-block").css({"top":my_top, "z-index": 1000,"left":my_width}).html(data).fadeIn();
				document.location = "#asset-header_" + me.parent("li").attr("id").split("_")[1];
				me.addClass("active");
			}
		});
	}
});

function format_time(t){
if(t<10){
	return "0" + t;
}else{
	return t;
}
	
}