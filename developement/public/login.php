<?php
require_once "../components/layout.component.php";
require_once "../components/nav.component.php";


layoutStart(["layout/login"]);
nav(); ?>
    <div class="login">
        <form>
            <div class="fil">
                <h1>sign in for admin</h1>
                <div class="username">
                    <label>username</label>
                    <input class="input" type="username" placeholder="username">
                </div>
                <div class="password">
                    <label>password</label>
                    <input class="input" type="password" placeholder="password">
                </div>
                <input class="botton" type="Submit" value="Submit">
            </div>
        </form>
    </div>
<? layoutEnd(); ?>
