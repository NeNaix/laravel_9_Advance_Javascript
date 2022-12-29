$(document).ready(function() {
	

	$("#search_game").autocomplete({
		source: function( request, response ) {
			$.ajax({
				headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
				url:"/api/search/game",
				type: 'POST',
				dataType: "json",
				data: {
					search: request.term
				},
				success: function( data ) {
					$('#sdata').html('')
					var resp = $.map(data,function(obj){
						$('#sdata').append('<div class="col-4" id="game'+obj.searchable.id+'">'+obj.searchable.title+'<br/>Price : ₱ '+obj.searchable.price+'</div>');
						$('#game'+obj.searchable.id).css("background-image", "url("+obj.searchable.img+")");

						return obj.searchable.title;
					}); 
					response( resp );
				}
			});
		}
	});

	$.ajax({	
		headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
		url:"/api/search/game",
		type: 'POST',
		dataType: "json",
		data: {
			search: null
		},
		success: function( data ) {
			$('#sdata').html('')

			$.map(data,function(obj){
				$('#sdata').append('<div class="col-4" id="game'+obj.id+'">'+obj.title+'<br/>Price : ₱ '+obj.price+'</div>');
				$('#game'+obj.id).css("background-image", "url("+obj.img+")");  
			}); 

		}
	});


	function notf(){
		toastr.options = {
			"closeButton": true,
			"debug": true,
			"newestOnTop": true,
			"progressBar": true,
			"positionClass": "toast-bottom-full-width",
			"preventDuplicates": true,
			"onclick": null,
			"showDuration": "300",
			"hideDuration": "1000",
			"timeOut": "10000",
			"extendedTimeOut": "1000",
			"showEasing": "swing",	
			"hideEasing": "linear",
			"showMethod": "fadeIn",
			"hideMethod": "fadeOut"
		}
	}
	
	$("#game_table").DataTable({
		responsive: true,
		ajax: {
			url: "api/vapor/all/games",
			dataSrc: "",
		},
		dom: '<"top"<"left-col"B><"center-col"l><"right-col"f>>rtip',
		buttons: [{
			extend: 'pdf',
			className: 'btn btn-success glyphicon glyphicon-file'
		},
		{
			extend: 'excel',
			className: 'btn btn-success glyphicon glyphicon-list-alt'
		},
		{
			text: "Add Game",
			className: "btn btn-success",

			action: function (e, dt, node, config) {
				$("#form_create_game").trigger("reset");
				$("#mdl_crt_game").modal("show");
			},
		},
		],
		columns: [
		{
			data: "title",
		},
		{
			data: "description",
		},

		{
			data: "genre.genre",
		},
		{
			data: "platform",
		},
		{
			data: "price",
		},
		{
			data: "stocks",
		},
		{
			data: null,
			render: function (data, type, JsonResultRow, row) {
				return '<img src="' + JsonResultRow.img + '" height="100px" width="100px">';
			}
		},
		{
			data: null,
			render: function (data, type, row) {
				return `<a href='#' data-bs-toggle='modal' data-bs-target='#mdl_upd_game' id='editbtn' data-id="`+data.id + `"><i class='fa fa-pencil' aria-hidden='true' style='font-size:24px;color:lighblue;' ></a></i></td>
				<a href='#' data-bs-toggle='modal' data-bs-target='#mdl_del_game' id='delbtn' data-id="`+ data.id + `"><i class='fa fa-trash' aria-hidden='true' style='font-size:24px;color:maroon;' ></a></i>
				`;
			},
		},
		],
	});


	$.ajax({ 
		type: "GET",
		url: "api/vapor/all/genres", 
		dataType: 'json',
		success: function (data) {
			$.each(data, function(key, value) {
				$(".select_genre_create").append('<option value="'+value.id+'">'+value.genre+'</option>');
				$(".update_genre_id").append('<option value="'+value.id+'">'+value.genre+'</option>');
				
			});
		},
		error: function(error){
			console.log(error);
		}
	});

	$("#crt_game_btn").on('click', function(e) {
		e.preventDefault(); 
		$.LoadingOverlay("show");
		var data = $('#form_create_game')[0];
		var table = $('#game_table').DataTable();
		let formData = new FormData(data);

		$.ajax({
			type: "POST",
			url: "api/game",
			contentType: false,
			processData: false,
			data: formData,
			enctype:"multipart/form-data",
			headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
			dataType: "json",
			success: function(data){
				$.LoadingOverlay("hide");
				toastr["success"](data.status);
				notf();
				table.ajax.reload();
				$('#form_create_game')[0].reset();
			},
			error: function(error) {
				console.log(error);
				
			}
		});
	});

	$('#mdl_upd_game').on('hidden.bs.modal', function (e) {
		$("input[type='hidden']"). remove();
	});

	$('#mdl_upd_game').on('show.bs.modal', function(e) {
		var id = $(e.relatedTarget).attr('data-id');
		$('<input>').attr({type: 'hidden', id:'id',name: 'id',value: id}).appendTo('#form_update_game');
		$.ajax({
			type: "GET",
			url: "api/game/" + id ,
			dataType: "json",
			success: function(data){
				$("#update_title").val(data[0].title);
				$("#update_description").val(data[0].description);
				$("#update_genre_id").val(data[0].genre_id);
				$("#update_price").val(data[0].price);
				$("#update_platform").val(data[0].platform);
				$("#update_stocks").val(data[0].stocks);
				
			},
			error: function(){
				console.log('AJAX load did not work');
			}
		});
	});

	$("#upd_game_btn ").on('click', function(e) {
		e.preventDefault();
		var id = $('#id').val();
		var data = $('#form_update_game')[0];
		var table = $('#game_table').DataTable();
		let formData = new FormData(data);
		$.LoadingOverlay("show");

		$.ajax({
			type: "POST",
			url: "api/game/update/"+id,
			cache: false,
			contentType: false,
			processData: false,
			enctype: "multipart/form-data",
			data: formData,
			headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
			dataType: "json",
			success: function(data){
				$.LoadingOverlay("hide");
				toastr["success"](data.status);

				notf();
				table.ajax.reload();
			},
			error: function(error) {
				console.log(error);
				
			}
		});
	});

	$('#mdl_del_game').on('hidden.bs.modal', function (e) {
		$("input[type='hidden']"). remove();
	});

	$('#mdl_del_game').on('show.bs.modal', function(e) {
		var id = $(e.relatedTarget).attr('data-id');
		$('<input>').attr({type: 'hidden', id:'id',name: 'id',value: id}).appendTo('#form_delete_game');
		$.ajax({
			type: "GET",
			url: "api/game/" + id ,
			dataType: "json",
			success: function(data){
				$("#del_message_game").html(`<h3>Do you Want to Delete <b>`+data[0].title+`</b></h3>`);
			},
			error: function(){
				console.log('AJAX load did not work');
			}
		});
	});

	$("#del_game_btn ").on('click', function(e) {
		e.preventDefault();
		var id = $('#id').val();
		var table = $('#game_table').DataTable();
		$.LoadingOverlay("show");

		$.ajax({
			type: "DELETE",
			url: "api/game/"+ id,
			dataType: "json",
			headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
			success: function(data) {
				$.LoadingOverlay("hide");
				toastr["success"](data.status);
				notf();
				table.ajax.reload();
			},
			error: function(error) {
				console.log('error');
			}
		});
	});

});