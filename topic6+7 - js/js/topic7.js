
{
    log("Start");

    // exercise1();
    // exercise2();
    // exercise3();
    exercise5();
}

function exercise5() {
    const mainTag = document.getElementById('main');
    const form = createFormElement("GET", "userSessionForm", "topic7R.html");

    // first name input
    let firstName = createTextInput("", "firstNameTextField", "fName", "First Name: ")[1];

    // second name input
    let secondName = createTextInput("", "secondNameTextField", "sName", "Surname: ")[1];

    // button
    let submit = createButtonType("submit", "submitBlue", "Save information");
    submit.addEventListener('click', function (e) {
        // e.preventDefault();
        // log($_POST[fName])

        localStorage.setItem(firstName.name, firstName.value)
        localStorage.setItem(secondName.name, secondName.value)
        
        



        // save to local storage
    });

    // format elements

    form.appendChild(firstName);
    appendBreakLine(form);
    form.appendChild(secondName);
    appendBreakLine(form);
    appendBreakLine(form);

    form.appendChild(submit);


    mainTag.appendChild(form);
}



function exercise3() {
    // image sources array
    let images = ["aktor.png", "WALLE.jpg"];
    let imagePreffix = "images/";
    let imageIndex = 0, length = images.length;

    const mainTag = document.getElementById('main');
    const form = createElement(
        'form',
        ""
    );
    form.id = "form";

    // create buttons
    let previous = createButton("prevB", "prev");
    let next = createButton("nextB", "next");

    // form and button styling
    // form.style.paddingLeft="30REM";
    // form.style.paddingRight="30REM";
    previous.style.backgroundColor = "lightgreen";
    next.style.backgroundColor = "lightgreen";

    // image
    let image = createElement("img", "");
    image.src = imagePreffix + images[imageIndex];
    image.alt = images[imageIndex];

    previous.addEventListener('click', function () {
        log("previous");

        if (imageIndex != 0) {
            imageIndex--
            image.src = imagePreffix + images[imageIndex];
            image.alt = images[imageIndex];

            next.style.backgroundColor = "lightgreen";
        } else {
            previous.style.backgroundColor = "gray";
        }

    });
    next.addEventListener('click', function () {
        log("next");

        if (imageIndex < length - 1) {
            imageIndex++;
            image.src = imagePreffix + images[imageIndex];
            image.alt = images[imageIndex];

            previous.style.backgroundColor = "lightgreen";
        } else {
            next.style.backgroundColor = "gray";
        }
    });

    // append children
    form.appendChild(image);
    form.appendChild(previous);
    form.appendChild(next);
    mainTag.appendChild(form);
}

function createButton(id, text) {
    return createButtonType("button", id, text);
}

function createButtonType(type, id, text) {
    const button = createElement("button", "");
    button.setAttribute("type", type);
    button.id = id;
    button.appendChild(document.createTextNode(text));
    return button;
}

function exercise2() {
    createFormE2();

    const submitButton = document.getElementById('submit');
    submitButton.addEventListener('click', checkForm);

}

function createFormE2() {
    // using the DOM model, create a form
    const mainTag = document.getElementById('main');
    const form = createElement(
        'form',
        ""
    );
    form.id = "form";


    // form.setAttribute("action", "");
    form.setAttribute("action", "https://drusmannaeem.co.uk/process.php");
    form.setAttribute("method", "post");
    log(form)

    // create an input (text)
    let question1 = createTextInput("What is your name? ", "q1", "username", "empty");
    let question2 = createTextInput("What is your name? ", "q2", "username2", "");


    // create an input (button)
    const button = createElement("button", "SUBMIT");
    button.setAttribute("type", "submit");
    button.id = "submit";

    log(form)

    // add all the tags to the document

    question1.forEach(
        (element) => {
            form.appendChild(element);
        }
    );

    appendBreakLine(form);

    question2.forEach(
        (element) => {
            form.appendChild(element);
        }
    );

    appendBreakLine(form);
    form.appendChild(button);
    appendBreakLine(form);


    mainTag.appendChild(form);
}

function checkForm(e) {
    let id1 = 'q1', id2 = 'q2';

    let v1 = document.getElementById(id1);
    let v2 = document.getElementById(id2);
    let v1T = document.getElementById(id1).value;
    let v2T = document.getElementById(id2).value;

    if (v1T === "" || v2T === "" || v1T != v2T) {
        e.preventDefault();
        log("empty")

        if (v1T == "") {
            // highlight title being empty
            v1.style.backgroundColor = 'black';
            v1.style.color = 'white';
        }

        if (v2T == "") {
            // highlight textArea being empty
            v2.style.backgroundColor = 'black';
            v2.style.color = 'white';
        }

    }

    log("form checked");
}

function createFormElement(method, id, action) {
    let form = createElement("form", "");
    form.id = id;
    form.method = method;
    form.action = action;

    return form;
}

function createElement(tag, textContent) {
    const a = document.createElement(tag);
    a.appendChild(document.createTextNode(textContent));
    return a;
}

function createTextInput(questionText, id, name, placeholderText) {
    let label = createElement(
        'label',
        questionText
    );
    label.setAttribute("for", id);

    let question = createElement(
        'input',
        ""
    );
    question.setAttribute("type", "text");
    question.id = id;
    question.name = name;
    question.setAttribute("placeholder", placeholderText)

    log(question.id);

    // question.value = "TESTING"

    return new Array(label, question);
}

function appendBreakLine(element) {
    element.appendChild(document.createElement("br"));
}


function exercise1() {
    document.write("<h1>Names</h1>");
    arr = ["James", "Robert", "John", "Michael", "David",
        "Mary", "Patricia", "Jennifer", "Linda", "Elizabeth"];

    arr = arr.sort();
    log("Initial");
    log(arr);
    log(arr.length);
    let length = arr.length;
    let namesToAdd = 5, counter = 0;

    // add names

    while (counter < namesToAdd) {
        // ask new name
        let newName = window.prompt("Please enter a new name. ");
        let added = false;

        // loop through array and compare strings
        for (let i = 0; i < length && !added; i++) {
            if (newName.localeCompare(arr[i]) === -1) {
                arr.splice(i, 0, newName);
                added = true;
            }
        }

        // log array
        log(arr);
        counter++;
    }
}


function log(input) {
    console.log(input);
}