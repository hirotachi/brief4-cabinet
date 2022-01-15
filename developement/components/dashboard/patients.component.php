<?php
$patient = [
    uniqid(), "Xun Guiying", "(212) 654-5678", "example@gmail.com", date("m/d/y"), "covid 19"
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
        <span>more</span>
    </div>
    <?php
    for ($i = 0; $i < 5; $i++) {
        [$id, $name, $phone, $email, $date, $sickness] = $patient;
        echo "<div class='patient'>
        <img src='assets/images/avatars/400.jpg' alt='avatar'/>
        <span>$name</span>
        <span>$phone</span>
        <span>$email</span>
        <span>$date</span>
        <span>$sickness</span>
        <div class='more'>
        <span class='more_btn'><i class='far fa-ellipsis-h'></i></span>
            <div class='more_options'>
                <span class='option--danger'>remove</span>
                <span>edit</span>    
            </div>
        </div>
    </div>";
    }
    ?>
</div>