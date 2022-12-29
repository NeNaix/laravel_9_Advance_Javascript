<div id="transaction_page" align="center"  class="content-fluid" style="display:none;">

	<section class="content-header">
		<h1>
			transaction'S: TABLE
		</h1>
		<ol class="breadcrumb">
			<li class="divider"><i class="fa fa-dashboard"></i> Home</li>
			<li class="active">transactions</li>
		</ol>
	</section>
	<section class="content-fluid" style="color:white;">
		<div class="col-lg-10 col-sm-12 col-12 main-section" style="background-color: transparent;color: white;">
				<table class="table table-hover table-responsive" style="color:white;width: 650px;" id="transaction_table">
					<thead>
						<tr>
							<th>Transaction id</th>
							<th>Orderlines </th>	
							<th>Date Ordered</th>
							<th>Status</th>			
							<th>Action</th>
						</tr>
					</thead>
					<tbody id="transaction_body" >
					</tbody>
				</table>
			</div>
		</section>
	</div>

	<div class="modal fade" id="mdl_upd_transaction" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg" style="color:black;">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Update transaction</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<form id="form_update_transaction" method="POST" enctype="multipart/form-data">
					<div class="modal-body" id="update_transaction">
						<div class="row g-6">
                                  <label class="form-label">Customer Name</label>
                                    <div class="col-6">
                                        <label for="fname" class="visually-hidden">games</label>
                                        <input type="text" class="form-control" name="fname" placeholder="First Name"  required>
                                    </div>
                                    <div class="col-2">
                                        <label for="inputPassword2" class="visually-hidden">Last Name</label>
                                        <input type="text" class="form-control" name="lname" placeholder="Last Name"  required>
                                    </div>
                                    <div class="col-2">
                                        <label for="inputPassword2" class="visually-hidden">Quantity</label>
                                        <input type="text" class="form-control" name="lname" placeholder="Last Name"  required>
                                    </div>
                                    <div class="col-2">
                                        <label for="inputPassword2" class="visually-hidden">Quantity</label>
                                        <input type="text" class="form-control" name="lname" placeholder="Last Name"  required>
                                    </div>
                                </div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
						<button type="submit" class="btn btn-primary" data-bs-dismiss="modal" id="upd_transaction_btn">Submit</button>
					</div>
				</div>
			</form>
		</div>
	</div>

	<div class="modal fade" id="mdl_del_transaction" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg" style="color:black;">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Delete transaction</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<form id="form_delete_transaction" method="DELETE" enctype="multipart/form-data">
					
					<div class="modal-body" id="del_message_transaction">

					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
						<button type="submit" class="btn btn-primary" data-bs-dismiss="modal" id="del_transaction_btn">Submit</button>
					</div>
				</div>
			</form>
		</div>
	</div>

