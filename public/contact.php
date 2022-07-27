<?php
require_once "../components/layout.component.php";
require_once "../components/nav.component.php";


layoutStart(["layout/contact"], "Cabinet Rafik - Contact Us");
nav();
?>
    <div class="contact">
        <!-- les informations -->
        <div class="information">
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
        <form>
            <div class="fill">
                <div class="title">
                    <h1>How can I help you?</h1>
                    <h5>Fill in the form or drop an email</h5><br>
                    <span id="error" style="display: none ; color: red">wrong</span>
                    <span id="success" style="display : none; color: green">success</span>
                </div>
                <input class="input" name="username" type="text" placeholder="Your name" required>
                <input class="input" name="email" type="email" placeholder="Your email" required>
                <input class="input" name="subject" type="text" placeholder="Subject" required>
                <textarea class="textarea" name="message" placeholder="Message" required></textarea>
                <input type="Submit" value="Submit">
            </div>
        </form>
    </div>

    <script>

        const contactForm = document.querySelector("form");
        const nameInput = contactForm.querySelector("input[name='username']");
        const emailInput = contactForm.querySelector("input[name= 'email']");
        const subjectInput = contactForm.querySelector("input[name= 'subject']");
        const messageInput = contactForm.querySelector("textarea[name= 'message']");
        const error = contactForm.querySelector("#error");
        const success = contactForm.querySelector("#success");
        contactForm.addEventListener("submit", (event) => {
            event.preventDefault();
            const name = nameInput.value;
            const email = emailInput.value;
            const subject = subjectInput.value;
            const message = messageInput.value;

            fetch("/api/contact", {
                method: "post",
                body: JSON.stringify({name, email, subject, message})
            }).then(res => res.json()).then(data => {
                if (data.message === "success") {
                    success.style.display = "block";
                } else {
                    error.style.display = "block";
                }
            })
        })
    </script>
<?php layoutEnd(); ?>