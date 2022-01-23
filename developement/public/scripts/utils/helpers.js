/**
 * execute callback when click event is clicked outside it
 * @param el
 * @param cb
 */
function onClickOutside(el, cb) {
    document.addEventListener("click", (e) => {
        const target = e.target;
        // check if clicking inside the element
        if (!el.contains(target)) cb(target);
    })
}

function push(route) {
    window.location.href = route
}

function routeReplace(url) {
    window.location.replace(url)
}