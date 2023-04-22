let questions = [];

class Question {

    constructor() {
        

        this.div = document.createElement("div");
        this.div.classList.add("questionDiv");
        // div.id set via `set number()`

        this.leftDiv = document.createElement('div');
        this.leftDiv.classList.add("left");
        this.rightDiv = document.createElement('div');
        this.rightDiv.classList.add("right");

        const me = this; // important for event listeners

        this.label = document.createElement("label");
        // label set via `set number()`

        this.deleteButton = document.createElement("i");
        this.deleteButton.classList.add("fa-solid");
        this.deleteButton.classList.add("fa-xmark");
        this.deleteButton.addEventListener("click", function() {
            me.div.remove();
            questions.splice(me.number, 1);
            fillQuestions();
        });
        this.rightDiv.appendChild(this.deleteButton);


        this.text = document.createElement('input');
        this.text.type = "text";

        this.select = document.createElement("select");

        this.select.addEventListener("change", function () {
            me.type = me.select.options[me.select.selectedIndex].value;
        });

        this.createOption('text', 'Text');
        this.createOption('multichoice', 'Multiple Choice');
        this.createOption('checkbox', 'Check Box');
        this.type = this.select.options[this.select.selectedIndex].value;


        this.leftDiv.appendChild(this.label);
        this.leftDiv.appendChild(document.createElement('br'));
        this.leftDiv.appendChild(this.text);

        this.rightDiv.appendChild(this.deleteButton);
        this.rightDiv.appendChild(document.createElement('br'));
        this.rightDiv.appendChild(this.select);

        this.div.appendChild(document.createElement('br'));
        this.div.appendChild(this.leftDiv);
        this.div.appendChild(this.rightDiv);
        this.div.appendChild(document.createElement('br'));

        this.options = [];
    }

    createOption(value, text) {
        let option = document.createElement('option');
        option.value = value;
        option.innerHTML = text;
        this.select.appendChild(option);
    }

    set number(num) {
        this.div.id = "question" + num;
        this.label.innerHTML = "Custom Question #" + (num + 1);
    }

    get number() {
        return this.div.id.substring(8);
    }
}

let customQuestionsDiv;
let newQuestionButton;
let saveButton;
let backButton;

window.addEventListener("load", function () {
    customQuestionsDiv = document.getElementById("customQuestionsDiv");
    newQuestionButton = document.getElementById("newQuestionButton");
    saveButton = document.getElementById("saveButton");
    backButton = document.getElementById("backButton");

    newQuestionButton.addEventListener("click", function () {
        let question = new Question(questions.length);
        questions.push(question);
        fillQuestions();
    });
});

function fillQuestions() {
    for (let i = 0; i < questions.length; i++) {
        questions[i].number = i;
        customQuestionsDiv.appendChild(questions[i].div);
    }
}