$(document).ready(function() {
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
	$("#genre_table").DataTable({
		responsive: true,
		ajax: {
			url: "api/vapor/all/genres",
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
			text: "Add Genre",
			className: "btn btn-success",

			action: function (e, dt, node, config) {
				$("#form_create_genre").trigger("reset");
				$("#mdl_crt_genre").modal("show");
			},
		},
		],
		columns: [
		{
			data: "genre",
		},
		{
			data: null,
			render: function (data, type, row) {
				return `<a href='#' data-bs-toggle='modal' data-bs-target='#mdl_upd_genre' id='editbtn' data-id="`+data.id + `"><i class='fa fa-pencil' aria-hidden='true' style='font-size:24px;color:lighblue;' ></a></i></td>`;
			},
		},
		{
			data: null,
			render: function (data, type, row) {
				return `<a href='#' data-bs-toggle='modal' data-bs-target='#mdl_del_genre' id='delbtn' data-id="`+ data.id + `"><i class='fa fa-trash' aria-hidden='true' style='font-size:24px;color:maroon;' ></a></i>`;
			},
		},
		],
	});


	$("#crt_genre_btn").on('click', function(e) {
		e.preventDefault(); 
		var data = $("#form_create_genre").serializeArray();
		var table = $('#genre_table').DataTable();
		$.LoadingOverlay("show");

		$.ajax({
			type: "POST",
			url: "api/genre",
			enctype: 'multipart/form-data',
			data: data,
			headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
			dataType: "json",
			success: function(data){
				$.LoadingOverlay("hide");
				toastr["success"](data.status);
				$('#form_create_genre')[0].reset();
				notf();
				table.ajax.reload();
			},
			error: function(error) {
				console.log(error);
				
			}
		});
	});

	$('#mdl_upd_genre').on('hidden.bs.modal', function (e) {
		$("input[type='hidden']"). remove();
	});

	$('#mdl_upd_genre').on('show.bs.modal', function(e) {
		var id = $(e.relatedTarget).attr('data-id');
		$('<input>').attr({type: 'hidden', id:'id',name: 'id',value: id}).appendTo('#form_update_genre');
		$.ajax({
			type: "GET",
			url: "api/genre/" + id ,
			dataType: "json",
			success: function(data){
				$("#update_genre").val(data[0].genre);

			},
			error: function(){
				console.log('AJAX load did not work');
			}
		});
	});

	$("#upd_genre_btn ").on('click', function(e) {
		e.preventDefault();
		var id = $('#id').val();
		var data = $('#form_update_genre').serializeArray();
		var table = $('#genre_table').DataTable();
		$.LoadingOverlay("show");

		$.ajax({
			type: "POST",
			url: "api/genre/update/"+id,
			data: data,
			headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
			dataType: "json",
			success: function(data){
				$.LoadingOverlay("hide");
				toastr["success"](data.status);
				console.log(data);
				notf();
				table.ajax.reload();
			},
			error: function(error) {
				console.log(error);
				
			}
		});
	});

	$('#mdl_del_genre').on('hidden.bs.modal', function (e) {
		$("input[type='hidden']"). remove();
	});

	$('#mdl_del_genre').on('show.bs.modal', function(e) {
		var id = $(e.relatedTarget).attr('data-id');
		$('<input>').attr({type: 'hidden', id:'id',name: 'id',value: id}).appendTo('#form_delete_genre');
		$.ajax({
			type: "GET",
			url: "api/genre/" + id ,
			dataType: "json",
			success: function(data){
				$("#del_message_genre").html(`<h3>Do you Want to Delete <b>`+data[0].genre+`</b></h3>`);
			},
			error: function(){
				console.log('AJAX load did not work');
			}
		});
	});

	$("#del_genre_btn ").on('click', function(e) {
		e.preventDefault();
		var id = $('#id').val();
		var table = $('#genre_table').DataTable();
		$.LoadingOverlay("show");
		$.ajax({
			type: "DELETE",
			url: "api/genre/"+ id,
			dataType: "json",
			headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
			success: function(data) {
				$.LoadingOverlay("hide");
				toastr["success"](data.status);
				console.log(data);
				notf();
				table.ajax.reload();
			},
			error: function(error) {
				console.log('error');
			}
		});
	});


});