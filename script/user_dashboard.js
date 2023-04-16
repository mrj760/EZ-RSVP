class Event {
    constructor(name, photoURL, details, location, datetime)
    {
        this.name = name;
        this.photoURL = photoURL;
        this.details = details;
        this.location = location;
        this.datetime = datetime;
    }
}


//example: 
let eventList = new Array();
eventList.push(new Event("Steve's BBQ", "https://~", "Eating BBQ with Steve", "San Marcos, CA", "October 4, 2023, 12:00pm"));
eventList.push(new Event("Mike's Hunt", "https://~", "Hunting with Mike", "San Marcos, CA", "October 5, 2023, 12:00pm"));


window.addEventListener("load", function() {
    displayDashboardEvent(eventList);
});


// In the dashboard, just show picture and name of event
// show the event list using loop
function displayDashboardEvent() {

    for(let i=0; i < eventList.length; i++){
        
        let userEventsDiv = document.getElementById('userEventsDiv');

        let eventDiv = document.createElement('div');
        eventDiv.classList.add('userEvent');
        eventDiv.addEventListener('click', function () {
            alert('you clicked on ' + eventList[i].name);
        })

        let photoDiv = document.createElement('div');
        photoDiv.classList.add('photoDiv');
        let photo = document.createElement('img');
        photo.src = eventList[i].photoURL;
        photoDiv.appendChild(photo);
        eventDiv.appendChild(photoDiv);
        appendElmtToDiv(eventDiv, eventList[i].name);

        userEventsDiv.appendChild(eventDiv);
    }

}

function appendElmtToDiv(divNode, value, elmt='p') {
    let child = document.createElement(elmt);
    child.innerHTML = value;
    divNode.appendChild(child);
}
// // In the dashboardpage, you click the image or name of event
// // then move to event details
// window.onload = function(){
//     var el = document.getElementById("dashboard_EventPic");
//     var el_name = document.getElementById("dashboard_EventName");

