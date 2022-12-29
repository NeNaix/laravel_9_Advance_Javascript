<div id="customer_page" align="center" class="content-fluid" style="display:none;">

	<section class="content-header">
		<h1>
			CUSTOMERS: TABLE
		</h1>
		<ol class="breadcrumb">
			<li class="divider"><i class="fa fa-dashboard"></i> Home</li>
			<li class="active">customers</li>
		</ol>
	</section>


	<section class="content-fluid" style="color:white;">
		<div class="col-lg-10 col-sm-12 col-12 main-section" style="background-color: transparent;color: white;">
			<table class="table table-hover table-responsive" style="color:white;max-width: 100%;" id="customer_table">
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
				<tbody id="customer_body">
				</tbody>
			</table>
		</div></section>
	</div>
	
	<div class="modal fade" id="mdl_upd_customer" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg" style="color:black;">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Update customer</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<form id="form_update_customer" enctype="multipart/form-data">
					
					<div class="modal-body">

						<div class="row g-6">
							<label class="form-label">Customer Name</label>
							<div class="col-6">
								<label for="update_fname_customer" class="visually-hidden">First Name</label>
								<input type="text" class="form-control" name="update_fname_customer" id="update_fname_customer" required>
							</div>
							<div class="col-6">
								<label for="update_lname_customer" class="visually-hidden">Last Name</label>
								<input type="text" class="form-control" name="update_lname_customer" id="update_lname_customer" required>
							</div>
						</div>

						<div class="row g-6">
							<div class="col-5">
								<label for="update_email_customer" class="form-label">Email</label>
								<input type="email" class="form-control" name="update_email_customer" id="update_email_customer" required>
								@error('email')
								<span class="invalid-feedback" role="alert">
									<strong>{{ $message }}</strong>
								</span>
								@enderror
							</div>

							<div class="col-7">
								<label for="update_addr_customer" class="form-label">Address</label>
								<input type="text" class="form-control" name="update_address_customer" id="update_address_customer"  value="{{ old('addr') }}" required>
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
								<label for="update_img_customer" class="form-label">image</label>
								<input type="file" class="form-control-file" id="update_img_customer" name="update_img_customer" multiple accept="image/*" />
							</div>
						</div>

						
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
						<button type="submit" class="btn btn-primary" data-bs-dismiss="modal" id="upd_customer_btn">Submit</button>
					</div>
				</div>
			</form>
		</div>
	</div>

	<div class="modal fade" id="mdl_del_customer" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg" style="color:black;">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Delete customer</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<form id="form_delete_customer" method="DELETE" enctype="multipart/form-data">
					
					<div class="modal-body" id="del_message_customer">

					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
						<button type="submit" class="btn btn-primary" data-bs-dismiss="modal" id="del_customer_btn">Submit</button>
					</div>
				</div>
			</form>
		</div>
	</div>

	<div class="modal fade" id="mdl_res_customer" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg" style="color:black;">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Restore customer</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<form id="form_restore_customer"  enctype="multipart/form-data">
					
					<div class="modal-body" id="res_message_customer">

					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
						<button type="submit" class="btn btn-primary" data-bs-dismiss="modal" id="res_customer_btn">Submit</button>
					</div>
				</div>
			</form>
		</div>
	</div>
