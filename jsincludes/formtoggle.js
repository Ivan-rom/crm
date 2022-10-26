let buttonsToggle = document.querySelectorAll(".btn-form-toggle");

let addToggleBtns = document.querySelectorAll(".add-toggle");


for( let buttonToggle of buttonsToggle) {
    let btnText = buttonToggle.textContent;
    buttonToggle.onclick = function() {
        let form = buttonToggle.parentElement.querySelector(".form");
        if (form.classList.contains("hidden")) {
            buttonToggle.textContent = "Отменить";
        } else {
            buttonToggle.textContent = btnText;
        }
        form.classList.toggle("hidden");
    }
};


for( let addToggleBtn of addToggleBtns) {
    addToggleBtn.onclick = function() {
        let form = addToggleBtn.parentElement.querySelector(".form-bg");
        let cancel = form.querySelector(".close-form");

        form.classList.remove("hidden");
        cancel.onclick = function() {
            form.classList.add("hidden");
        }
    }
};