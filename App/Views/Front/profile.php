<main style="background-color: #f4f5f7;">
	<div class="container py-5 ">
		<h2 class="text-center mb-5">Mon Profil</h2>
		<div class="row d-flex justify-content-center align-items-center">
			<div class="col col-lg-6">
				<div class="card mb-3">
					<div class="row align-items-center">
						<div class="col-md-4 gradient-custom text-center text-white">
							<img src="<?php echo ROOT_URL . '/Public/img/avatar/'  . $user['userpicture'] ?>" alt="avatar" class="rounded-circle img-fluid" style="width: 150px;">
						</div>
						<div class="col-md-8">
							<div class="card-body p-4">
								<h6>Information</h6>
								<hr class="mt-0 mb-4">
								<div class="row pt-1">
									<div class="col-6 mb-3">
										<h6>Nom d'utilisateur</h6>
										<p class="text-muted"><?= $user['username'] ?></p>
									</div>
									<div class="col-6 mb-3">
										<h6>Adresse mail</h6>
										<p class="text-muted"><?= $user['email'] ?></p>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<br>
	<br>
	<br>
	<br>
	<br>
</main>