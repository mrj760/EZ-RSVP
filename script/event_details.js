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
    let guests = JSON.parse(localStorage.getItem('guests'));
    let guestList = document.getElementById('guestList');
    for (let i = 0; i < guests.length; i++) {
        let guest = guests[i];
        let listElement = document.createElement('li');
        listElement.innerHTML = "Name: " + guest.guestname + " | Email: " + guest.guestemail;
        listElement.classList.add('list-group-item');
        guestList.appendChild(listElement);
    }
    
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
    
    appendElmtToDiv(detailsDiv, "Details: " + event.details);
    appendElmtToDiv(locationDiv, "Location: " + event.location);
    appendElmtToDiv(datetimeDiv, "Date: " + event.date + ' ' + event.time);
}

function appendElmtToDiv(divNode, value, elmt='p') {
    let child = document.createElement(elmt);
    child.innerHTML = value;
    divNode.appendChild(child);
}
