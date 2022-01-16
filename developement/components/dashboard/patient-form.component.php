<script>


    function openForm(initialState) {
        const patientForm = document.createElement("form");
        patientForm.classList.add("form")
        const state = initialState ?? {}

        const patientFormWrapper = document.createElement("div")
        patientFormWrapper.classList.add("patient_form")
        patientFormWrapper.addEventListener("click", () => {
            closeForm()
        })


        const patientFormContainer = document.createElement("div");
        patientFormContainer.classList.add("patient_form_container")
        patientFormContainer.innerHTML += `
        <h2>${initialState ? "update" : "create new"} patient<h2>
        `

        patientFormContainer.addEventListener("click", e => {
            e.stopPropagation()
        })

        function handleSubmit(e) {
            e.preventDefault();
            console.log(state)
        }

        patientForm.addEventListener("submit", handleSubmit)

        const inputs = [
            {type: "text", label: "first name", name: "firstName"},
            {type: "text", label: "last name", name: "lastName"},
            {type: "email", label: "email address", name: "email"},
            {type: "date", label: "birthdate", name: "date"},
            {type: "text", label: "sickness", name: "sickness"},
        ].map(data => {
            const {type, label, name} = data;
            const labelEl = document.createElement("label");
            labelEl.innerHTML = `<span>${label}</span>`

            const el = document.createElement("input")
            el.type = type
            el.name = name;
            if (type === "date") {
                const date = new Date(state[name]);
                el.defaultValue = `${date.getFullYear()}-${(date.getMonth() + 1).toString().padStart(2, "0")}-${date.getDate()}`
            } else {
                el.defaultValue = state[name] ?? "";
            }
            labelEl.appendChild(el);
            patientForm.appendChild(labelEl)
            return {...data, el};
        })
        patientForm.innerHTML += `<div class='form_footer'>
                                    <span class="cancel" > cancel</span>
                                    <button>${initialState ? "update" : "create"} patient</button>
                                  </div>`


        const dashboard = document.querySelector(".dashboard");
        patientFormContainer.appendChild(patientForm)
        const closeBtn = document.createElement("span");
        closeBtn.classList.add("patient_form_close")
        closeBtn.innerHTML = '<i class="far fa-times"></i>'

        function closeForm() {
            dashboard.removeChild(patientFormWrapper)
        }

        closeBtn.addEventListener("click", closeForm)
        patientForm.querySelector(".cancel").addEventListener("click", closeForm)
        patientFormContainer.appendChild(closeBtn)

        patientFormWrapper.appendChild(patientFormContainer)
        dashboard.appendChild(patientFormWrapper)


        const addListener = input => {
            const {type, name} = input;
            input.addEventListener(type === "text" ? "input" : "change", (e) => {
                state[name] = type === "date" ? e.target.valueAsDate.toLocaleDateString().split("/").map(v => v.padStart(2, "0")).join("/") : e.target.value;
            })
        };
        patientForm.querySelectorAll("input").forEach(addListener)
    }

</script>