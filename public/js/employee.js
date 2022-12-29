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
	$("#employee_table").DataTable({
		responsive: true,
		ajax: {
			url: "api/vapor/all/employees",
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
		],
		columns: [
		{
			data: "fname",
		},
		{
			data: "lname",
		},
		{
			data: "email",
		},
		{
			data: "address",
		},
		{
			data: null,
			render: function (data, type, JsonResultRow, row) {
				return '<img src="' + JsonResultRow.img + '" height="100px" width="100px">';
			}
		},
		{
			data: "created_at",
		},
		{
			data: "email_verified_at",
		},
		{
			data: null,
			render: function (data, type, row) {
				if (data.deleted_at) {
					return `<div class="btn-group mr-2">
					<button data-bs-toggle='modal' data-bs-target='#mdl_res_employee' id='delbtn' data-id="`+ data.id + `"><i class='fa fa-undo' aria-hidden='true' style='font-size:24px;color:maroon;'></i></button></div>
					`;
				}else{
					return `<div class="btn-group mr-2"><button data-bs-toggle='modal' data-bs-target='#mdl_upd_employee' id='editbtn' data-id="`+data.id + `"><i class='fa fa-pencil' aria-hidden='true' style='font-size:24px;color:lighblue;' ></i></button>
					<button data-bs-toggle='modal' data-bs-target='#mdl_del_employee' id='delbtn' data-id="`+ data.id + `"><i class='fa fa-trash' aria-hidden='true' style='font-size:24px;color:maroon;'></i></button></div>
					`;

				}
				
			},
		},
		],
	});

	$('#mdl_upd_employee').on('hidden.bs.modal', function (e) {
		$("input[type='hidden']"). remove();
	});

	$('#mdl_upd_employee').on('show.bs.modal', function(e) {
		var id = $(e.relatedTarget).attr('data-id');
		$('<input>').attr({type: 'hidden', id:'id',name: 'id',value: id}).appendTo('#form_update_employee');
		$.ajax({
			type: "GET",
			url: "api/employee/" + id ,
			dataType: "json",
			success: function(data){
				$("#update_fname_employee").val(data[0].fname);
				$("#update_lname_employee").val(data[0].lname);
				$("#update_email_employee").val(data[0].email);
				$("#update_address_employee").val(data[0].address);
				
			},
			error: function(){
				console.log('AJAX load did not work');
			}
		});
	});

	$("#upd_employee_btn ").on('click', function(e) {
		e.preventDefault();
		var id = $('#id').val();
		var data = $('#form_update_employee')[0];
		var table = $('#employee_table').DataTable();
		let formData = new FormData(data);
		console.log(formData);

		$.LoadingOverlay("show");

		$.ajax({
			type: "POST",
			url: "api/employee/update/"+id,
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

	$('#mdl_del_employee').on('hidden.bs.modal', function (e) {
		$("input[type='hidden']"). remove();
	});

	$('#mdl_del_employee').on('show.bs.modal', function(e) {
		var id = $(e.relatedTarget).attr('data-id');
		$('<input>').attr({type: 'hidden', id:'id',name: 'id',value: id}).appendTo('#form_restore_employee');
		$.ajax({
			type: "GET",
			url: "api/employee/" + id ,
			dataType: "json",
			success: function(data){
				$("#del_message_employee").html(`<h3>Do you Want to Delete <b>`+data[0].fname +" "+data[0].lname+` ?</b></h3>`);
			},
			error: function(){
				console.log('AJAX load did not work');
			}
		});
	});

	$("#del_employee_btn ").on('click', function(e) {
		e.preventDefault();
		var id = $('#id').val();
		var table = $('#employee_table').DataTable();
		$.LoadingOverlay("show");


		$.ajax({
			type: "DELETE",
			url: "api/employee/"+ id,
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

	$('#mdl_res_employee').on('hidden.bs.modal', function (e) {
		$("input[type='hidden']"). remove();
	});

	$('#mdl_res_employee').on('show.bs.modal', function(e) {
		var id = $(e.relatedTarget).attr('data-id');
		$('<input>').attr({type: 'hidden', id:'id',name: 'id',value: id}).appendTo('#form_restore_employee');
		$.ajax({
			type: "GET",
			url: "api/employee/" + id ,
			dataType: "json",
			success: function(data){
				$("#res_message_employee").html(`<h3>Do you Want to Restore <b>`+data[0].fname +" "+data[0].lname+` ?</b></h3>`);
			},
			error: function(){
				console.log('AJAX load did not work');
			}
		});
	});

	$("#res_employee_btn ").on('click', function(e) {
		e.preventDefault();
		var id = $('#id').val();
		var table = $('#employee_table').DataTable();
		$.LoadingOverlay("show");

		$.ajax({
			type: "GET",
			url: "api/employee/restore/"+ id,
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