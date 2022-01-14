<div class="reviews">
    <div class="reviews_intro">
        <h2 class="title">reviews from out patient.</h2>
        <p class="text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nibh pellentesque gravida fames quisque
            vulputate id diam porttitor. Velit pulvinar hendrerit.</p>
    </div>
    <div class="reviews_list">
        <?php
        for ($i = 0; $i < 3; $i++) {
            echo "
            <div class='review'>
                <img src='assets/images/avatars/400.jpg' alt='avatar'/>
                <p class='name'>andrew smith</p>
                <p class='text'>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut volutpat sollicitudin.</p>
                <div class='rates'>
            ";
            for ($j = 0; $j < 5; $j++) {
                echo '<span><i class="fas fa-star"></i></span>';
            }
            echo "</div></div>";
        }
        ?>
    </div>
</div>