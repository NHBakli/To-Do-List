// ↓ Variable ↓ 
let urlParams = new URLSearchParams(window.location.search);

let id = urlParams.get('id');

let titleElement = document.querySelector(".editable-title");

let taskElements = document.querySelectorAll(".editable-task");

let task = document.querySelectorAll(".task");


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
taskElements.forEach(function (taskElement) {
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


// ↓ Function ↓
function isTextSelected() {
    return window.getSelection().toString().length > 0;
}


