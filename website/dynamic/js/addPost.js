
// reset values of the form if title or content are empty
// highlight nodes that are empty

let clearButton = document.getElementById('clear');
let submitButton = document.getElementById('submit');

function confirmClear(e) {
    if (!window.confirm("Do you really want to clear all your work? ")) {
        e.preventDefault();
    }
}

function checkForm(e) {
    let title = document.getElementById('titleLabel');
    let text = document.getElementById('textLabel');
    let titleT = document.getElementById('blogTitle').value;
    let textT = document.getElementById('content').value;

    if (titleT == "" || textT == "") {
        e.preventDefault();
        log("empty")

        if (titleT == "") {
            // highlight title being empty
            title.style.backgroundColor = 'black';
            title.style.color = 'white';
        }

        if (textT == "") {
            // highlight textArea being empty
            text.style.backgroundColor = 'black';
            text.style.color = 'white';
        }

    }

    log("form checked");
}

function log(text) {
    console.log(text);
}

clearButton.addEventListener('click', confirmClear);
previewButton.addEventListener('click', checkForm);

