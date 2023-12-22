<div class="pagetitle">
	<h1>Dashboard</h1>
	<nav>
		<ol class="breadcrumb">
			<li class="breadcrumb-item active">Dashboard</li>
		</ol>
	</nav>
	<?= $this->displayMessages(); ?>
</div><!-- End Page Title -->

<section class="section dashboard">
	<div class="row">

		<!-- Left side columns -->
		<div class="col-lg-8">
			<div class="row">

				<!-- Reports -->
				<div class="col-12">
					<div class="card">
						<div class="card-body">
							<h5 class="card-title">Reports <span>/Today</span></h5>
							<hr>
							<form action="<?= ROOT_URL ?>/admin/index/addpost" method="post" enctype="multipart/form-data">
								<div class="mb-3">
									<label for="title">Titre</label>
									<input type="text" name="title" id="title" class="form-control">
								</div>
								<div class="mb-3">
									<label for="content">Contenu</label>
									<textarea name="content" id="content" class="form-control"></textarea>
								</div>
								<div class="mb-3">
									<label for="main_img">Image principale</label>
									<input type="file" name="main_img" id="main_img" class="form-control">
								</div>
								<div class="mb-3">
									<label for="category">Catégories</label>
									<select name="category[]" id="category" multiple class="form-select">
										<?php foreach ($listeCategories as $category) : ?>
											<option value="<?= $category->id_category ?>"><?= $category->category ?></option>
										<?php endforeach; ?>
									</select>
								</div>
								<div class="mb-3">
									<label for="keyword">Mots clés</label>
									<select name="keyword[]" id="keyword" multiple class="form-select">
										<?php foreach ($listeKeywords as $keyword) : ?>
											<option value="<?= $keyword->id_keyword ?>"><?= $keyword->keyword ?></option>
										<?php endforeach; ?>
									</select>
								</div>
								<button type="submit" class="btn btn-outline-primary w-100">Valider <i class="bi bi-file-person"></i></button>
							</form>

						</div>
					</div>
				</div><!-- End Reports -->
			</div>
		</div><!-- End Left side columns -->

		<!-- Right side columns -->
		<div class="col-lg-4">

			<div class="card">
				<div class="card-body">
					<h5 class="card-title">Categories <span>| Blog</span></h5>
					<hr>
					<form action="<?= ROOT_URL ?>/admin/index/addcategory" method="post">
						<div class="mb-3">
							<label for="category">Catégorie</label>
							<input type="text" name="category" id="category" class="form-control">
						</div>
						<button type="submit" class="btn btn-outline-primary w-100">Valider <i class="bi bi-file-person"></i></button>
					</form>
					<hr>
					<table class="table table-bordered">
						<thead class="table-light">
							<tr>
								<th>Catégorie</th>
								<th class="text-end"><i class="bi bi-trash3 btn btn-light"></i></th>
							</tr>
						</thead>
						<tbody>
							<?php foreach ($listeCategories as $category) : ?>
								<tr>
									<td><?= $category->category ?></td>
									<td class="text-end"><a href="<?= ROOT_URL ?>/admin/index/deletecategory/<?= $category->id_category ?>" class="btn btn-danger" onclick="return(confirm('Etes-vous sûr ?'))"><i class="bi bi-trash3"></i></a></td>
								</tr>
							<?php endforeach; ?>
						</tbody>
					</table>


				</div>

			</div>

			<div class="card">
				<div class="card-body">
					<h5 class="card-title">Mots clés <span>| Blog</span></h5>
					<hr>
					<form action="<?= ROOT_URL ?>/admin/index/addkeyword" method="post">
						<div class="mb-3">
							<label for="keyword">Mot clé</label>
							<input type="text" name="keyword" id="keyword" class="form-control">
						</div>
						<button type="submit" class="btn btn-outline-primary w-100">Valider <i class="bi bi-file-person"></i></button>
					</form>
					<hr>
					<table class="table table-bordered">
						<thead class="table-light">
							<tr>
								<th>Mots clés</th>
								<th class="text-end"><i class="bi bi-trash3 btn btn-light"></i></th>
							</tr>
						</thead>
						<tbody>
							<?php foreach ($listeKeywords as $keyword) : ?>
								<tr>
									<td><?= $keyword->keyword ?></td>
									<td class="text-end"><a href="<?= ROOT_URL ?>/admin/index/deletekeyword/<?= $keyword->id_keyword ?>" class="btn btn-danger" onclick="return(confirm('Etes-vous sûr ?'))"><i class="bi bi-trash3"></i></a></td>
								</tr>
							<?php endforeach; ?>
						</tbody>
					</table>

				</div>

			</div>
		</div>

	</div><!-- End Right side columns -->

	</div>
</section>