

$(document).on('click | focus', '.asset-item',function(){
	$(".asset-item.active").removeClass("active");
	me = $(this);
	pose = me.position();
	my_left = pose.left;
	my_top = pose.top;
	my_width = me.css("width");
	if(! me.hasClass("active") ){;
	
		me.addClass("active");
		my_id = this.id.split("_")[1];
		form_data = {
				ajax: 1
		};
		$.ajax({
			type:"get",
			url: base_url + "asset/view/" + my_id,
			data: form_data,
			success: function(data){
				$(".details-block").css({"top":my_top, "z-index": 1000,"left":my_width}).html(data).fadeIn();
			}
		});
	}else{
		//$(this).removeClass("active");
	}
});

$(document).on('blur','.asset-item', function(){
	$(this).removeClass("active");
});

