
let questionCounter = 2;
let userText = document.querySelector('#questionBox');
let createButton = document.querySelector('#createFormButton');
let cancelButton = document.querySelector('#cancelFormButton');
let saveQuestionButton = document.querySelector('#saveQuestionButton');
let questionType = document.querySelector('#questionType');
var customOptions = [];
var addOptionButtons = [];
var removeOptionButtons = [];
var optionCheckboxes = [];
var optionRadioButtons = [];
var optionSpacers = [];

//strategy:
//1. adjust to new style
//2.options are shown below each question
//3. each question can be deleted or modified even after initial creation
//4. new question is created above when new question button is clicked
//5.how to dynamically create new questions (so unlimited number of questions)
//6.how to dynamically create new custom options for each custom question (so unlimited number of custom options)


//strategy 1: show/hide questions and options already present in html (limited number of questions and custom options)
//strategy 2: dynamically create new questions and custom options
//at the end of either of these methods, save all the question objects to questions array in form object


hideAllCustomOptions(); //first thing to do is to hide all custom options

class CustomForm{
    Questions;
}

class Question{
    CustomOptions =  CustomOption[];
}

//declare a class called otions
class CustomOption{
    choice;//choice selection as 'multichoice' or 'checkboxes'
    hidden; //true or false value shows when the option is hidden
    customOption;//all custom option elements
    addOptionButton;
    removeOptionButton;
    optionCheckbox;
    optionRadioButton;
    optionSpacer;

    constructor(choice, hidden, customOption, addOptionButton, removeOptionButton, optionCheckbox, optionRadioButton, optionSpacer)
    {
    }

    show(){

    }

    hide(){

    }

    clear(){

    }

}


//////////////////////////////////////////////////////////////////////////////////
//function to hide all the custom options elements
///////////////////////////////////////////////////////////////////////////////////
function hideAllCustomOptions(){
    for(let i = 0; i < 6; i++)
    {
        //console.log('addOptionButton' + (i + 1));
        //console.log(document.getElementById('option ' + (i + 1)));
        customOptions[i] = document.getElementById('option ' + (i + 1)); //grabs and stores the custom option element in the array
        addOptionButtons[i] = document.getElementById('addOptionButton' + (i + 1));
        removeOptionButtons[i] = document.getElementById('removeOptionButton' + (i + 1));
        optionCheckboxes[i] = document.getElementById('optionCheckbox' + (i + 1));
        optionRadioButtons[i] = document.getElementById('optionRadio' + (i + 1));
        optionSpacers[i] = document.getElementById('spacer' + (i + 1));
        //console.log(addOptionButtons[i]);
        customOptions[i].style.display = "none"; //hides the custom option element in the document
        addOptionButtons[i].style.display = "none";
        removeOptionButtons[i].style.display = "none";
        optionCheckboxes[i].style.display = "none";
        optionRadioButtons[i].style.display = "none";
        optionSpacers[i].style.display = "none";
    }

    //console.log(document.getElementById("questionDemo").innerHTML);
}

///////////////////////////////////////////////////////////////////////////////////
//funciton to show all the custom options elements
///////////////////////////////////////////////////////////////////////////////////
function showAllCustomOptions(choice){
    for(let i = 0; i < 6; i++)
    {
        customOptions[i].style.display = "inline"; //shows the custom option element in the document
        addOptionButtons[i].style.display = "inline";
        removeOptionButtons[i].style.display = "inline";
        optionSpacers[i].style.display = "inline";
        if(choice == 'multiChoice')
        {
            optionRadioButtons[i].style.display = "inline"; //radio buttons are shown
        }
        else //checkboxes are shown
        {
            optionCheckboxes[i].style.display = "inline";
        }
    }
}

///////////////////////////////////////////////////////////////////////////////////
//Function to show all the custom options elements when user selects checkbox or multiple choice
///////////////////////////////////////////////////////////////////////////////////
questionType.addEventListener('change', function(){

    hideAllCustomOptions();
    console.log("a change has been made in the drop down menu"); //when in doubt, print it out

    //get the input in the question box, question type selected from the drop down menu
    let input = document.getElementById("questionBox").value;
    let choice =  document.getElementById("questionType").value;

    //if the user has edited the questionboxe's value and the choices multichoice or checkboxes is selected
    if(input != "Enter your question" && (choice == "multiChoice" || choice == "checkBoxes")){

        showAllCustomOptions(choice); //shows all the custom options

    }
    else{
        hideAllCustomOptions(); //hides all the custom options
    }


});

///////////////////////////////////////////////////////////////////////////////////
//event listener for each delete option button
///////////////////////////////////////////////////////////////////////////////////
removeOptionButtons.forEach(function(elem, index) {
    elem.addEventListener("click", function() {
        //hide the corresponding custom option element and delete whatever might have been inputed
        elem.value = "";

        //call helper function to hide
        hideSingleCustomOption(index);
    });
});

///////////////////////////////////////////////////////////////////////////////////
//event listener for each add option button
///////////////////////////////////////////////////////////////////////////////////
addOptionButtons.forEach(function(elem, index) {
    elem.addEventListener("click", function() {
        let undisplayedCustomOptionCounter = -1;

        //find if there are any custom options not displayed
        for(var i = 0; i < 6; i++){
            if(customOptions[i].style.display == "none")
            {
                undisplayedCustomOptionCounter = i; //the index of the custom option in all custom options array
            
            } 
        }
  
        console.log("add option button clicked and custom option counter is " + undisplayedCustomOptionCounter);
        //display one of (or the only custom option not displayed)
        if(undisplayedCustomOptionCounter != -1){
            customOptions[undisplayedCustomOptionCounter].style.display = "inline"; //shows the custom option element in the document
            addOptionButtons[undisplayedCustomOptionCounter].style.display = "inline";
            removeOptionButtons[undisplayedCustomOptionCounter].style.display = "inline";
            optionSpacers[undisplayedCustomOptionCounter].style.display = "inline";
            if(document.getElementById("questionType").value == 'multiChoice')
            {
                optionRadioButtons[undisplayedCustomOptionCounter].style.display = "inline"; //radio buttons are shown
            }
            else //checkboxes are shown
            {
                optionCheckboxes[undisplayedCustomOptionCounter].style.display = "inline";
            }
        }

        //do nothing if there are no custom options not displayed
        return;
    });
});

///////////////////////////////////////////////////////////////////////////////////
//Hide single custom option
///////////////////////////////////////////////////////////////////////////////////
function hideSingleCustomOption(index){
    customOptions[index].value = ""; //delete whatever was inputed

    customOptions[index].style.display = "none"; //hides the custom option element in the document
    addOptionButtons[index].style.display = "none";
    removeOptionButtons[index].style.display = "none";
    optionCheckboxes[index].style.display = "none";
    optionRadioButtons[index].style.display = "none";
    optionSpacers[index].style.display = "none";

}

/*Things to do:
1. implement add button functionality
2. implement save functionality for multiple choice questions and checkboxes
3. make the submit button reroute to dashboard.
*/

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
                console.log("multi choice");//nothing yet
                html = "";
                for(var i = 0; i < 6; i++)
                {
                    if(customOptions[i].value != "")
                    {
                        html += "<input type='radio' id='optionRadio' name='custom' disabled>\n" + 
                        customOptions[i].value +
                        "<br>\n";
                        console.log("save question");
                    }
                    
                }
                document.getElementById("questionContainer").innerHTML += html;
                hideAllCustomOptions();
                break;
            case 'oneLine':
                html = "<input type='text' id='custom' name='custom' disabled><br><br>\n"
                document.getElementById("questionContainer").innerHTML += html;
                break;
            case 'checkBoxes':
                console.log("check boxes");//nothing yet
                html = "";
                for(var i = 0; i < 6; i++)
                {
                    if(customOptions[i].value != "")
                    {
                        html += "<input type='checkbox' id='optionRadio' name='custom' disabled>\n" + 
                        customOptions[i].value +
                        "<br>\n";
                        console.log("save question");
                    }
                    
                }
                document.getElementById("questionContainer").innerHTML += html;
                hideAllCustomOptions();
                break;
            case 'textBox':
                html = "<textarea id='custom' name='custom' rows='4' cols='50' disabled></textarea><br><br>\n"
                document.getElementById("questionContainer").innerHTML += html;
                break;
            case 'Y/N':
                html = "<input type='radio' id='yes' name='yes' value='yes' disabled>\n"
                + "<label for='yes'>yes</label><br> \n"
                + "<input type='radio' id='no' name='no' value='no' disabled>\n"
                + "<label for='no'>no</label><br>\n";
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