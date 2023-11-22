// // ↓ Varibale ↓
// let titleElement = document.querySelector(".editable-title");

// // ↓ Event ↓
// titleElement.addEventListener("click", function() {
//     if (!isTextSelected()) {
//         let currentTitle = titleElement.innerText.trim();
//         let inputElement = document.createElement("input");
//         inputElement.type = "text";
//         inputElement.value = currentTitle;
//         inputElement.classList.add("edit-title-input");
//         titleElement.innerHTML = "";
//         titleElement.appendChild(inputElement);

//         inputElement.addEventListener("blur", function() {
//             let newTitle = inputElement.value.trim();
//             titleElement.innerText = newTitle;
//         });
//         inputElement.focus();
//     }
// });

// // ↓ Function ↓
// function isTextSelected() {
//     return window.getSelection().toString().length > 0;
// }

let urlParams = new URLSearchParams(window.location.search);
let id = urlParams.get('id');

let titleElement = document.querySelector(".editable-title");

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

function isTextSelected() {
    return window.getSelection().toString().length > 0;
}

