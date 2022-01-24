<?php
require_once "../components/layout.component.php";
require_once "../components/nav.component.php";
require_once "../utils/index.php";

$adminId = getAdminIdFromSession();
if ($adminId) {
    // redirect to dashboard if user already logged in
    header("location: dashboard.php");
}

layoutStart(["layout/login"]);
nav();
?>
<div class="login">
    <form>
        <div class="fil">
            <h1>sign in for admin</h1>
            <span id="error" style="display: none; color: red">wrong password or username</span>
            <div class="username">
                <label>username</label>
                <input class="input" type="username" placeholder="username" name="username" required>
            </div>
            <div class="password">
                <label>password</label>
                <input class="input" type="password" placeholder="password" name="password" required>
            </div>
            <input class="botton" type="Submit" value="Submit">
        </div>
    </form>
</div>

<script>
    const loginForm = document.querySelector("form");
    const usernameInput = loginForm.querySelector("input[name='username']");
    const passwordInput = loginForm.querySelector("input[name='password']");
    const errorEl = loginForm.querySelector("#error");
    loginForm.addEventListener("submit", (e) => {
        e.preventDefault();
        const username = usernameInput.value;
        const password = passwordInput.value;
        fetch("/api/login", {
            method: "POST",
            body: JSON.stringify({username, password})
        }).then((res) => res.json()).then((data) => {
            const message = data.message;
            if (message === "success") {
                routeReplace("/dashboard.php");
            } else {
                errorEl.style.display = "block";
            }
        })
    })
</script>
<?php layoutEnd(); ?>
