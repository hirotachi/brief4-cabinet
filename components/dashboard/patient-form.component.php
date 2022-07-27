<script>


    function openForm(initialState) {
        const patientForm = document.createElement("form");


        patientForm.classList.add("form")
        const fields = [
            {type: "text", label: "first name", name: "firstName", required: true},
            {type: "text", label: "last name", name: "lastName", required: true},
            {type: "email", label: "email address", name: "email"},
            {type: "tel", label: "phone number", name: "phoneNumber"},
            {type: "date", label: "birth date", name: "birthdate", required: true},
            {type: "text", label: "sickness", name: "sickness"},
        ];
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


        const inputs = fields.map(data => {
            const {type, label, name, required} = data;
            const labelEl = document.createElement("label");
            labelEl.innerHTML = `<span>${label}</span>`

            const el = document.createElement("input")
            el.type = type
            el.name = name;
            el.required = required

            if (type === "date") {
                const date = new Date(state[name]);
                el.defaultValue = `${date.getFullYear()}-${(date.getMonth() + 1).toString().padStart(2, "0")}-${date.getDate().toString().padStart(2, "0")}`
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

        function handleSubmit(e) {
            e.preventDefault();
            const isUpdate = !!initialState && !!state.id;
            console.log(isUpdate, state)
            const id = state.id;
            if (isUpdate) {
                delete state.id;
            }
            fetch(`/api/patients${isUpdate ? `/${id}` : ""}`, {
                method: isUpdate ? "PATCH" : "POST",
                body: JSON.stringify(state)
            }).then(() => {
                //    todo implement redirection and error handling
                routePush("/dashboard.php");
            });
        }

        patientForm.addEventListener("submit", handleSubmit)
    }

</script>