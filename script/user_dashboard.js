import { getCookie, setCookie } from "./cookie_functions";

window.addEventListener("load", function () {
    displayDashboardEvent(eventList);
});

// In the dashboard, just show picture and name of event
// show the event list using loop
function displayDashboardEvent() {

    console.log(getCookie('events'));
    let userEventsDiv = document.getElementById('userEventsDiv');

    let events = localStorage.getItem('events');

    for (let i = 0; i < events.length; i++) {

        console.log(events[i]);

        let linkToEventDetails = document.createElement('a');
        linkToEventDetails.classList.add('userEvent');
        linkToEventDetails.href = "./event_details.php";

        let eventDiv = document.createElement('div');
        eventDiv.addEventListener('click', function () {
            setCookie
        });

        let photoDiv = document.createElement('div');
        photoDiv.classList.add('photoDiv');
        let photo = document.createElement('img');
        photo.src = eventList[i].photoURL;
        photoDiv.appendChild(photo);
        eventDiv.appendChild(photoDiv);

        let eventNameDiv = document.createElement('div');
        eventNameDiv.classList.add('eventNameDiv');
        let eventName = document.createElement('p');
        eventName.innerHTML = eventList[i].name;
        eventName.classList.add('eventName');
        eventNameDiv.appendChild(eventName);
        eventDiv.appendChild(eventNameDiv);

        linkToEventDetails.appendChild(eventDiv);
        userEventsDiv.appendChild(linkToEventDetails);
    }

}