<?php
function navLinks($parentClass = "")
{
    $class = $parentClass != "" ? "$parentClass"."__links" : "links";
    return "<ul class='$class'>
<li class='link'><a href='/'>home</a></li>
<li class='link'><a href='/#about'>about</a></li>
<li class='link'><a href='/#services'>services</a></li>
<li class='link'><a href='dashboard.php'>dashboard</a></li>
</ul>";
}

function nav($classes = [])
{
    $navLinksMobile = navLinks("nav__mobile");
    $navLinksDesktop = navLinks();
    $classnames = implode(" ", $classes);
    echo "<header class='nav $classnames'>
<a href='index.php' class='nav__logo'>
<img src='assets/logo-desktop.svg' alt='logo'/>
<img src='assets/logo-mobile.svg' alt='logo'/>
</a>
$navLinksDesktop
<a href='contact.php' class='nav__contact'>contact us</a>
<span class='nav__open'><i class='fas fa-bars'></i></span>
</div>
<div class='nav__mobile'>
<div class='header'>
<a href='/'><img src='assets/logo-mobile.svg' alt='logo'/></a>
<span class='nav__close'><i class='far fa-times'></i></span>
</div>
$navLinksMobile
<a href='/contact.php' class='nav__mobile_contact'>contact us</a>
</div>
</header>";
}


