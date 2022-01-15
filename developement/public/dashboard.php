<?php
require_once "../components/layout.component.php";
require_once "../components/nav.component.php";


layoutStart(["layout/dashboard"], "Cabinet Rafik - Dashboard");
nav();

?>
<div class="dashboard">
    <?php
    require "../components/dashboard/filters.component.php";
    ?>
</div>
<?php layoutEnd(); ?>

