<?php
require_once "../components/layout.component.php";
require_once "../components/nav.component.php";


layoutStart(["layout/home"]);
nav();

?>
<div class="home">
    <div class="intro">intro section</div>
    <?php
    require "../components/home_promotionals.php";
    ?>
</div>
<?php layoutEnd(); ?>
