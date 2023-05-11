let popupBackground = document.getElementById('popupBackground');
let guestListPopup = document.getElementById('guestListPopup');

let guestButton = document.getElementById('guestListButton');
guestButton.addEventListener('click', viewGuests);

let closeButton = document.getElementById('closeButton');
closeButton.addEventListener('click', closePopup);

function viewGuests() {
  popupBackground.style.display = 'flex';
  guestListPopup.style.display = 'flex';
};

function closePopup() {
  popupBackground.style.display = 'none';
  guestListPopup.style.display = 'none';
}

window.addEventListener("load", function() {
    displayEvent();
});

function displayEvent() {
    
    let event = JSON.parse(localStorage.getItem('event'))[0];
    
    nameDiv = document.getElementById("eventName");
    coverPhotoDiv = document.getElementById("eventCoverPhoto");
    detailsDiv = document.getElementById("eventDetails");
    locationDiv = document.getElementById("eventLocation");
    datetimeDiv = document.getElementById("eventDatetime");
    dateTime = document.getElementById("eventTime");

    appendElmtToDiv(nameDiv, event.name, 'h1');
    
    let photo = document.createElement('img');
    photo.src = event.photoURL;
    photo.style = "max-width: 45%; height: auto;" 
    coverPhotoDiv.appendChild(photo);
    
    appendElmtToDiv(detailsDiv, event.details);
    appendElmtToDiv(locationDiv, "Location: " + event.location);
    appendElmtToDiv(datetimeDiv, "Date: " + event.date + ' ' + event.time);
}

function appendElmtToDiv(divNode, value, elmt='p') {
    let child = document.createElement(elmt);
    child.innerHTML = value;
    divNode.appendChild(child);
}
