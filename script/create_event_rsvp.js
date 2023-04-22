class Question {

    constructor() {

        this.div = document.createElement("div");
        this.div.appendChild(document.createElement('br'));

        this.label = document.createElement("label");
        this.div.appendChild(this.label);

        this.div.appendChild(document.createElement('br'));

        this.text = document.createElement('input');
        this.text.type = "text";
        this.div.appendChild(this.text);

        this.select = document.createElement("select");

        this.createOption('text', 'Text');
        this.createOption('multichoice', 'Multiple Choice');
        this.createOption('checkbox', 'Check Box');

        this.type = this.select.options[this.select.selectedIndex].value;

        this.div.appendChild(this.select);
        this.div.appendChild(document.createElement('br'));
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

let questions = [];
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