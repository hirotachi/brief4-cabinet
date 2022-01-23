<?php
require_once "../components/layout.component.php";
require_once "../components/nav.component.php";
require_once "../utils/index.php";


adminPageGuard();

layoutStart(["layout/dashboard"], "Cabinet Rafik - Dashboard");
nav();

?>
<div class="dashboard">
    <?php
    require "../components/dashboard/filters.component.php";
    require "../components/dashboard/patients.component.php";
    ?>
</div>
<?php layoutEnd(["dashboard"]); ?>

