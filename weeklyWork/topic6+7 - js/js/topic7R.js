

{

    log("Start");

    const mainTag = document.getElementById('main');
    const form = createFormElement("POST", "userSessionForm", "topic7R.html");

    // name output
    let stringOutput = "Welcome " + localStorage.getItem("fName")+" "+localStorage.getItem("sName");

    let nameOutput = createElement("p", stringOutput);


    // button
    let submit = createButtonType("submit", "submitBlue", "Clear Information");
    submit.addEventListener('click', function (e) {

        // remove from to local storage

        if (localStorage.getItem("fName") != null)
            localStorage.removeItem("fName");
        if (localStorage.getItem("sName") != null)
            localStorage.removeItem("sName");




    });

    // format elements

    form.appendChild(nameOutput);
    appendBreakLine(form);
    appendBreakLine(form);

    form.appendChild(submit);


    mainTag.appendChild(form);
}



function createElement(tag, textContent) {
    const a = document.createElement(tag);
    a.appendChild(document.createTextNode(textContent));
    return a;
}


function appendBreakLine(element) {
    element.appendChild(document.createElement("br"));
}


function createButtonType(type, id, text) {
    const button = createElement("button", "");
    button.setAttribute("type", type);
    button.id = id;
    button.appendChild(document.createTextNode(text));
    return button;
}

function createFormElement(method, id, action) {
    let form = createElement("form", "");
    form.id = id;
    form.method = method;
    form.action = action;

    return form;
}

function log(input) {
    console.log(input);
}