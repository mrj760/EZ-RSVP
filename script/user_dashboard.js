window.addEventListener("load", function () {
    displayDashboardEvent();
});

// In the dashboard, just show picture and name of event
// show the event list using loop
function displayDashboardEvent() {

    let userEventsDiv = document.getElementById('userEventsDiv');
    
    let events = JSON.parse(localStorage.getItem('events'));
    console.log(events.length);

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
