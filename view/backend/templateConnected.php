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
        <script src="public/js/DesignScript.js"></script>
    </head>

    <body>
        <header>
            <div class="menuPrincipal">
                <?php include('view/frontend/headerView.php'); ?>  
            </div>
            <div class="menuIn">
                <?php include('menu.php'); ?> 
            </div>
        </header>

        <?php
        if (isset($_GET['erreur']) || isset($_GET['success']))
        {
            require_once 'view/frontend/alertBox.php';
            echo $alertBox;
        }
        ?>
        <section class="corps corpsConnected">
            <section class="insideSide">
                <?= $content ?>              
            </section>
        </section>
        <!-- tinymce -->
        <script src="https://cdn.tiny.cloud/1/nbm2szncvsw7qyeyg7o32putrav8evdmiwifijffknppjohw/tinymce/5/tinymce.min.js"></script>
        <script src="public/js/tiny.js"></script>
        <script src="public/js/imageUrl.js"></script>
    </body>
</html>

