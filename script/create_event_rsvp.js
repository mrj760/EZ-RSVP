// document.querySelector() is used to select an element from the document using its ID
//let QuestionText = document.querySelector('#previousQuestions');
//var ctx = QuestionText.getContext("2d");
//ctx.font = "30px Roboto";
//ctx.fillStyle = "#08e5ff";

let questionCounter = 2;
let userText = document.querySelector('#questionBox');
let createButton = document.querySelector('#createFormButton');
//let output = document.querySelector('#output');
let cancelButton = document.querySelector('#cancelFormButton');
let saveQuestionButton = document.querySelector('#saveQuestionButton');
let questionType = document.querySelector('#questionType');

//var canvas = document.getElementById("previousQuestions");
//var ctx = canvas.getContext("2d");
//ctx.canvas.width  = window.innerWidth / 1.5;
//ctx.canvas.height = window.innerHeight / 2;
//ctx.font = "30px Arial";
//ctx.fillText("After questions are saved they are added to this canvas", 10, 25);
//ctx.globalCompositeOperation = 'destination-over'
//ctx.fillStyle="white";
//ctx.fillRect(0,0,canvas.width,canvas.height);




questionType.addEventListener('change', function(){

console.log("a change has been made in the drop down menu");
let choice =  document.getElementById("questionType").value;

    if(choice == "Multiple Choice" || choice == "Check Boxes"){
        //use demo container to allow specifications
        console.log("multi choice or check boxes should be specified")
    }
});

saveQuestionButton.addEventListener('click', function(){

    let input = document.getElementById("questionBox").value;
    let choice =  document.getElementById("questionType").value;

    console.log(input);
    console.log(choice);


    if(input != "Enter your question" && choice != "N/A"){
        //if something has been entered, save it to the question container
        console.log("A question has been submitted.");

        html = "<p> Question " + questionCounter + "--" + input + ": </p>";
        document.getElementById("questionContainer").innerHTML += html;

        switch(choice)
        {
            case 'MultiChoice':
                //notthing yet
                break;
            case 'oneLine':
                html = "<input type='text' id='custom' name='custom' disabled><br><br>\n"
                document.getElementById("questionContainer").innerHTML += html;
                break;
            case 'CheckBoxes':
                //nothing yet
                break;
            case 'textBox':
                //stuff
                break;
            case 'Y/N':
                //stuff
                break;
            default:
                console.log("nonvalid behavior reached");
                break;
        }
    }
});

window.addEventListener("resize", function(){
    //var w = window.innerWidth / 3;
    //var h = window.innerHeight / 3;

    //ctx.canvas.width  = window.innerWidth / 3;
    //ctx.canvas.height = window.innerHeight / 3;
    //var txt = "Window size: width=" + w + ", height=" + h;
    //document.getElementById("demo").innerHTML = txt;
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