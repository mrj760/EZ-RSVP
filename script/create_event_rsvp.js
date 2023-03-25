// document.querySelector() is used to select an element from the document using its ID
let QuestionText = document.querySelector('#previousQuestions');
var ctx = QuestionText.getContext("2d");
ctx.font = "30px Roboto";
ctx.fillStyle = "#08e5ff";


let userText = document.querySelector('#questionBox');
let createButton = document.querySelector('#createFormButton');
//let output = document.querySelector('#output');
let cancelButton = document.querySelector('#cancelFormButton');



// This event listener is stimulated whenever the user press the "Enter" button
// refactor to save . . . .
userText.addEventListener('keyup', function (e) {
    // Key Code Value of "Enter" Button is 13
    if (e.keyCode === 13) {
        if (userText.value === c) {
            output.classList.add("correctCaptcha");
            output.innerHTML = "Correct!";
        } else {
            output.classList.add("incorrectCaptcha");
            output.innerHTML = "Incorrect, please try again";
        }
    }
});

// This event listener is stimulated whenever the user clicks the "Create" button
// The created form is saved . . .
createFormButton.addEventListener('click', function () {

    //form is saved
    //user redirected back to dashboard

});

//works
// This event listener is stimulated whenever the user press the "cancel" button
cancelFormButton.addEventListener('click', function () {

    //redirect back to event creation page
    location.href = "../html/create_event.html";

});