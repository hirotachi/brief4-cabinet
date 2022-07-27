<?php
require_once "../components/layout.component.php";
require_once "../components/nav.component.php";
require_once "api/index.php";


layoutStart(["layout/home"]);
nav(["home--main"]);

?>
<div class="home">
    <?php
    require "../components/home/intro.component.php";
    require "../components/home/promotionals.component.php";
    require "../components/home/about.component.php";
    require "../components/home/services.component.php";
    require "../components/home/story.component.php";
    require "../components/home/appointment.component.php";
    require "../components/home/location.component.php";
    require "../components/home/reviews.component.php";
    require "../components/home/subscription.component.php";
    ?>
</div>
<?php layoutEnd(); ?>
