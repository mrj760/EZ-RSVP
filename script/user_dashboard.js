class Event {
    constructor(name, photoURL, details, location, datetime) {
        this.name = name;
        this.photoURL = photoURL;
        this.details = details;
        this.location = location;
        this.datetime = datetime;
    }
}


//example: 
let eventList = new Array();
eventList.push(new Event("Steve's BBQ", "https://images.pexels.com/photos/533325/pexels-photo-533325.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2", "Eating BBQ with Steve", "San Marcos, CA", "October 4, 2023, 12:00pm"));
eventList.push(new Event("Mike's Hunt", "https://dwr.virginia.gov/wp-content/uploads/top-reasons-to-take-a-friend.jpg", "Hunting with Mike", "San Marcos, CA", "October 5, 2023, 12:00pm"));


window.addEventListener("load", function () {
    displayDashboardEvent(eventList);
});


// In the dashboard, just show picture and name of event
// show the event list using loop
function displayDashboardEvent() {

    for (let i = 0; i < eventList.length; i++) {

        let userEventsDiv = document.getElementById('userEventsDiv');

        let linkToEventDetails = document.createElement('a');
        linkToEventDetails.classList.add('userEvent');
        linkToEventDetails.href = "./event_details.html"

        let eventDiv = document.createElement('div');
        eventDiv.addEventListener('click', function () {
            alert('you clicked on ' + eventList[i].name);
        })

        let photoDiv = document.createElement('div');
        photoDiv.classList.add('photoDiv');
        let photo = document.createElement('img');
        photo.src = eventList[i].photoURL;
        photoDiv.appendChild(photo);
        eventDiv.appendChild(photoDiv);

        let eventName = document.createElement('p');
        eventName.innerHTML = eventList[i].name;
        eventName.classList.add('eventName');
        eventDiv.appendChild(eventName);

        linkToEventDetails.appendChild(eventDiv);
        userEventsDiv.appendChild(linkToEventDetails);
    }

}