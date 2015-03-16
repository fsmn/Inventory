$(window).scroll(function(){
	var top=$('.float');
	my_width = $(window).width();
	if(my_width>400){
		console.log(my_width);

	if($(window).scrollTop()>250){
		if(!top.hasClass('fixed')){
			top.addClass('fixed');
			top.removeClass('static');
			//top.css('background-color','#000');
		}
	}else{
		if(top.hasClass('fixed')){
			top.addClass('static');
			top.removeClass('fixed');
		}
	}
}
});

$(document).on('click | focus', '.asset-item',function(){
	$(".asset-item.active").removeClass("active");
	if(! $(this).hasClass("active") ){;
	
		$(this).addClass("active");
		my_id = this.id.split("_")[1];
		form_data = {
				ajax: 1
		};
		$.ajax({
			type:"get",
			url: base_url + "asset/view/" + my_id,
			data: form_data,
			success: function(data){
				$(".details-block").html(data).fadeIn();
			}
		});
	}else{
		//$(this).removeClass("active");
	}
});

$(document).on('blur','.asset-item', function(){
	//$(this).removeClass("active");
});