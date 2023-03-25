// document.querySelector() is used to select an element from the document using its ID
let captchaText = document.querySelector('#captcha');
var context = captchaText.getContext("2d");


context.font = "25pt Roboto";
context.fillStyle = "#ffffff";
context.textAlign = 'center';

let userText = document.querySelector('#captchaTextBox');
let submitButton = document.querySelector('#submitButton');
let output = document.querySelector('#output');
let refreshButton = document.querySelector('#refreshButton');


let alphaNums = [
    'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P',
    'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z',
    'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p',
    'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z',
    '0', '1', '2', '3', '4', '5', '6', '7', '8', '9',
    '!', '@', '#', '$', '%', '^', '&', '*', '(', ')', '-', '='];
let captcha = [];

refreshCaptcha();

//
userText.addEventListener('keyup', function (e) {
    if (e.keyCode === 13) { // Enter key
        outputResult(userText);
    }
});

//
submitButton.addEventListener('click', function () { outputResult(userText) });

//
refreshButton.addEventListener('click', refreshCaptcha);

//
function randomNumber(min, max) {
    return Math.floor(Math.random() * (max - min + 1) + min);
}

//

function refreshCaptcha() {
    userText.value = "";
    let refreshArr = [];
    let capcthaLength = randomNumber(5, 7);
    for (let j = 1; j <= capcthaLength; j++) {
        refreshArr.push(alphaNums[Math.floor(Math.random() * alphaNums.length)]);
    }
    context.clearRect(0, 0, captchaText.width, captchaText.height);
    captcha = refreshArr.join('');
    let x = captchaText.width / 2;
    let y = captchaText.height / 2;
    context.fillText(captcha, x, y);
    output.innerHTML = "<span>Waiting...</span>";
}

//
function outputResult(userText) {
    if (userText.value === captcha) {
        output.classList.add("correctCaptcha");
        output.innerHTML = "<span id=\"correct\">Correct!</span>";
    } else {
        output.classList.add("incorrectCaptcha");
        output.innerHTML = "<span id=\"incorrect\">Incorrect, please try again</span>";
    }
}