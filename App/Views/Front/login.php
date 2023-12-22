<main id="main">
	<div class="container mt-5 border p-4">
		<div class="row justify-content-center">
			<div class="col-md-6">
				<h2 class="text-center">Connexion</h2>
				<?php echo isset($msg) ? $msg : NULL; ?>
				<form method="post" action="<?= ROOT_URL ?>/login/signin" enctype="multipart/form-data">
					<div class="form-group mb-3">
						<label for="username" class="form-label">Nom d'utilisateur :</label>
						<input type="text" class="form-control" name="username" id="username" placeholder="Entrez votre nom d'utilisateur" required>
					</div>
					<div class="form-group mb-3">
						<label for="password" class="form-label">Mot de passe:</label>
						<input type="password" class="form-control" name="password" id="password" placeholder="Entrez votre mot de passe" required>
					</div>
					<button type="submit" class="btn btn-outline-primary w-100">Se connecter</button>
				</form>
			</div>
		</div>
	</div>
	<br>
	<br>
	<br>
	<br>
	<br>
	<br>
	<br>
	<br>
	<br>
</main>