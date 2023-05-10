window.addEventListener("load", function() {
    displayEvent(JSON.parse(localStorage.getItem('event')));
});

function displayEvent(event) {
    console.log(event);
    nameDiv = document.getElementById("eventName");
    coverPhotoDiv = document.getElementById("eventCoverPhoto");
    detailsDiv = document.getElementById("eventDetails");
    locationDiv = document.getElementById("eventLocation");
    dateDiv = document.getElementById("eventDate");
    dateTime = document.getElementById("eventTime");

    appendElmtToDiv(nameDiv, event.name, 'h1');
    
    let photo = document.createElement('img');
    photo.src = event.photoURL;
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
