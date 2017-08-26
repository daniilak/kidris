$( document ).ready(function() {
	$(".like").on('click', function() {
		var like_id = $(this).data("id");
		var is_liked = $(this).data("isLiked");
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
		  		'like_id': like_id,
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
	