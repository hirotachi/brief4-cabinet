<?php
$services = [
    ['<i class="fal fa-user-injured"></i>', "injuries treatment"],
    ['<i class="fal fa-fire-smoke"></i>', "burns treatment"],
    ['<i class="fal fa-pills"></i>', "proper medicine"],
];
?>

<div class="services" id="services">
    <div class="services_intro">
        <h2 class="title">our services</h2>
        <p class="text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Iaculis varius et in etiam est tortor
            in cursus.</p>
    </div>
    <?php
    foreach ($services as $service):
        [$icon, $title] = $service;
        ?>

        <div class='service'>
            <span class='service_icon'><?= $icon ?></span>
            <div class='service_info'>
                <p class='title'><?= $title ?></p>
                <p class='text'>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Tortor feugiat mattis eu
                    consequat metus justo. Enim aliquet aliquet.</p>
            </div>
        </div>


    <?php endforeach; ?>
</div>
