<?php
$database = new Database();
$patient = new Patient($database);


$page = getQueryParams("page", "int") ?? 1;
$search = getQueryParams("search");
$searchQuery = "%$search%";
$patientsCount = $patient->getCount($searchQuery);

$totalPages = ceil($patientsCount / 10);
$patients = array_map(function ($v) {
    $date = date_create($v["birthdate"]);
    return [...$v, "birthdate" => date_format($date, "m/d/Y")];
}, $patient->search(page: $page, search: $searchQuery));

?>


<div class="patients">
    <div class="columns">
        <span></span>
        <span>name</span>
        <span>phone</span>
        <span>email</span>
        <span>birthdate</span>
        <span>sickness</span>
        <span class="columns--more">more</span>
    </div>
    <?php foreach ($patients as $patientData):
        [
            "id" => $id, "firstName" => $firstName, "lastName" => $lastName, "phoneNumber" => $phone, "email" => $email,
            "birthdate" => $date, "sickness" => $sickness
        ] = array_map(function ($v) {
            return $v ?? "N/A";
        }, $patientData); ?>
        <div class='patient'>
            <img src="./assets/images/avatars/400.jpg" alt="avatar"/>
            <span><?= $firstName." ".$lastName ?></span>
            <span><?= $phone ?></span>
            <span><?= $email ?></span>
            <span><?= $date ?></span>
            <span><?= $sickness ?></span>
            <div class='columns--more'>
                <div class='more ' aria-data-id='<?= $id ?>'>
                    <span class='more_btn'><i class='far fa-ellipsis-h'></i></span>
                    <div class='more_options'>
                        <span class='option--danger' onclick='removePatient(this)'>remove</span>
                        <span onclick='editPatient(this)'>edit</span>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>
<?php if ($totalPages > 1):
    $url = preg_replace("/\??(&+)?page=\d+&?/", "", getCurrentUrl());
    $isSearching = str_contains($url, "search=");
    ?>
    <div class="patients_pagination">
        <?php for ($i = 1; $i <= $totalPages; $i++): ?>
            <a href="<?= $url.($i === 1 ? "" : ($isSearching ? "&" : "?")."page=$i") ?>"><?= $i ?></a>
        <?php endfor; ?>
    </div>
<?php endif ?>

<?php require "patient-form.component.php" ?>


<script>
    const patients = JSON.parse('<?=json_encode($patients)?>')
    const patientsMapById = {}
    patients.forEach(p => (patientsMapById[p.id] = p))

    function getIdFromParent(target) {
        return target.parentElement.parentElement.getAttribute("aria-data-id")
    }

    function removePatient(target) {
        const id = getIdFromParent(target)
        const patient = patientsMapById[id];
        const remove = confirm(`do you really want to remove patient id "${id}"`);
        if (remove) {
            fetch(`/api/patients/${id}`, {method: "DELETE"}).then(res => res.json()).then((data) => {
                if (data.message === "success") {
                    routeReplace("/dashboard.php");
                } else {
                    alert(data.message);
                }
            });
        }
    }

    function editPatient(target) {
        const id = getIdFromParent(target);
        const patient = patientsMapById[id];
        openForm(patient);
    }
</script>