<div id="employee_page" align="center" class="content-fluid" style="display:none;">

	<section class="content-header">
		<h1>
			EMPLOYEES: TABLE
		</h1>
		<ol class="breadcrumb">
			<li class="divider"><i class="fa fa-dashboard"></i> Home</li>
			<li class="active">employees</li>
		</ol>
	</section>


	<section class="content-fluid" style="color:white;">
		<div class="col-lg-10 col-sm-12 col-12 main-section" style="background-color: transparent;color: white;">
			<table class="table table-hover table-responsive" style="color:white;max-width: 100%;" id="employee_table">
				<thead>
					<tr>
						<th>Fist Name</th>
						<th>Last Name</th>
						<th>Email</th>
						<th>Address</th>
						<th>Image</th>
						<th>Account Created</th>
						<th>Account Verified</th>
						<th>Action</th>

					</tr>
				</thead>
				<tbody id="employee_body">
				</tbody>
			</table>
		</div></section>
	</div>

	<div class="modal fade" id="mdl_upd_employee" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg" style="color:black;">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Update employee</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<form id="form_update_employee" enctype="multipart/form-data">
					
					<div class="modal-body">

						<div class="row g-6">
							<label class="form-label">employee Name</label>
							<div class="col-6">
								<label for="update_fname" class="visually-hidden">First Name</label>
								<input type="text" class="form-control" name="update_fname_employee" id="update_fname_employee" required>
							</div>
							<div class="col-6">
								<label for="update_lname_employee" class="visually-hidden">Last Name</label>
								<input type="text" class="form-control" name="update_lname_employee" id="update_lname_employee" required>
							</div>
						</div>

						<div class="row g-6">
							<div class="col-5">
								<label for="update_email_employee" class="form-label">Email</label>
								<input type="email" class="form-control" name="update_email_employee" id="update_email_employee" required>
								@error('email')
								<span class="invalid-feedback" role="alert">
									<strong>{{ $message }}</strong>
								</span>
								@enderror
							</div>

							<div class="col-7">
								<label for="update_addr_employee" class="form-label">Address</label>
								<input type="text" class="form-control" name="update_address_employee" id="update_address_employee"  value="{{ old('addr') }}" required>
								@error('address')
								<span class="invalid-feedback" role="alert">
									<strong>{{ $message }}</strong>
								</span>
								@enderror
							</div>
						</div>
						<hr>
						<div class="row g-6">

							<div class="col-12">
								<label for="update_img_employee" class="form-label">image</label>
								<input type="file" class="form-control-file" id="update_img_employee" name="update_img_employee" multiple accept="image/*" />
							</div>
						</div>

						
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
						<button type="submit" class="btn btn-primary" data-bs-dismiss="modal" id="upd_employee_btn">Submit</button>
					</div>
				</div>
			</form>
		</div>
	</div>

	<div class="modal fade" id="mdl_del_employee" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg" style="color:black;">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Delete employee</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<form id="form_delete_employee" method="DELETE" enctype="multipart/form-data">
					
					<div class="modal-body" id="del_message_employee">

					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
						<button type="submit" class="btn btn-primary" data-bs-dismiss="modal" id="del_employee_btn">Submit</button>
					</div>
				</div>
			</form>
		</div>
	</div>

	<div class="modal fade" id="mdl_res_employee" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg" style="color:black;">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Restore employee</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<form id="form_restore_employee"  enctype="multipart/form-data">
					
					<div class="modal-body" id="res_message_employee">

					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
						<button type="submit" class="btn btn-primary" data-bs-dismiss="modal" id="res_employee_btn">Submit</button>
					</div>
				</div>
			</form>
		</div>
	</div>
