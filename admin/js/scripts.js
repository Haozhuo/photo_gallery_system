$(document).ready(function(){
	var user_href;
	var user_href_split;
	var user_id;

	var image_src;
	var image_href_split;
	var image_name;

	var photo_id;

	$(".modal_thumbnails").on('click',function(){
		$("#set_user_image").prop('disabled',false);

		//$(this).addClass('selected');

		user_href = $("#user_id").prop("href");

		user_href_split = user_href.split('=');
		
		user_id = user_href_split[user_href_split.length - 1];

		image_src = $(this).prop('src');

		image_href_split = image_src.split('/');

		image_name = image_href_split[image_href_split.length - 1];

		photo_id = $(this).attr("data");

		//making another ajax call
		$.ajax({
			url:"includes/ajax_code.php",
			data:{photo_id:photo_id},
			type:"POST",
			dataType:'html',
			success: function(data){
				if(!data.error){
					$('#modal_sidebar').html(data);
				}
			}
		});

		
	});

	$('#set_user_image').on('click',function(){
		$.ajax({
			url:"includes/ajax_code.php",
			data:{image_name:image_name,user_id:user_id},
			type:"POST",
			dataType:'html',
			success: function(data){
				if(!data.error){
					var data_split = data.split('.');
					$('.image_box a img').prop('src','.'+ data_split[1]+'.'+data_split[2]);
				}
			}
		});

	});


	tinymce.init({ selector:'textarea' });
});


//tinymce.init({ selector:'textarea' });


