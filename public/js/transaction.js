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

	$('#mdl_upd_transaction').on('hidden.bs.modal', function (e) {
		$("input[type='hidden']"). remove();
	});

	$('#mdl_upd_transaction').on('show.bs.modal', function(e) {
		var id = $(e.relatedTarget).attr('data-id');
		$('<input>').attr({type: 'hidden', id:'id',name: 'id',value: id}).appendTo('#form_update_transaction');
		$.ajax({
			type: "GET",
			url: "api/trans/" + id ,
			dataType: "json",
			success: function(data){
				// $("#update_transaction").val(data[0].transaction);

			},
			error: function(){
				console.log('AJAX load did not work');
			}
		});
	});

	$("#upd_transaction_btn ").on('click', function(e) {
		e.preventDefault();
		var id = $('#id').val();
		var data = $('#form_update_transaction').serializeArray();
		var table = $('#transaction_table').DataTable();
		$.LoadingOverlay("show");

		$.ajax({
			type: "POST",
			url: "api/trans/update/"+id,
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

	$('#mdl_del_transaction').on('hidden.bs.modal', function (e) {
		$("input[type='hidden']"). remove();
	});

	$('#mdl_del_transaction').on('show.bs.modal', function(e) {
		var id = $(e.relatedTarget).attr('data-id');
		$('<input>').attr({type: 'hidden', id:'id',name: 'id',value: id}).appendTo('#form_delete_transaction');
		$.ajax({
			type: "GET",
			url: "api/trans/" + id ,
			headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),"Authorization":'Bearer ' + localStorage.getItem('token')},
			dataType: "json",
			success: function(data){
				$("#del_message_transaction").html(`<h3>Do you Want to Delete <b>`+data[0].id+`</b></h3>`);
			},
			error: function(e){
				console.log(e);
			}
		});
	});

	$("#del_transaction_btn ").on('click', function(e) {
		e.preventDefault();
		var id = $('#id').val();
		var table = $('#transaction_table').DataTable();
		$.LoadingOverlay("show");
		$.ajax({
			type: "DELETE",
			url: "api/trans/"+ id,
			dataType: "json",
			headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),"Authorization":'Bearer ' + localStorage.getItem('token')},
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