<?php
require_once "../components/layout.component.php";
require_once "../components/nav.component.php";


layoutStart(["layout/home"]);
nav(["home--main"]);

?>
<div class="home">
    <?php
    require "../components/home/intro.php";
    require "../components/home/promotionals.php";
    require "../components/home/about.php";
    require "../components/home/services.php";
    ?>
</div>
<?php layoutEnd(); ?>
