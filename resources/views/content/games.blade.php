<div id="game_page" align="center" class="content-fluid" style="display:none;">

	<section class="content-header">
		<h1>
			GAMES: TABLE
		</h1>
		<ol class="breadcrumb">
			<li class="divider"><i class="fa fa-dashboard"></i> Home</li>
			<li class="active">Games</li>
		</ol>
	</section>


	<section class="content-fluid" style="color:white;">
		<div class="col-lg-10 col-sm-12 col-12 main-section" style="background-color: transparent;color: white;">
			<table class="table table-hover table-responsive" style="color:white;max-width: 100%;" id="game_table">
				<thead>
					<tr>
						<th>Game Title</th>
						<th>Description</th>
						<th>Genre</th>
						<th>Price</th>
						<th>Platform</th>
						<th>Stocks</th>
						<th>Image</th>
						<th>Action</th>

					</tr>
				</thead>
				<tbody id="game_body">
				</tbody>
			</table>
		</div></section>
	</div>

	<div class="modal fade" id="mdl_crt_game" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<form id="form_create_game" enctype="multipart/form-data">
			<div class="modal-dialog modal-lg" style="color:black;">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Add New Game</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">
						<div class="mb-3">
							<label for="title" class="form-label">Game Title</label>
							<input  type="text" class="form-control" name="title" />
						</div>
						<div class="mb-3">
							<label for="description" class="form-label">Description:</label>
							<textarea class="form-control" name="description" rows="3"></textarea>
						</div>
						<div class="mb-3">
							<label for="genre_id" class="form-label">Genre Type</label>
							<select class="form-control select_genre_create" name="genre_id" >

							</select>
						</div>
						<div class="mb-3">
							<label for="price" class="form-label">Price</label>
							<input type="number" id="price" name="price" min=0 class="form-control" />
						</div>
						<div class="mb-3">
							<label for="platform" class="form-label">Platform</label>
							<select class="form-control" name="platform">
								<option value="PC">PC</option>
								<option value="console">Console</option>
								<option value="PC and console">PC & Console</option>
							</select>
						</div>
						<div class="mb-3">
							<label for="stocks" class="form-label">Stock</label>
							<input type="number" id="stocks" name="stocks" min=0 class="form-control" />
						</div>
						<div class="mb-3">
							<label for="img" class="form-label">Image</label>
							<input type="file" class="form-control-file" id="img" name="img" multiple accept="image/*" />
						</div>

					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
						<button type="submit" class="btn btn-primary" data-bs-dismiss="modal" id="crt_game_btn">Submit</button>
					</div>
				</div>
			</div>
		</form>
	</div>

	<div class="modal fade" id="mdl_upd_game" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg" style="color:black;">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Update Game</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<form id="form_update_game" enctype="multipart/form-data">
					
					<div class="modal-body">

						<div class="mb-3">
							<label for="update_title" class="form-label">Game Title</label>
							<input  type="text" class="form-control" name="update_title" id="update_title" />
						</div>
						<div class="mb-3">
							<label for="update_description" class="form-label">Description:</label>
							<textarea class="form-control" name="update_description" id="update_description" rows="3"></textarea>
						</div>
						<div class="mb-3">
							<label for="update_genre_id" class="form-label">Genre Type</label>
							<select class="form-control select_genre_create" name="update_genre_id" id="update_genre_id" >
								
							</select>
						</div>
						<div class="mb-3">
							<label for="update_price" class="form-label">Price</label>
							<input type="number" id="update_price" name="update_price" min=0 class="form-control" />
						</div>
						<div class="mb-3">
							<label for="update_platform" class="form-label">Platform</label>
							<select class="form-control" name="update_platform" id="update_platform">
								<option value="PC">PC</option>
								<option value="console">console</option>
								<option value="PC and console">PC and console</option>
							</select>
						</div>
						<div class="mb-3">
							<label for="update_stocks" class="form-label">Stock</label>
							<input type="number" id="update_stocks" name="update_stocks" min=0 class="form-control" />
						</div>
						<div class="mb-3">
							<label for="update_img" class="form-label">image</label>
							<input type="file" class="form-control-file" id="update_img" name="update_img" multiple accept="image/*" />
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
						<button type="submit" class="btn btn-primary" data-bs-dismiss="modal" id="upd_game_btn">Submit</button>
					</div>
				</div>
			</form>
		</div>
	</div>

	<div class="modal fade" id="mdl_del_game" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg" style="color:black;">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Delete Game</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<form id="form_delete_game" method="DELETE" enctype="multipart/form-data">
					
					<div class="modal-body" id="del_message_game">

					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
						<button type="submit" class="btn btn-primary" data-bs-dismiss="modal" id="del_game_btn">Submit</button>
					</div>
				</div>
			</form>
		</div>
	</div>

