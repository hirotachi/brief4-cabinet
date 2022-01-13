<?php
function navLinks($parentClass = "")
{
    $class = $parentClass != "" ? "$parentClass"."__links" : "links";
    return "<ul class='$class'>
<li><a href='#'>home</a></li>
<li><a href='#'>about</a></li>
<li><a href='#'>services</a></li>
<li><a href='#'>dashboard</a></li>
</ul>";
}

function nav()
{
    $navLinksMobile = navLinks("nav__mobile");
    $navLinksDesktop = navLinks();

    echo "<header class='nav'>
<a href='index.php' class='nav__logo'>
<img src='assets/logo-desktop.svg' alt='logo'/>
<img src='assets/logo-mobile.svg' alt='logo'/>
</a>
$navLinksDesktop
<a href='contact.php' class='nav__contact'>contact us</a>
<span class='nav__open'><i class='fas fa-bars'></i></span>
</div>
<div class='nav__mobile'>
$navLinksMobile
</div>
</header>";
}