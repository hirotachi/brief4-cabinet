<?php
require_once "../components/layout.component.php";
require_once "../components/nav.component.php";


layoutStart(["layout/contact"]);
nav(); ?>
<div class="contact">
    <!-- les informations -->
    <div class="information">
        <h6>Contact Us</h6>
        <h1>How can I help you?</h1>
        <h5>Fill in the form or drop an email</h5>
        <div class="help">
            <img src='assets/phone-contact.svg' alt='icon'>
            <span>+212600000000</span>
        </div>
        <div class="help">
            <img src='assets/email-contact.svg' alt='icon'/>
            <span>Cabinet Rafik@gmail.com</span>
        </div>
        <div class="help">
            <img src='assets/twitter-contact.svg' alt='icon'/>
            <span>Cabinet Rafik</span>
        </div>
    </div>
    <form>
        <div class="fill">
            <input class="input" type="name" placeholder="Name">
            <input class="input" type="email" placeholder="Email">
            <input class="input" type="Subject" placeholder="Subject">
            <textarea class="input" type="Message" placeholder="Message"></textarea>
            <input type="Submit" value="Submit">
        </div>
    </form>
</div>
<?php layoutEnd(); ?>
