function getCookie(cname) {
    let name = cname + "=";
    let decodedCookie = decodeURIComponent(document.cookie);
    let ca = decodedCookie.split(';');
    for (let i = 0; i < ca.length; i++) {
        let c = ca[i];
        while (c.charAt(0) == ' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
        }
    }
    return "";
}

function setCookie(cname, cvalue, exdays) {
    const d = new Date();
    d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
    let expires = "expires=" + d.toUTCString();
    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}

window.addEventListener("load", function () {
    displayDashboardEvent();
});

// In the dashboard, just show picture and name of event
// show the event list using loop
function displayDashboardEvent() {

    let userEventsDiv = document.getElementById('userEventsDiv');
    
    let events = getCookie('events');

    for (let i = 0; i < events.length; i++) {

        console.log(events[i]);
        
        let linkToEventDetails = document.createElement('a');
        linkToEventDetails.classList.add('userEvent');
        linkToEventDetails.href = "./event_details.php";

        let eventDiv = document.createElement('div');
        let photoDiv = document.createElement('div');
        photoDiv.classList.add('photoDiv');
        let photo = document.createElement('img');
        photo.src = events[i].photoURL;
        photoDiv.appendChild(photo);
        eventDiv.appendChild(photoDiv);

        let eventNameDiv = document.createElement('div');
        eventNameDiv.classList.add('eventNameDiv');
        let eventName = document.createElement('p');
        eventName.innerHTML = events[i].name;
        eventName.classList.add('eventName');
        eventNameDiv.appendChild(eventName);
        eventDiv.appendChild(eventNameDiv);

        linkToEventDetails.appendChild(eventDiv);
        userEventsDiv.appendChild(linkToEventDetails);
    }

}
