<?php
require_once "../components/layout.component.php";
require_once "../components/nav.component.php";
require_once "../utils/index.php";

@include_once "../src/models/index.php";


adminPageGuard();

layoutStart(["layout/dashboard"], "Cabinet Rafik - Dashboard");
nav();

?>
<div class="dashboard">
    <button onclick="logout()" class="dashboard_logout" title="logout"><i class="fal fa-sign-out"></i></button>
    <?php
    require "../components/dashboard/filters.component.php";
    require "../components/dashboard/patients.component.php";
    ?>
    <script>
        function logout() {
            fetch("/api/logout").then(() => {
                routeReplace("/login.php");
            })
        }
    </script>
</div>
<?php layoutEnd(["dashboard"]); ?>

