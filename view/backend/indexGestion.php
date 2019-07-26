<!-- Explication of the mecanism 
    4 situations
    -> we want normal view and chronogical order
    -> we want normal view and antichronogical order
    -> we want inline view and chronogical order
    -> we want inline view and antichronogical order    
-->
<?php
ob_start();
?>
<article class="homeGestionnaire">   
    <?php 
    if (isset($_GET['styleView']) && $_GET['styleView'] == 'inline'){

        if(isset($_GET['sort']) && $_GET['sort'] == "antichrono" ){
        ?>
            <a href="index.php?action=homeControl&amp;sort=antichrono&amp;styleView=basic">
                <i class="fas fa-align-justify"><span>Vue</span></i>
            </a>
            <a href="index.php?action=homeControl&amp;sort=chrono&amp;styleView=inline">
                <i class="fas fa-sort"><span> Ordre chronologique</span></i>
            </a>
        <?php }

        elseif (!isset($_GET['sort']) || $_GET['sort'] == "chrono") {
        ?>
            <a href="index.php?action=homeControl&amp;styleView=basic">
                <i class="fas fa-align-justify"><span>Vue</span></i>
            </a>
            <a href="index.php?action=homeControl&amp;sort=antichrono&amp;styleView=inline">
                <i class="fas fa-sort"><span> Ordre antichronologique</span></i>
            </a>
        <?php
        }
    } 
    elseif (!isset($_GET['styleView']) || $_GET['styleView'] == 'basic') {
        if(isset($_GET['sort']) && $_GET['sort'] == "antichrono" ){
            ?>
            <a href="index.php?action=homeControl&amp;sort=antichrono&amp;styleView=inline">
                <i class="fas fa-align-justify"><span>Vue</span></i>
            </a>
            <a href="index.php?action=homeControl&amp;sort=chrono&amp;styleView=basic">
                <i class="fas fa-sort"><span> Ordre chronologique</span></i>
            </a>            
        <?php }

        elseif (!isset($_GET['sort']) || $_GET['sort'] == "chrono") {
        ?>
        <a href="index.php?action=homeControl&amp;styleView=inline">
            <i class="fas fa-align-justify"><span>Vue</span></i>
        </a>
        <a href="index.php?action=homeControl&amp;sort=antichrono&amp;styleView=basic">
            <i class="fas fa-sort"><span> Ordre antichronologique</span></i>
        </a>
        <?php
        }
    }
 ?>           
</article>

<?php
$gestionOfArticle = ob_get_clean();
?>