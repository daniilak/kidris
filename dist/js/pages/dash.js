


$(document).ready(function (e) {
	var files;

$('input[type=file]').on('change', prepareUpload);

function prepareUpload(event) {
  files = event.target.files;
}

$(document).on('click', '.update', function() {
 
});
	$("#file").on("change", function(e) {
         var formData = new FormData();
  		formData.append('file', files[0]);
        //console.log(formData);
        $.ajax({
            type:'POST',
           	dataType: 'json',
            data:formData,
            cache:false,
            contentType: false,
            processData: false,
            success:function(data){
	            if (data.code == 30)
	        	{
		          alert('Ошибка при загрузке файла: загрузить можно только файлы с расширением jpg, png, gif, bmp, jpeg. ')
		
		        }
		        if (data.code == 31)
		        {
		          alert('Ошибка при загрузке файла: попробуйте еще раз.  ')
		
		        }
		        if (data.code == 32)
		        {
		          alert('Ошибка при загрузке файла: Сервис недоступен, попробуйте повторить позднее. ')
		
		        }
		        if (data.code == 33)
		        {
		          alert('Ошибка при загрузке файла: Сервис недоступен, попробуйте повторить позднее')
		
		        }
		        else 
		        {
		        	$(".img").remove("");
		            
	                
	               
					
					$("#file").val('');
					
					$( "#sub_block_file2" ).append(  '<img src="'+ data.photo_min+'" class="img" style="width: 300px" alt="">' );
					$("#sub_block_file1").hide();
	                $("#sub_block_file2").show();
	                $("#photo_group").removeClass().addClass('form-group has-success');
	        	}
               
            },
            error: function(data){
                console.log("error");
            }
        });
    });

    
});


$( document ).ready(function() {
	$("#edit_ph").on('click', function() {
		
		$("#sub_block_file1").show();
		$("#sub_block_file2").hide();
		$(".img").remove("");
	});
	
	$(".auto-add-photo").on('click', function() {
		if ($(this).is(':checked')) {
			$("#sub_block_file1").show();
			$("#sub_block_file2").hide();
		}
		else {
			$("#sub_block_file1").hide();
			$("#sub_block_file2").hide();
		}
	});
	$(".notifications").on('click', function() {
		if ($(this).is(':checked'))
			$("#notifications_block").show();
		else
			$("#notifications_block").hide();
	});
	$(".auto-add").on('click', function() {
		if ($(this).is(':checked'))
			$("#auto-add-block").show();
		else
			$("#auto-add-block").hide();
	});
	$(".show_desc").on('click', function() {
		if ($(this).is(':checked'))
			$(".desc-block").show();
		else
			$(".desc-block").hide();
	});
	
	$(".delete").on('click', function() {
		$(".block-on").hide();
		$(".block-off").show();
		$(".footer-on").hide();
		$(".footer-off").show();
		$.ajax({
			data: {"delete": ""}, 
			type:'POST', 
			dataType: 'json',
			success:function(data){
				if( data.code != 0 ) {
					alert("Возникла ошибка при удалении :(");
					$(".block-off").hide();
					$(".block-on").show();
					$(".footer-off").hide();
					$(".footer-on").show();
				}
			}
		});
	});
	$(".plug").on('click', function() {
		$(".block-off").hide();
		$(".block-on").show();
		$(".footer-off").hide();
		$(".footer-on").show();
		$.ajax({
			data:{"plug": ""},  
			type:'POST', 
			dataType: 'json',
			success:function(data){
				if( data.code != 0 ) {
					alert("Возникла ошибка при подключении :(");
					$(".block-on").hide();
					$(".block-off").show();
					$(".footer-on").hide();
					$(".footer-off").show();
				}
			}
		});
	});
	$(".update").on('click', function() {
		
		var data = {
		  		'update'		: "",
		  		'notifications'	: ($(".notifications").is(':checked')) ? 1 : 0,
		  		'auto_add'		: ($(".auto-add").is(':checked')) ? 1 : 0,
		  		'show_desc'		: ($(".show_desc").is(':checked'))  ? 1 : 0,
		  		'show_count_msg': ($(".show_count_msg").is(':checked')) ? 1 : 0,
		  		'description'	: $(".description").val(),
		  		'auto_add_text'	: $(".auto_add_text").val(),
		  		'auto_add_photo': "URL",
		  		'auto_add_down'	: ($(".auto_add_down").is(':checked')) ? 1 : 0,
		  		'auto_add_up'	: ($(".auto_add_up").is(':checked')) ? 1 : 0,
		  		'auto_add_photo': ($(".auto-add-photo").is(':checked')) ? 1 : 0,
		};
		$.ajax({
			data:data, 
			type:'POST', 
			dataType: 'json',
			success:function(data){
				if( data.code == 0 ) {
					alert("ok");
				}
			}
		});
		//ajax
	});


	$(".like").on('click', function() {
		var like_id = $(this).data("id");
		var number = parseInt($("#"+ like_id +"_c").text());
		if (is_liked == 0) {
			$("#"+ like_id +"_i").removeClass().addClass('fa fa-heart');
			$("#"+ like_id +"_i").css("color","red");
			number = number +  1;
			$(this).data('isLiked', 1).attr('data-is-liked', 1);
		} else {
			$(this).data('isLiked', 0).attr('data-is-liked', 0);
			$("#"+ like_id +"_i").removeClass().addClass('fa fa-heart-o');
			$("#"+ like_id +"_i").css("color","");
			number = number - 1;
		}
		var data = {
		  		'like_id': $(this).data("isLiked"),
				'is_liked': is_liked,
		};

		$("#"+ like_id +"_c").html(number);
		$.ajax({
			url:"/ideas", 
			data:data, 
			type:'POST', 
			dataType: 'json',
			success:function(data){
				if( data.code != 0 ) {
					$("#"+ like_id +"_i").css("color","");
					$("#"+ like_id +"_i").removeClass().addClass('fa fa-heart-o');
				}
			}
		});		
	});
	$(".send").on('click', function() {
		var name = $(".theme").val();
		var description = $(".theme").val();
		var data = {
		  		'name': $(".theme").val(),
				'description': $(".description").val(),
		};
		$.ajax({
			url:"/ideas", 
			data:data, 
			type:'POST', 
			dataType: 'json',
			success:function(data){
				if( data.code == 0 ) {
					alert("Спасибо за идею");
				}
			}
		});

	});
});
	