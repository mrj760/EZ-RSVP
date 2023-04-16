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

// class that holds collection of events and properties and function for dashboard
class dashEvents {
    constructor(){
        this.name_array = [];
        this.photoURL_array = [];
        this.detail_array = [];
        this.location_array = [];
        this.datetime_array = [];
    }
    // method: push the objects to array
    dash_events(name, photoURL, detail, location, datetime){

        // push the event to event array
        this.name_array.push(name);
        this.photoURL_array.push(photoURL);
        this.detail_array.push(detail);
        this.location_array.push(location);
        this.datetime_array.push(datetime);

    }
    // get all events in event array
    get allEvents(){
        return (this.name_array, this.photoURL_array, this.detail_array, this.location_array, this.datetime_array);
    }
    // get length of event list
    get numberOfEvents(){
        return this.name_array.length;
    }
}


//example: 
let event_list = new dashEvents();

event_list.dash_events("Steve's BBQ", "https://~", "Eating BBQ with Steve", "San Marcos, CA", "October 4, 2023, 12:00pm");
event_list.dash_events("Mike's Hunt", "https://~", "Hunting with Mike", "San Marcos, CA", "October 5, 2023, 12:00pm");

console.log(dashEvents.allEvents);

window.addEventListener("load", function() {
    displayDashboardEvent(event_list);
});

// In the dashboard, just show picture and name of event
// show the event list using loop
function displayDashboardEvent(event) {
    for(let i=0; i<event_list.numberOfEvents; i++){
        nameDiv = document.getElementById("dashboardEventName");
        photoURLDiv = document.getElementById("dashboard_EventPic");
        
        var photo = document.createElement('img');
        photo.src = event.photoURL_array[i];
        photoURLDiv.appendChild(photo);

        appendElmtToDiv(nameDiv, event.name_array[i]);
    }
}

function appendElmtToDiv(divNode, value, elmt='p') {
    let child = document.createElement(elmt);
    child.innerHTML = value;
    divNode.appendChild(child);
}

// In the dashboardpage, you click the image or name of event
// then move to event details
window.onload = function(){
    var el = document.getElementById("dashboard_EventPic");
    var el_name = document.getElementById("dashboard_EventName");

    el.onclick = click_event;
    el_name.onlcick = click_event;
}

function click_event(){
    alert('You click the event');
}
