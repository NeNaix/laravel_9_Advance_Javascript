<div id="genre_page" align="center"  class="content-fluid" style="display:none;">

	<section class="content-header">
		<h1>
			GENRE'S: TABLE
		</h1>
		<ol class="breadcrumb">
			<li class="divider"><i class="fa fa-dashboard"></i> Home</li>
			<li class="active">genres</li>
		</ol>
	</section>
	<section class="content-fluid">
		<div class="col-lg-10 col-sm-12 col-12 main-section" style="background-color: transparent;color: white;">
				<table class="table table-hover table-responsive" style="color:white;" id="genre_table">
					<thead>
						<tr>
							<th>GENRE </th>					
							<th>Edit</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody id="genre_body">
					</tbody>
				</table>
			</div>
		</section>
	</div>
	
	<div class="modal fade" id="mdl_crt_genre" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<form id="form_create_genre" enctype="multipart/form-data">
			<div class="modal-dialog modal-lg" style="color:black;">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Add New Genre</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">
						<div class="mb-3">
							<label for="genre" class="form-label">Genre</label>
							<input  type="text" class="form-control" name="genre" />
						</div>

					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
						<button type="submit" class="btn btn-primary" data-bs-dismiss="modal" id="crt_genre_btn">Submit</button>
					</div>
				</div>
			</div>
		</form>
	</div>

	<div class="modal fade" id="mdl_upd_genre" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg" style="color:black;">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Update Genre</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<form id="form_update_genre" method="POST" enctype="multipart/form-data">
					<div class="modal-body">
						<div class="mb-3">
							<label for="update_genre" class="form-label">Genre</label>
							<input  type="text" class="form-control" name="update_genre" id="update_genre" />
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
						<button type="submit" class="btn btn-primary" data-bs-dismiss="modal" id="upd_genre_btn">Submit</button>
					</div>
				</div>
			</form>
		</div>
	</div>

	<div class="modal fade" id="mdl_del_genre" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg" style="color:black;">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Delete genre</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<form id="form_delete_genre" method="DELETE" enctype="multipart/form-data">
					
					<div class="modal-body" id="del_message_genre">

					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
						<button type="submit" class="btn btn-primary" data-bs-dismiss="modal" id="del_genre_btn">Submit</button>
					</div>
				</div>
			</form>
		</div>
	</div>

