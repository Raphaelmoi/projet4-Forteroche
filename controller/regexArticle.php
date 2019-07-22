<?php
//fait disparaitre image et video des extraits
//plus donne une longueur max a l'extrait de 600 caracteres
function formateArticle($ContenuBillet){

    if(preg_match("/<img[^>]+\>/i", $ContenuBillet)) {
        $ContenuBillet = preg_replace("/<img[^>]+\>/i", "", $ContenuBillet); 
    }
    if(preg_match("/<iframe[^>]+\>/i", $ContenuBillet)) {
         $ContenuBillet = preg_replace("/<iframe[^>]+\>/i", "", $ContenuBillet); 
    }
    $ContenuBillet = substr($ContenuBillet, 0, 520).'...'; 
    return $ContenuBillet;
}

?>