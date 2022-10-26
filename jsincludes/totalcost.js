let taskGroups = document.querySelectorAll('.task-group');
let totalCost = 0;

for (let taskGroup of taskGroups) {
    let groupCost = taskGroup.querySelector(".total-group-price");
    let taskCosts = taskGroup.querySelectorAll('.task-price');
    for (let taskCost of taskCosts) {
        let ts = Number(taskCost.textContent);
        totalCost = totalCost + ts;
    }
    groupCost.textContent = totalCost;
    totalCost = 0;
}