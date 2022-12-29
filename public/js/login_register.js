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
	$.LoadingOverlay("show");

	function format(d) {
		var string = '';
		d.orderlines.forEach(function(data) {
			string = string + `<tr>`;
			string = string + `<td>`+data.game.title+`</td>`;
			string = string + `<td>`+data.game.price+`</td>`;
			string = string + `<td>`+data.qty+`</td>`;
			string = string + `<td>`+data.total+`</td>`;
			string = string + `</tr>`;
		});

		return (`
			<table class="table table-hover table-responsive" style="color:white;background-color:black;">
			<thead>
			<tr>
			<th>Game Title</th>
			<th>price id</th>
			<th>quantity </th>	
			<th>Amount </th>				
			</tr>
			</thead>
			<tbody>
			`+string+`
			<tr><td></td><td>Total</td><td>:</td><td>Php `+d.total_amount+`</td>
			</tr>
			</tbody>
			</table>
			`);
	}

	$('#transaction_table tbody').on('click', 'td.dt-control', function () {
		var tr = $(this).closest('tr');
		var row = table.row(tr);

		if (row.child.isShown()) {
            // This row is already open - close it
			row.child.hide();
			tr.removeClass('shown');
		} else {
            // Open this row
			row.child(format(row.data())).show();
			tr.addClass('shown');
		}
	});

	$.ajax({
		type: "POST",
		url: "/refresh_page",
		dataType:'json',
		headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
		success: function (response) {
			if(response.status == "success") {
				window.localStorage.setItem('token', response.authorisation.token);
				$.LoadingOverlay("hide");
				toastr["success"](response.status);
				console.log(response);
				notf();
				$(".user-profile").show();
				$("#login_div").hide();
				$("#register_div").hide();
				$(".username").html(response.user.fname+" "+response.user.lname);
				$(".role").html(response.user.role);
				$("#transaction_table").DataTable({
					responsive: true,
					ajax: {
						url: "api/trans",
						headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),"Authorization":'Bearer ' + localStorage.getItem('token')},
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
						data: "id",
					},
					{
						className: 'dt-control',
						orderable: false,
						data: null,
						defaultContent: 'show',
					},
					{
						data: "created_at",
					},
					{
						data: "status",
					},
					{
						data: null,
						render: function (data, type, row) {
							return `<a href='#' data-bs-toggle='modal' data-bs-target='#mdl_del_transaction' id='delbtn' data-id="`+ data.id + `"><i class='fa fa-trash' aria-hidden='true' style='font-size:24px;color:maroon;' ></a></i>`;
						},
					},
					],
				});
				if (response.user.role == 'admin') {
					$(".point02").show('slow');
					$(".point03").show('slow');
					$(".point04").show('slow');
					$(".point05").show('slow');
					$(".point06").show('slow');
				}else if(response.user.role == 'employee'){
					$(".point02").show('slow');
					$(".point03").show('slow');
					$(".point05").show('slow');
					$(".point06").show('slow');
				}else{
					$("#cart_show").show();
					$(".point06").show('slow');
				}
			}else{
				$.LoadingOverlay("hide");
				console.log(response);

			}
		},
		error: function (error) {
			$.LoadingOverlay("hide");
			alert(error);
			console.log(error);
		}
	});

	$("#btn_login").click(function(e) {
		e.preventDefault();
		var data = $('#login_form').serializeArray();
		$.LoadingOverlay("show");
		$.ajax({
			type: "POST",
			url: "/login",
			data: data,
			headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
			dataType:'json',
			success: function (response) {
				$.LoadingOverlay("hide");
				toastr["success"](response.status);
				console.log(response);
				window.localStorage.setItem('token', response.authorisation.token);
				console.log(localStorage.getItem('token'));
				notf();
				$("#login").modal('hide');
				$(".user-profile").show('slow');
				$("#login_div").hide('slow');
				$("#register_div").hide('slow');
				$(".username").html(response.user.fname+" "+response.user.lname);
				$("#transaction_table").DataTable({
					responsive: true,
					ajax: {
						url: "api/trans",
						headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),"Authorization":'Bearer ' + localStorage.getItem('token')},
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
						data: "id",
					},
					{
						className: 'dt-control',
						orderable: false,
						data: null,
						defaultContent: 'show',
					},
					{
						data: "created_at",
					},
					{
						data: "status",
					},
					{
						data: null,
						render: function (data, type, row) {
							return `<a href='#' data-bs-toggle='modal' data-bs-target='#mdl_del_transaction' id='delbtn' data-id="`+ data.id + `"><i class='fa fa-trash' aria-hidden='true' style='font-size:24px;color:maroon;' ></a></i>`;
						},
					},
					],
				});
				if (response.user.role == 'admin') {
					$(".point02").show('slow');
					$(".point03").show('slow');
					$(".point04").show('slow');
					$(".point05").show('slow');
					$(".point06").show('slow');
				}else if(response.user.role == 'employee'){
					$(".point02").show('slow');
					$(".point03").show('slow');
					$(".point05").show('slow');
					$(".point06").show('slow');
				}else{
					$("#cart_show").show();
					$(".point06").show('slow');
				}

				$('#login_form')[0].reset();
			},
			error: function (error) {
				$.LoadingOverlay("hide");
				toastr["error"](error.responseText);
				console.log(error);
				notf();
			}
		});
	});

	$("#logout").click(function(e) {
		e.preventDefault();
		$.LoadingOverlay("show");
		$.ajax({
			type: "POST",
			url: "/logout",
			dataType:'json',
			headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),"Authorization":'Bearer ' + localStorage.getItem('token')},
			success: function (response) {
				localStorage.removeItem('token');
				$.LoadingOverlay("hide");
				$(".profile-hover").toggle();
				$(".popup-overlay").toggle();
				console.log(response);
				toastr["success"](response.message);
				notf();
				$("#cart_show").hide();
				$("#login_div").show('slow');
				$("#register_div").show('slow');
				$(".user-profile").hide('slow');
				$(".point02").hide('slow');
				$(".point03").hide('slow');
				$(".point04").hide('slow');
				$(".point05").hide('slow');
				$(".point06").hide('slow');
				$('#employee_page').hide('slow');
		        $('#main_page').show();
		        $('#game_page').hide('slow');
		        $('#genre_page').hide('slow');
		        $('#customer_page').hide('slow');
		        $('#transaction_page').hide('slow');
		        $("#transaction_table").DataTable().destroy();
			},
			error: function (error) {
				$.LoadingOverlay("hide");
				alert(error);
				console.log(error);
			}
		});
	});

	$("#btn_reg_customer").click(function(e) {
		e.preventDefault();
		var data = $('#reg_customer_form')[0];
		let formData = new FormData(data);
		console.log(data);
		$.LoadingOverlay("show");

		$.ajax({
			type: "POST",
			url: "/register",
			data: formData,
			contentType: false,
			processData: false,
			headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
			dataType:'json',
			success: function (response) {
				$.LoadingOverlay("hide");
				console.log(response);
				toastr["success"](response.message);
				notf();
				
			},
			error: function (error) {
				$.LoadingOverlay("hide");
				console.log(error);
			}
		});
	});

	$("#btn_reg_employee").click(function(e) {
		e.preventDefault();
		var data = $('#reg_employee_form')[0];
		let formData = new FormData(data);
		console.log(data);
		$.LoadingOverlay("show");
		$.ajax({
			type: "POST",
			url: "/register",
			data: formData,
			contentType: false,
			processData: false,
			headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
			dataType:'json',
			success: function (response) {
				$.LoadingOverlay("hide");
				console.log(response);
				toastr["success"](response.message);
				notf();
			},
			error: function (error) {
				$.LoadingOverlay("hide");
				console.log(error);
			}
		});
	});
	
});