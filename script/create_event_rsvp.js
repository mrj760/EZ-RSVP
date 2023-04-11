
let questionCounter = 2;
let userText = document.querySelector('#questionBox');
let createButton = document.querySelector('#createFormButton');
//let output = document.querySelector('#output');
let cancelButton = document.querySelector('#cancelFormButton');
let saveQuestionButton = document.querySelector('#saveQuestionButton');
let questionType = document.querySelector('#questionType');
var customOptions = [];
var addOptionButtons = [];
var removeOptionButtons = [];

hideAllCustomOptions();

//////////////////////////////////////////////////////////////////////////////////
//function to hide all the custom options elements
///////////////////////////////////////////////////////////////////////////////////
function hideAllCustomOptions(){
    for(let i = 0; i < 6; i++)
    {
        console.log('addOptionButton' + (i + 1));
        //console.log(document.getElementById('option ' + (i + 1)));
        customOptions[i] = document.getElementById('option ' + (i + 1)); //grabs and stores the custom option element in the array
        addOptionButtons[i] = document.getElementById('addOptionButton' + (i + 1));
        removeOptionButtons[i] = document.getElementById('removeOptionButton' + (i + 1));
        console.log(addOptionButtons[i]);
        customOptions[i].style.display = "none"; //hides the custom option element in the document
        addOptionButtons[i].style.display = "none";
        removeOptionButtons[i].style.display = "none";
    }
}

///////////////////////////////////////////////////////////////////////////////////
//funciton to show all the custom options elements
///////////////////////////////////////////////////////////////////////////////////
function showAllCustomOptions(){
    for(let i = 0; i < 6; i++)
    {
        //customOptions[i] = document.getElementById('option ' + i); //grabs and stores the custom option element in the array
        customOptions[i].style.display = "block"; //shows the custom option element in the document
        addOptionButtons[i].style.display = "block";
        removeOptionButtons[i].style.display = "block";
    }
}

///////////////////////////////////////////////////////////////////////////////////
//Function to show all the custom options elements when user selects checkbox or multiple choice
///////////////////////////////////////////////////////////////////////////////////
questionType.addEventListener('change', function(){

    //hideAllCustomOptions();
    console.log("a change has been made in the drop down menu"); //when in doubt, print it out

    //get the input in the question box, question type selected from the drop down menu
    let input = document.getElementById("questionBox").value;
    let choice =  document.getElementById("questionType").value;

    //the number of custom options specified by the user starts at 0
    let customOptionCounter = 0;
    let customOptionID = "customOption"; //this is part of the id attribute of the custom option, will change slightly with every new option created
    let optionInputs = []; //array of all the input elements in the custom options

    //if the user has edited the questionboxe's value and the choices multichoice or checkboxes is selected
    if(input != "Enter your question" && (choice == "multiChoice" || choice == "checkBoxes")){

        showAllCustomOptions(); //shows all the custom options



    }


});


/*///////////////////////////////////////////////////////////////////////////////////
//when the user changes the option in the drop down menu, activate this function
questionType.addEventListener('change', function(){

console.log("a change has been made in the drop down menu"); //when in doubt, print it out

//get the input in the question box, question type selected from the drop down menu
let input = document.getElementById("questionBox").value;
let choice =  document.getElementById("questionType").value;

//the number of custom options specified by the user starts at 0
let customOptionCounter = 0;
let customOptionID = "customOption"; //this is part of the id attribute of the custom option, will change slightly with every new option created
let optionInputs = []; //array of all the input elements in the custom options

//if the user has edited the questionboxe's value and the choices multichoice or checkboxes is selected
    if(input != "Enter your question" && (choice == "multiChoice" || choice == "checkBoxes")){
        //use demo container shows the demo options
        console.log("multi choice or check boxes should be specified");
        customOptionCounter++;//a new option counter is being generated, increment counter by 1
        customOptionID = customOptionID + customOptionCounter; //generate a unique id for the custom option

        //html = "<p> " + input + ": </p>";
        //document.getElementById("questionDemo").innerHTML += html;

        //this adds a check box (disabled) and a text field to specify the option
        html = "<input type='checkbox' id='custom' name='custom' disabled>\n"
            + "  <input type='text' id='" + customOptionID + "' name='custom' value = '' placeholder='option " + customOptionCounter +
            "'>\n" + "<button id='addOptionButton' type='submit'>Add</button> \n" + //adds new option button
            "<button id='removeOptionButton' type='submit'>Remove</button>\n"; //remove option button
        document.getElementById("questionDemo").innerHTML += html; //insert the html into the document

        //unfortunately, when a new option is generated, previous options are overwritten so we store them in an array
        
        //if(document.getElementById(customOptionID).value != ""){ //so we guard it until the option is added
        //problematic, it doesnt wait for user input. . . 
        console.log(customOptionID + " has been added");
        optionInputs.push(document.getElementById(customOptionID).value); //push option text to the array
        let nextOption = document.getElementById("addOptionButton"); //get the newly created button

        //add a while statement to allow user to make options as long as they are not empty, have not hit save, clear, or . . .
        //while((choice == "multiChoice" || choice == "checkBoxes") && customOptionCounter < 6)
        //{
        nextOption.addEventListener('click', function(){ //when the button is clicked, add a new option text box
            console.log("runs");
            console.log(document.getElementById(customOptionID).value);
            //optionInputs.push(document.getElementById(customOptionID).value); //push option text to the array
            optionInputs[customOptionCounter-1] = document.getElementById(customOptionID).value;
            console.log(optionInputs[customOptionCounter-1]);


            customOptionCounter++;// a new option counter is being generated, increment counter by 1
            customOptionID = "customOption";
            customOptionID = customOptionID + customOptionCounter; //generate a unique id for the new custom option
            
            html = "<br></br><input type='checkbox' id='custom' name='custom' disabled>\n"
            + "  <input type='text' id='" + customOptionID + "' name='custom' value='' placeholder='option " + customOptionCounter +
            "'>\n" + "<button id='addOptionButton' type='submit'>Add</button> \n" + //adds new option button
            "<button id='removeOptionButton' type='submit'>Remove</button>\n"; //remove option button//generate the html for the new custom option and place it in the html element
            document.getElementById("questionDemo").innerHTML += html;

            customOptionID = "customOption"; //reset the custom option id
            //loop puts all the option texts in the array back into the html elements
            for(let i = 0; i < optionInputs.length; i++)
            {
                //console.log(optionInputs[i]);
                customOptionID = customOptionID + (i + 1); //generate a unique id for the custom option corresponding to each index
                console.log(customOptionID + " has been given text: " + optionInputs[i]);
                document.getElementById(customOptionID).value = optionInputs[i]; //place the text in the array into the html element
                customOptionID = "customOption"; //reset the custom option id
            }
        });
    //}
    } 

    
});

doesNotExist.addEventListener('click', function(){
    //do stuff
});
*/


///////////////////////////////////////////////////////////////////////////////////////////////
saveQuestionButton.addEventListener('click', function(){

    let input = document.getElementById("questionBox").value;
    let choice =  document.getElementById("questionType").value;

    console.log(input);
    console.log(choice);


    if(input != "Enter your question" && choice != "N/A"){
        questionCounter++;

        //if something has been entered, save it to the question container
        console.log("A question has been submitted.");

        html = "<p> Question " + questionCounter + "--" + input + ": </p>";
        document.getElementById("questionContainer").innerHTML += html;
        switch(choice)
        {
            case 'multiChoice':
                console.log("multi choice");//notthing yet
                html = "<input type='text' id='custom' name='custom' disabled><br><br>\n"
                document.getElementById("questionContainer").innerHTML += html;
                document.getElementById("questionDemo").innerHTML = "";
                break;
            case 'oneLine':
                html = "<input type='text' id='custom' name='custom' disabled><br><br>\n"
                document.getElementById("questionContainer").innerHTML += html;
                break;
            case 'checkBoxes':
                console.log("check boxes");//nothing yet
                html = "<input type='checkbox' id='custom' name='custom' disabled><br><br>\n" + 
                "<label for='option1'> option1 </label><br>\n"
                document.getElementById("questionContainer").innerHTML += html;
                document.getElementById("questionDemo").innerHTML = "";
                break;
            case 'textBox':
                html = "<textarea id='custom' name='custom' rows='4' cols='50' disabled></textarea><br><br>\n"
                document.getElementById("questionContainer").innerHTML += html;
                break;
            case 'Y/N':
                html = "<input type='radio' id='yes' name='yes' value='yes' disabled>\n" +
                  "<label for='yes'>yes</label><br> \n" +
                  "<input type='radio' id='no' name='no' value='no' disabled>\n" +
                  "<label for='no'>no</label><br>\n";
                document.getElementById("questionContainer").innerHTML += html;
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