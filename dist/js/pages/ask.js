
$( document ).ready(function() {
	var attachments = 0;
	var attachments_send = [];
	var options = 1;
	var options_end = 10;
	var options_arr = [];
	var files;
	var count_files = 0;
	$('.camera').bind("click" , function () {
        $('#file-upload').click();
    });
    $('.edit_options').bind("click" , function () {
        $('#list-block').modal("show");
    });
    $('.remove-poll').bind("click" , function () {
    	$(".poll-block").hide();
		for(var i=0; i<attachments_send.length; i++) 
			if(attachments_send[i].indexOf('poll') + 1) 
				attachments_send[i] = "";
        attachments = attachments - 1;
    });
    
    
	$('input[type=file]').on('change', prepareUpload);
	function prepareUpload(event) {
	  files = event.target.files;
	}
	$("#file-upload").on("change", function(e) {
		if (count_files == 10 || attachments == 10) {
			alert("Нельзя больше 10 медиавложений");
			return;
		}
        var formData = new FormData();
  		formData.append('file', files[0]);
  		$('.btn-oval').prop('disabled', true);
        
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
		        	count_files = count_files + 1;
		        	attachments = attachments + 1;
		        	//$(".img").remove("");
					$("#file-upload").val('');
				
					attachments_send.push( data.photo_vk );
	        $(".attachments-all" ).append( '<div class="image-container '+ data.photo_vk +'"><div class="controls"><a href="#" class="control-btn remove-photo" data-id="' +  
	        data.photo_vk + '">'+
			'<i class="fa fa-trash-o "></i></a></div>'+
			'<div class="image" style="background-image:url('+  data.photo_min +')"></div></div>');
           		$('.btn-oval').prop('disabled', false);
					
	        	}
               
            },
            error: function(data){
                console.log("error");
            }
        });
    });
    $(document).on('click',".remove-photo", function() {
		var deleted_photo = $(this).data("id");
		$("."+deleted_photo).remove();
		for(var i=0; i<attachments_send.length; i++) 
			if(attachments_send[i].indexOf(deleted_photo) + 1) 
				attachments_send[i] = "";
        attachments = attachments - 1;
		
	});
	$(".add_poll_question").on('click', function() {
		options_arr[options] = 1;
		$(".option-"+options).html('<div class="col-sm-8 col-sm-offset-2">'+
			'<input type="text" class="form-control underlined" id="create_poll_question'+options+'"></div>'+
			'<div class="col-sm-2"><button class="form-control delete_poll_question" data-id="'+options+'" type="button" data-toggle="Удалить вариант" class="btn btn-secondary-outline">X</button></div>');
		options++;
		$(".options").append('<div class="form-group row option-'+options+'"></div>');
		if (options == options_end)  {
			$(".add_poll_question").hide();
			return;
		}
	});
	
	 

	$(document).on('click',".btn-oval", function() {
		if ( $(".msg").val().trim().length == ""  && attachments == 0) {
			$( ".msg" ).focus();
			return;
		}
		$("#spinner").removeClass().addClass('fa fa-spinner fa-spin');
		var v = grecaptcha.getResponse();
		var msg = $(".msg").val();
		var token = $(".token").val();
		var attachments_send_str = "";
		for(var i=0; i<attachments_send.length; i++) {
			if (attachments_send_str.length > 0)
				attachments_send_str = attachments_send_str + "," + attachments_send[i];
			else 
				attachments_send_str =  attachments_send[i];
		}
		//alert(msg);
		$.ajax({
			type: 'POST',
			dataType: 'json',
			data: {'msg':msg,"token":token,"attachments":attachments_send_str,"v":v},
			response: 'text',
			success: function(data){
				attachments_send_str = "";
				
				attachments = 0;
				attachments_send = [];
				$(".attachments-all" ).html("");
				if (data.code == 0)	{
					$("#spinner").removeClass().addClass('fa fa-paper-plane');
					$( ".msg" ).val("");
					alert("В скором времени администраторы сообщества обработают вашу запись.");
					
					//alert("0");
					return;
				}  
				if (data.code == 1)	{
					$("#spinner").removeClass().addClass('fa fa-paper-plane');
					alert("1");
					return;
				} 
				if (data.code == 2)	{
					$("#spinner").removeClass().addClass('fa fa-paper-plane');
					alert("2");
					return;
				} 
				if (data.code == 3)	{
					$("#spinner").removeClass().addClass('fa fa-paper-plane');
					alert("3");
					return;
				} 
				if (data.code == 4)	{
					$("#spinner").removeClass().addClass('fa fa-paper-plane');
					alert(data.items);
					return;
				} 
			}
		});
	});
	var video_counter = 0;
	$(document).on('click',".video-in", function() {
	    if ($(this).is(':checked')) {
	        if (attachments == 10) {
	        	$(this).prop('checked',false);
	            return;
	        }
	        attachments = attachments + 1;
	        video_counter = video_counter + 1;
	        attachments_send.push( $(this).val() );
	        $(".attachments-all" ).append( '<div class="image-container '+ $(this).val() +'"><div class="controls"><a href="#" class="control-btn remove-video" data-id="' +  
	        $(this).val() + '">'+
			'<i class="fa fa-trash-o "></i></a></div>'+
			'<div class="image" style="background-image:url('+ $(this).data("id") +')"></div></div>');
           
	    } else {
	    
	        attachments = attachments - 1;
	        video_counter = video_counter - 1;
	    }
	    if (video_counter < 1)  
	        $(".send_video_button").hide();  
	   	else 
	        $(".send_video_button").show();
		$(".video_counter").html(video_counter);
		
	});
	$(document).on('click',".send_video_button", function() {
		$("#modal_video").modal("hide");
		
	});
	$(document).on('click',".remove-video", function() {
		var deletedVideo = $(this).data("id");
		$("."+deletedVideo).remove();
		for(var i=0; i<attachments_send.length; i++) 
			if(attachments_send[i].indexOf(deletedVideo) + 1) 
				attachments_send[i] = "";
        attachments = attachments - 1;
		
	});
	
	
	$(document).on('click',".delete_poll_question", function() {
		id_poll = $(this).data("id");
		$(".option-"+id_poll).remove();
		options_arr[id_poll] = 0;
		if (options >= options_end)
			$(".add_poll_question").show();
		options_end++;
	});
	
	$(".send_poll_question").on('click', function() {
		if ( $("#create_poll_theme").val().trim().length == "" ) {
			$( "#create_poll_theme" ).focus();
			return;
		}
		if ( $("#create_poll_question0").val().trim().length == "") {
			$( "#create_poll_question0" ).focus();
			return;
		}
		
		if (attachments==10)  {
			alert("Больше 10 медиавложений нельзя.");
			return;
		}
		var poll_theme = $( "#create_poll_theme" ).val().trim();
		var poll_question = [];
		poll_question[0] = $("#create_poll_question0").val().trim();
		create_poll_question0
		index = 1;
		for (var i=1; i<=options_arr.length;i++){
			if (options_arr[i] == 1) {
				poll_question[index] = $("#create_poll_question"+i).val().trim();
				index++;
			}
		}
		var question = JSON.stringify(poll_question);
		var is_anonymous = ($(".is_anonymous").is(':checked')) ? 1 : 0;
		var token = $(".token").val();
		//CLOSE MODALE
		$('#list-block').modal('hide');
		$.ajax({
				type: 'POST',
				dataType: 'json',
				data: {'poll':poll_theme,"question":question,is_anonymous:is_anonymous,token:token},
				response: 'text',
				success: function(data){
					if (data.code == 0) {
						attachments_send.push(  data.items );
					
						$(".poll-block").show();
						
					}
				}
		});
		attachments++;
	});
	
	
	$('.video-input').on("input", function() {
		if(this.value.length >= 2){
			$.ajax({
				type: 'POST',
				dataType: 'json',
				data: {'video':this.value},
				response: 'text',
				success: function(data){
					var html_video = "";
					for(var i=0; i<data.count; i++) {
						html_video = html_video + '<label style="height: 180px;width: 260px;"><div class="images-container image-container"><div class="image" style="background-image:url('+
						data.items[i].photo +')"></div></div><input class="checkbox video-in" data-id="'+
						data.items[i].photo +'" value="'+
						data.items[i].id + '" type="checkbox"><span id="'+
						data.items[i].id + '">'+ data.items[i].text + '</span></label>';
					}
					//$(".video-more").hide();//доделать
					
					$(".result-video").html(html_video).fadeIn(); 
				}
			});
		}
	});
	$('.audio-input').bind("change keyup input click", function() {
		if(this.value.length >= 2){
			$.ajax({
				type: 'POST',
				dataType: 'json',
				data: {'audio':this.value},
				response: 'text',
				success: function(data){
					var html_video = "";
					for(var i=0; i<data.count; i++) {
						html_video = html_video + '<label><div class="images-container image-container"><div class="image" style="background-image:url('+
						data.items[i].photo +')"></div></div><input class="checkbox" value="'+
						data.items[i].id + '" type="checkbox"><span>'+ data.items[i].text + '</span></label>';
					}
					$(".audio-more").show();//доделать
					$(".result-audio").html(html_video).fadeIn(); 
				}
			})
		}
	})
	
});
