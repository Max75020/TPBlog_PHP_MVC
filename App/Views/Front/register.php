<main id="main">
	<div class="container mt-5 border p-4">
		<div class="row justify-content-center">
			<div class="col-md-6">
				<h2 class="text-center">Inscription</h2>
				<?php echo isset($msg) ? $msg : NULL; ?>
				<form method="post" action="<?php echo ROOT_URL ?>/register/signup" enctype="multipart/form-data">
					<div class="form-group mb-3">
						<label for="username" class="form-label">Nom d'utilisateur :</label>
						<input type="text" class="form-control" name="username" id="username" placeholder="Entrez votre nom d'utilisateur" required>
					</div>
					<div class="form-group mb-3">
						<label for="email" class="form-label">Email :</label>
						<input type="email" class="form-control" name="email" id="email" placeholder="Entrez votre adresse email" required>
					</div>
					<div class="form-group mb-3">
						<label for="password" class="form-label">Mot de passe :</label>
						<input type="password" class="form-control" name="password" id="password" placeholder="Entrez votre mot de passe" required>
					</div>
					<div class="form-group mb-3">
						<label for="userpicture" class="form-label">Avatar :</label>
						<input type="file" name="userpicture" id="userpicture" class="form-control">
					</div>
					<button type="submit" class="btn btn-outline-primary w-100">S'inscrire</button>
				</form>
			</div>
		</div>
	</div>
	<br>
	<br>
	<br>
</main>