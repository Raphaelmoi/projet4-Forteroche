<!-- CONTACT PAGE  -->
<?php $title = 'contact';
ob_start(); ?>

<section class="contactView">
	<h2>Me contacter</h2>
	<p class="formP">Vous êtes éditeur et vous souhaitez publier mon livre ou bien vous êtes un fan trop pudique pour vous exprimer par commentaire? Contactez-moi via ce formulaire :</p>

	<form class="contactForm" action="index.php?action=sendmail" method="post">
		<div>
			<div class="personalInfo">
				<label>Nom</label>
				<input type="text" name="name" placeholder="votre nom" required>
				<label>Mail</label>
				<input type="email" name="mail" placeholder="votre email" required>
				<label>Télephone (optionnel)</label>
				<input type="tel" name="tel" placeholder="votre télephone" >
			</div>
			<div class="textareaContainer">
				<textarea name="msg">  Saisissez ici votre message</textarea>
			</div>
		</div>		
		<input type="submit" name="submit">
	</form>
</section>

<?php
$content = ob_get_clean();
require ('template.php'); ?>