<!-- Create a new article -->
<?php
$title = 'nouveau billet';
if (empty($_SESSION['pseudo'])) {
	header('Location: /projet4/index.php?action=connect');
}
ob_start();
?>
<form class="tinyForm" method="post" action="index.php?action=addPost" enctype="multipart/form-data">
    <input class="tinyFormTitre" type="titre" name="titre" placeholder="titre du billet" required>
    <textarea name="contenu">Ici le billet himself!</textarea>
        
    <div class="changeThePicture">
        <img src="" id="outputImg"/>
        <div>
            <p >Choisissez l'image qui illustrera l'article : </p>
            <input class="tinyFormImg" type="file" name="fileToUpload" id="fileToUpload" 
            onchange="imageUrl(event)" required>
        </div>
    </div>
    <input class="tinyFormButon" type="submit" value="valider" >
</form>

<?php
$content = ob_get_clean();
require ('templateConnected.php');
?>
