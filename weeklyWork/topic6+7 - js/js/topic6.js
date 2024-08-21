{

    console.log("Start")
    // sumTo1000();
    // maxOfFive();
    // legalFirstName();
    // getAvgAndMedian([3, 4, 6]);
    createMultiplicationTable(15);

}

function sumTo1000() {
    let sum = 0

    for (i = 1; i < 1001; i++) {
        // document.writeln(i)
        sum += i
    }

    window.alert(sum)
}


function maxOfFive() {
    let v = []
    let max = 0

    for (let i = 1; i <= 5; i++) {
        v[i - 1] = Number.parseInt(window.prompt("Enter Number " + i))
        max = Math.max(max, v[i - 1])
    }

    window.alert("The largest number is: " + max);
}

function legalFirstName() {
    let fName = window.prompt("What is your first name? ");
    if (fName.length > 14) {
        window.alert("Illegal name");
    } else {
        window.alert("Legal name");
    }
}

function getAvgAndMedian(array) {
    let avg = 0, total = 0, medianIndex = 0, len = array.length;
    // loop through array and sort, while doing this, get the sum
    for (i = 0; i < len; i++) {
        for (j = i; j < len - 1; j++) {
            if (array[j] > array[j + 1]) {
                //swap
                let temp = array[j];
                array[j] = array[j + 1]
                array[j + 1] = temp
            }
        }
        // console.log(array[i]);
        total += array[i];

    }

    total += 0;


    avg = total / len;
    console.log(avg);

    if (len % 2 == 1) {
        len--;
    }
    medianIndex = len / 2;
    console.log(array[medianIndex])
}

function createMultiplicationTable(size) {
    let len = size + 0;

    document.write("<table>");


    document.write("<thead><caption>Multiplication Table</caption></thead>");
    for (i = 1; i <= len; i++) {

        if (i === 1) {
            document.write("<tr>");
            document.write("<th>X</th>");
            for (k = 1; k <= len; k++) {
                document.write("<th>" + k + "</th>");
            }
            document.write("</tr>");
        }
        document.write("<tr>");
        document.write("<th>"+i+"</th>");

        for (j = 1; j <= len; j++) {


            // document.write("<td>" + i + "</td>");
            // document.write("<td>" + j + "</td>");
            document.write("<td>" + i * j + "</td>");

        }
        document.writeln("</tr>");
    }

    document.write("<tfoot><tr><td colspan=" + len+1 + ">Javascript</td></tr></tfoot>");

    document.write("<table>");


}


// // objects
// let person = {
//     name: "All",
//     age: 0,
// };

// class Person {
//     constructor(name, age) {
//         this.name = name
//         this.age = age
//     }
// };

// // console.log("Hello World");
// // // document.write(log);
// // // document.write("<p>Testing <br> </p>");

// // var a = window.prompt("AS");

// // window.alert("ALLERT");
// // window.confirm("test");

// // document.write(a);

// // let b = 'c'
// // const d = "a"

// // //if-else statements, for loops, and while loops are identical in structure
// // // else if?

// // //scope

// // // var - function scope
// // // let - block scope - a pair of { } brackets
// // // const - constant, block scope
// // ///   best practice? minimise scope when possible
// // ///   use const when you can, if you need to change it, use let
// // // in loops,


// // given an array
// let fruits = new Array("A", "B");

// fruits.forEach(function (element) {
//     console.log(element);
// });