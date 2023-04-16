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

eventList.push("Steve's BBQ", "https://~", "Eating BBQ with Steve", "San Marcos, CA", "October 4, 2023, 12:00pm");
eventList.push("Mike's Hunt", "https://~", "Hunting with Mike", "San Marcos, CA", "October 5, 2023, 12:00pm");


window.addEventListener("load", function() {
    displayDashboardEvent(eventList);
});

// In the dashboard, just show picture and name of event
// show the event list using loop
function displayDashboardEvent(event) {
    for(let i=0; i < eventList.length; i++){
        
        let userEventsDiv = document.getElementById('userEventsDiv');

        let eventDiv = document.createElement('div');
        eventDiv.classList.add('event');
        userEventsDiv.appendChild(eventDiv);
        eventDiv.addEventListener('click', function () {
            alert('you clicked on ' + event[i].name);
        })
        console.log(eventDiv);

        let photoURLDiv = document.getElementById('photoURLDiv');

        let photo = document.createElement('img');
        photo.src = event[i].photoURL;
        photoURLDiv.appendChild(photo);
        
        appendElmtToDiv(userEventsDiv, eventList[i].name);
        console.log(photoURLDiv);
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

//     el.onclick = clickEvent();
//     el_name.onlcick = clickEvent();
// }

// function clickEvent(){
//     alert('You click the event');
// }
