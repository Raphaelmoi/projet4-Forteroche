 <?php
require('controller/controller.php');

try {
    //ACCUEIL visiteur
    if (isset($_GET['action'])) {
        if ($_GET['action'] == 'listPosts') {
            listPosts();
        } 
        //page article selon id de celui ci
        elseif ($_GET['action'] == 'post') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                post();
            } else {
                throw new Exception('Aucun identifiant de billet envoyé');
            }
        } 
        //page pour ajouter commentaire 
        elseif ($_GET['action'] == 'addComment') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                if (!empty($_POST['auteur']) && !empty($_POST['commentaire'])) {
                    addComment($_GET['id'], $_POST['auteur'], $_POST['commentaire']);
                } else {
                    throw new Exception('Tous les champs ne sont pas remplis !');
                }
            } else {
                throw new Exception('Aucun identifiant de billet envoyé');
            }
        } 
        //pour modifier commentaire A SUPPRIMER
        elseif ($_GET['action'] == 'modifyCommentView') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                modifyCommentView($_GET['id']);
            } else {
                throw new Exception('Impossible d\'acceder à ce commentaire');
            }
        } 
        //A SUPPRIMER AUSSI
        elseif ($_GET['action'] == 'modifyComment') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                if (!empty($_POST['commentaire']) && !empty($_POST['idArticle'])) {
                    modifyComment($_GET['id'], $_POST['commentaire'], $_POST['idArticle']);
                }
            } else {
                throw new Exception('Impossible de modifier ce commentaire');
            }
        }
        //PAGE BIO
        elseif ($_GET['action'] == 'bio') {
            biographie();
        }
        //PAGE CONTACT
        elseif ($_GET['action'] == 'contact') {
            contact();
        }
        //PAGE POUR SE CONNECTER
        elseif ($_GET['action'] == 'connect') {
            connect();
        }
        //POUR SE DECONNECTER
        elseif ($_GET['action'] == 'disconnect') {
            disconnect();
        }

        //ACCUEIL UNE FOIS CONNECTER
        elseif ($_GET['action'] == 'homeControl') {
            homeControl();
        }
        //PAGE CREATION NOUVEAU BILLET
        elseif ($_GET['action'] == 'nouveaubillet') {
            nouveauBillet();
        }

        // pour ajouter billet 
        elseif ($_GET['action'] == 'addPost') {


            if (!empty($_POST['titre']) && !empty($_POST['contenu']) && isset($_FILES['fileToUpload'])) {
            
                require 'controller/upload.php';                
                imageUploader();
                $target_dir = "public/images/";
                $imageurl = $target_dir . basename($_FILES['fileToUpload']["name"]);
                addPost( $_POST['titre'], $_POST['contenu'], $imageurl);
            } else {
                throw new Exception('Tous les champs ne sont pas remplis !');
            }
        }

        elseif ($_GET['action'] == 'modifyPostView') {
            # recuperer id de l'article
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                modifyPost($_GET['id']);
            }
        }

        elseif ($_GET['action'] == 'modifyPost') {
            # recuperer id de l'article
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                if (!empty($_POST['titre']) && !empty($_POST['contenu'])) {
                    updatePost($_GET['id'], $_POST['titre'], $_POST['contenu']);
                }
            }
        }

        elseif ($_GET['action'] == 'deletePost') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                deletePost($_GET['id']);
            }
        }

        elseif ($_GET['action'] == 'signalcomment') {
            # garde l'id de l'article pour y revenir, ajoute 1 au comm signale
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                if (isset($_GET['commentid']) && $_GET['commentid'] > 0) {
                    signalComment($_GET['id'], $_GET['commentid']);
                }
            }
        }

        elseif ($_GET['action'] == 'badcommentview') {
            badCommentView();
        }

        elseif ($_GET['action'] == 'deletecomment') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                deleteComment($_GET['id']);
            }
        }



        } else {
        listPosts();
    }
}
catch (Exception $e) {
    echo 'Erreur : ' . $e->getMessage();
} 


//créé un espace pour le deuxieme menu si on est connecté
if (!empty($_SESSION['pseudo'])) {?>

         <script type="text/javascript">

                function spaceForSecondMenu(){
                    let aside = document.getElementById('aside');
                    let corps = document.getElementsByClassName('contenuCorps')[0];
                    if (aside != null) {
                        aside.style.top = "100px";
                        corps.style.marginTop ="100px";
                    }
                };
                <?php
                echo "spaceForSecondMenu();"
                ?>
         </script>
     <?php } ?>