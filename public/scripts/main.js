console.log("hello world!");


const navOpenBtn = document.querySelector(".nav__open");
const navMobile = document.querySelector(".nav__mobile");

const toggleMobileNav = () => {
    navMobile.classList.toggle("nav__mobile--open")
};
navOpenBtn.addEventListener("click", toggleMobileNav)
navMobile.addEventListener("click", toggleMobileNav)
