<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="Billet simple pour l'Alaska : le blog de Jean Forteroche">
        <title>Jean Forteroche</title>
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="public/style.css">
        <link href="https://fonts.googleapis.com/css?family=Mali:300|Open+Sans&display=swap" rel="stylesheet">     </head>
    <body>
        <header>
            <div class="menuPrincipal">
                <?php include('headerView.php'); ?>  
            </div>
            <div class="menuIn">
                <?php include('connectedViews/menu.php'); ?> 
            </div>
        </header>
        <section class="corps">
            <section class="contenuCorps">
                <?= $content ?>              
            </section>
            <aside id="aside">
                <?php include('asideView.php'); ?>
            </aside>
        </section>
        <script type="text/javascript" src="public/designOnClick.js"></script>

    </body>
</html>

