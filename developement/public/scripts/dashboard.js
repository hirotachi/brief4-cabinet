console.log("hello from dashboard")
const filterSearch = document.querySelector(".filters_search");
const filterSearchInput = filterSearch.querySelector("input");

function handleFocus() {
    filterSearch.classList.toggle("filters_search--active");
}

filterSearchInput.addEventListener("focus", handleFocus)
filterSearchInput.addEventListener("blur", handleFocus)