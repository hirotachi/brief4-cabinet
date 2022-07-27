<?php
$stats = [
    [100, "award winner", "red"],
    [500, "happy patient", "blue"],
    [5, "certifications", "green"],
    [20, "years of experience", "orange"],
];
?>

<div class="story">
    <div class="story_main">
        <h2 class="title">short story about cabinet rafik.</h2>
        <p class="text">
            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Urna, viverra lorem scelerisque varius.
            Cursus imperdiet viverra ornare amet feugiat ultricies. Penatibus aliquam quam ultricies viverra facilisis
            vestibulum aliquet quisque. Aliquam quisque justo <span>Read More...</span>
        </p>
        <div class="stats">
            <?php
            foreach ($stats as $stat):
                [$num, $title, $color_class] = $stat;
                ?>
                <div class='stat stat--<?= $color_class ?>'>
                    <span class='stat_num'><?= $num ?>+</span>
                    <span class='stat_title'><?= $title ?></span>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    <div class="story_img"><img src="assets/images/preview-cabinet.jpg" alt="cabinet preview"></div>
</div>