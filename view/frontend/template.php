<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="Billet simple pour l'Alaska : le blog de Jean Forteroche">
        <title>Jean Forteroche</title>
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="public/css/style.css">
        <link href="https://fonts.googleapis.com/css?family=Mali:300|Open+Sans&display=swap" rel="stylesheet">
        <?php
        //create the space for the second menu if connected
        if (!empty($_SESSION['pseudo'])) {
        ?>
            <script src="public/js/DesignScript.js"></script>
        <?php
        }
        ?>
    </head>
    <body>
        <header>
            <div class="menuPrincipal">
                <?php include('headerView.php'); ?>  
            </div>
            <div class="menuIn">
                <?php include('view/backend/menu.php'); ?> 
            </div>
        </header>
        
        <?php 
        if (isset($_GET['erreur']) || isset($_GET['success']))
        {
            require_once 'alertBox.php';
            echo $alertBox;
        }
        ?>
        <section class="corps">
            <section class="contenuCorps">
                <?= $content ?>              
            </section>
            <aside id="aside">
                <?php include('asideView.php'); ?>
            </aside>
        </section>
    </body>
</html>

