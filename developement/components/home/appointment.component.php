<?php
$info = [
    ['<i class="fal fa-phone-alt"></i>', "(212) 333-7233"],
    ['<i class="fal fa-envelope"></i>', "Hello@cabinetrafik.com"],
    [
        '<i class="fal fa-clock"></i>',
        "<span>Monday - Saturday: 11:00 am - 9:00 pm</span><span>Sunday: 12:00 pm - 7:00 pm</span>"
    ],
];

$inputs = [
    ["text", "first_name", "first name", []],
    ["text", "last_name", "last name", []],
    ["tel", "phone", "phone number", []],
    ["email", "email", "email", []],
    ["select", "request", "request", ["consultation", "checkup"]],
    ["date", "date", "date", []],
    ["textarea", "details", "more details", []],
]
?>


<div class="appointment" id="appointment">
    <div class="appointment_info">
        <div class="appointment_info_intro">
            <h2 class="title">make an appointment</h2>
            <p class="appointment_info_intro_text">
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sollicitudin ipsum viverra et
                in proin sem. Bibendum.
            </p>
        </div>
        <div class="main home--main">
            <p class="main_title">quick contact</p>
            <?php
            foreach ($info as $item) {
                [$icon, $content] = $item;
                echo "<div class='main_info'>
                            <span class='icon'>$icon</span>
                            <div class='content'>$content</div>
                        </div>";
            }
            ?>
        </div>
    </div>
    <div class="appointment_form home--main">
        <p class="appointment_form_title">appointment</p>
        <form>
            <?php
            foreach ($inputs as $input) {
                [$type, $name, $placeholder, $options] = $input;
                echo "<label class='$type'>";
                switch ($type) {
                    case   "select":
                        echo "<select name='$name'>
                                   <option selected disabled>$placeholder</option>
                                ";
                        foreach ($options as $option) {
                            echo "<option value='$option'>$option</option>";
                        }
                        echo "</select>";
                        break;
                    case "textarea":
                        echo "<textarea placeholder='$placeholder' name='$name'></textarea>";
                        break;
                    default:
                        echo "<input type='$type' name='$name' placeholder='$placeholder'/>";
                }
                echo "</label>";
            }
            ?>
            <button>send message</button>
        </form>
    </div>
</div>