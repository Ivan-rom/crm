let dopInfoBtns = document.querySelectorAll(".dop-info-btn");

for( let dopInfoBtn of dopInfoBtns) {
    let dopInfo = dopInfoBtn.parentElement.parentElement.parentElement.querySelector(".dop-info-hidden");
    dopInfo.style.maxHeight = "0";
    dopInfoBtn.onclick = function() {
        if(dopInfo.classList.contains("dop-info-hidden")){
            dopInfo.classList.remove("dop-info-hidden");
            dopInfo.style.maxHeight = "500px";
            dopInfoBtn.textContent = "Сернуть";
        }else{
            dopInfo.classList.add("dop-info-hidden");
            dopInfo.style.maxHeight = "0";
            dopInfoBtn.textContent = "Развернуть";
        }
    }
};