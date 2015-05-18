$(document).on("click",".create,.edit",function(e){
	e.preventDefault();
	show_popup(this);
	
});

$(document).on('click','.delete',function(e){
	e.preventDefault();
	delete_entity(this);
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
			if(window_width > 768){
				my_content = $(".modal-body form").css("max-width");
				$(".modal-dialog").css("width",my_content);
			}
			
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