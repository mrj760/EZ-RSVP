window.addEventListener("load", function() {
    displayEvent(JSON.parse(localStorage.getItem('event')));
});

function displayEvent(event) {

    nameDiv = document.getElementById("eventName");
    coverPhotoDiv = document.getElementById("eventCoverPhoto");
    detailsDiv = document.getElementById("eventDetails");
    locationDiv = document.getElementById("eventLocation");
    datetimeDiv = document.getElementById("eventDatetime");

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

function delete_eventname(event){
    if (confirm("Are you sure to delete event?")){
        // not sure about this part!!!!!!
        let eventname = event.name;
        window.location = '../delete.event.php?eventname=${eventname}';
    }
}