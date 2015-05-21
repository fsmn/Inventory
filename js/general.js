$(document).on("click",".create.dialog,.edit.dialog",function(e){
	e.preventDefault();
	show_popup(this);
	
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

/* Insert New Code for Assets */

$(document).on("click",".new-code.inline.dialog",function(e){
	e.preventDefault();
	me = this;
	my_parent = $(me).parents(".code-rows");
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
				$("#popup").html(data);
				$("#my_dialog").modal("show");
			},
			error: function(data){
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
				$(".details-block").css({"top":my_top, "z-index": 1000,"left":my_width}).html(data).fadeIn();
				document.location = "#asset-header_" + me.parent("li").attr("id").split("_")[1];
				me.addClass("active");
			}
		});
	}
});