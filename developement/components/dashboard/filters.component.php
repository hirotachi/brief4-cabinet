<div class="filters">
    <form id="filter-search"><label class="filters_search">
            <span class="icon"><i class="fal fa-search"></i></span>
            <input type="text" id="search" placeholder="search" autofocus="<?= isset($_REQUEST["search"]) ?>"
                   value="<?= $_REQUEST["search"] ?? "" ?>"/>
        </label></form>
    <div class="filters_btn" onclick="openForm()">
        <span class="plus"><i class="fal fa-plus"></i></span>
        <span class="text">add patient</span>
    </div>
</div>

<script>
    const filterForm = document.querySelector("#filter-search");
    const filterFormInput = filterForm.querySelector("input");
    filterForm.addEventListener("submit", (e) => {
        e.preventDefault();

        const search = filterFormInput.value.trim();
        const url = new URL(window.location.href);
        const searchParam = "search";
        if (search === url.searchParams.get(searchParam)) return;
        if (!search) {
            url.searchParams.delete(searchParam)
        } else {
            url.searchParams.set(searchParam, search)
        }
        routeReplace(url.href);
    })
</script>
