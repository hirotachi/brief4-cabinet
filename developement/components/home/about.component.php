<?php
$benefits = [
    ["icon" => '<i class="fal fa-heartbeat"></i>', "title" => "complete health care"],
    ["icon" => '<i class="fal fa-hand-holding-usd"></i>', "title" => "affordable price"],
];
?>

<div class="about home--main" id="about">
    <div class="about_img"><img src="assets/images/nurse.png" alt="nurse"></div>
    <div class="info">
        <span class="title">about us</span>
        <p class="moto">we care about your health</p>
        <p class="text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Id parturient ac adipiscing
            turpis purus dignissim sed tortor. Cras.</p>
        <div class="benefits">
            <?php foreach ($benefits as $benefit) {
                $icon = $benefit["icon"];
                $title = $benefit["title"];
                echo "<div class='benefit'>
                        <span class='benefit_icon'>$icon</span>
                        <div class='benefit_info'>                        
                         <p class='benefit_title'>$title</p>
                         <p class='benefit_text'>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Tincidunt.</p>
                        </div>
                    </div>";
            } ?>
        </div>
    </div>
</div>