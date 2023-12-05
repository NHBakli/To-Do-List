// ↓ Variable ↓ 
let urlParams = new URLSearchParams(window.location.search);

let id = urlParams.get('id');

let titleElement = document.querySelector(".editable-title");

let taskElements = document.querySelectorAll(".editable-task");

let task = document.querySelectorAll(".task");

let checkbox = document.querySelectorAll(".checkbox");


//  ↓ Title ↓
titleElement.addEventListener("click", function() {
    if (!isTextSelected()) {
        let currentTitle = titleElement.innerText.trim();
        let inputElement = document.createElement("input");
        inputElement.type = "text";
        inputElement.value = currentTitle;
        inputElement.classList.add("edit-title-input");
        titleElement.innerHTML = "";
        titleElement.appendChild(inputElement);

        inputElement.addEventListener("blur", function() {

            let newTitle = inputElement.value.trim();

            let xhr = new XMLHttpRequest();
            xhr.open("POST", `index?page=list&id=${id}&action=changetitle`, true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            
            xhr.send(`id=${id}&newTitle=${encodeURIComponent(newTitle)}`);

            titleElement.innerText = newTitle;
        });

        inputElement.addEventListener("keyup", function(event) {
            if (event.key === "Enter") {
                inputElement.blur();
            }
        });

        inputElement.focus();
    }
});

// ↓ Task ↓
taskElements.forEach((taskElement) => {
    taskElement.addEventListener("click", function () {
        if (!isTextSelected()) {
            let currentTask = taskElement.innerText.trim();
            let inputElement = document.createElement("input");
            inputElement.type = "text";
            inputElement.value = currentTask;
            inputElement.classList.add("edit-task-input");
            taskElement.innerHTML = "";
            taskElement.appendChild(inputElement);

            let taskId = taskElement.id.replace("editableTask", "");

            inputElement.addEventListener("blur", function () {
                let newTask = inputElement.value.trim();

                let xhr = new XMLHttpRequest();
                xhr.open("POST", `index?page=list&id=${id}&id_task=${taskId}&action=edittask`, true);
                xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                xhr.send(`id_task=${taskId}&newTask=${encodeURIComponent(newTask)}`);

                taskElement.innerText = newTask;
            });

            inputElement.addEventListener("keyup", function (event) {
                if (event.key === "Enter") {
                    inputElement.blur();
                }
            });

            inputElement.focus();
        }
    });
});


// ↓ Checkbox ↓
document.addEventListener('DOMContentLoaded', function () {
    checkbox.forEach((checkbox) => {
        let taskId = checkbox.id.replace("editableCheckbox", "");
        let description = document.getElementById(`editableTask${taskId}`);

        // Vérifiez si la case à cocher est cochée au chargement de la page
        if (checkbox.checked) {
            description.style.textDecoration = 'line-through';
        }

        // Ajoutez un écouteur d'événements pour gérer les changements de la case à cocher
        checkbox.addEventListener('change', function () {
            if (checkbox.checked) {
                description.style.textDecoration = 'line-through';
                updateCompleted(taskId);
            } else {
                description.style.textDecoration = 'none'; // Retirez le style line-through
                updateUncompleted(taskId);
            }
        });
    });
});

// ↓ Function ↓
function updateCompleted(taskId) {
    
    const completed = "1";

    let xhr = new XMLHttpRequest();

    xhr.open("POST", `index?page=list&id=${id}&id_task=${taskId}&action=updatecompleted`, true);

    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

    xhr.send(`id_task=${taskId}&completed=${completed}`);
}

function updateUncompleted(taskId) {

    const completed = "0";

    let xhr = new XMLHttpRequest();

    xhr.open("POST", `index?page=list&id=${id}&id_task=${taskId}&action=updatecompleted`, true);

    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

    xhr.send(`id_task=${taskId}&completed=${completed}`);
}

function isTextSelected() {
    return window.getSelection().toString().length > 0;
}
