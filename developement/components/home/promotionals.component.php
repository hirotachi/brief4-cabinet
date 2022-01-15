<div class="promotionals">
    <?php
    $promotionals = [
        ["title" => "satisfaction guarantee", "icon" => '<i class="far fa-smile"></i>'],
        ["title" => "awesome technology", "icon" => '<i class="fal fa-atom-alt"></i>'],
        ["title" => "professional traumatologue", "icon" => '<i class="fal fa-user-tie"></i>'],
    ];

    foreach ($promotionals as $promotional) {
        $title = $promotional["title"];
        $icon = $promotional["icon"];

        echo "<div class='promotionals__card'>
                               <span class='icon'>$icon</span>
                               <div class='info'>
                               <p class='title'>$title</p>
                               <p class='text'>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Tellus.</p>
                            </div>
                           </div>";
    } ?>
</div>

<?php


