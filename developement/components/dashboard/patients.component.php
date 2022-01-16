<?php
$patients = [
    [
        "id" => uniqid(), "firstName" => "xun", "lastName" => "guiying", "phone" => "(212) 654-5678",
        "email" => "example@gmail.com",
        "date" => date("m/d/Y"), "sickness" => "covid 19"
    ]
];
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
    <?php
    for ($i = 0; $i < 5; $i++) {
        [
            "id" => $id, "firstName" => $firstName, "lastName" => $lastName, "phone" => $phone, "email" => $email,
            "date" => $date, "sickness" => $sickness
        ] = $patients[0];
        echo "<div class='patient'>
        <img src='assets/images/avatars/400.jpg' alt='avatar'/>
        <span>$firstName $lastName</span>
        <span>$phone</span>
        <span>$email</span>
        <span>$date</span>
        <span>$sickness</span>
        <div class='columns--more'>
            <div class='more ' aria-data-id='$id'>
            <span class='more_btn'><i class='far fa-ellipsis-h'></i></span>
            <div class='more_options'>
                <span class='option--danger' onclick='removePatient(this)'>remove</span>
                <span onclick='editPatient(this)'>edit</span>    
            </div>
            </div>
        </div>
    </div>";
    }
    ?>
</div>
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

        console.log(`removing patient ${patient.name}`)
    }

    function editPatient(target) {
        const id = getIdFromParent(target);
        const patient = patientsMapById[id];
        openForm(patient);
    }
</script>