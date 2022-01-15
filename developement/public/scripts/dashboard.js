console.log("hello from dashboard")
const filterSearch = document.querySelector(".filters_search");
const filterSearchInput = filterSearch.querySelector("input");

function handleFocus() {
    filterSearch.classList.toggle("filters_search--active");
}

filterSearchInput.addEventListener("focus", handleFocus)
filterSearchInput.addEventListener("blur", handleFocus)


const patientMoreBtns = document.querySelectorAll(".patient .more")
const patientMoreOpenClass = "more_options--open";
patientMoreBtns.forEach((btn, index) => {
    const optionsEl = btn.querySelector(".more_options");

    onClickOutside(btn, () => {
        const isOpen = optionsEl.classList.contains(patientMoreOpenClass);
        if (isOpen) optionsEl.classList.remove(patientMoreOpenClass);
    })
    btn.addEventListener("click", (e) => {
        optionsEl.classList.toggle(patientMoreOpenClass);
    })
})



