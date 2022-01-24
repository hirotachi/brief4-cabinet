<?php
require_once "../components/layout.component.php";
require_once "../components/nav.component.php";


layoutStart(["layout/contact"],"Cabinet Rafik - Contact Us");
nav(); ?>
<div class="contact">
    <!-- les informations -->
    <div class ="information">
        <h4>Contact Us</h4>
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
    <form >
        <div class="fill">
            <div class="title">
                <h1>How can I help you?</h1>
                <h5>Fill in the form or drop an email</h5><br>
                <span id="error" style = "display: none ; color: red">wrong</span>
                <span id="success" style = "display : none; color: green">success</span>
            </div>
            <input class="input" name="UserName" type="Username" placeholder="UserName">
            <input class="input" name="email" type="email" placeholder="Email">
            <input class="input" name="Subject" type="Subject" placeholder="Subject">
            <textarea class="textarea" name="Message" type="Message" placeholder="Message"></textarea>
            <input type="Submit" value="Submit">
        </div>
    </form>
</div>

<script>

    const contactform = document.querySelector("form");
    const nameinpute = contactform.querySelector("inpute[name ='UserName']");
    const emailinpute = contactform.querySelector("inpute[name = 'email']");
    const Subjectinpute = contactform.querySelector("inpute[name = 'Subject']");
    const message = contactform.querySelector("textarea[name = 'Message']");
    const error = loginForm.querySelector("#error");
    loginForm.addEventListener("submit", (event) => {
        event.preventDefault();
        const name = UserNameinpute.value;
        const email = emailinpute.value;
        const Subject = Subjectinpute.value;
        const ubject = messageinpute.value;
        message = Messageinpute.value;
        console.log({name, email, subject, message});

        fetch("/api/contact", {method: "post", body: JSON.stringfy({name, email, subject, message})}).then(res => res.json()).then(data => {

            if (message === "success") {
                success.style.display = "block";            
            }else{
                error.style.display = "block";
            }
        })
    })
 </script>
 <? layoutEnd(); ?>