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
class Events {
    constructor(){
        this.name_array = [];
        this.photoURL_array = [];
        this.detail_array = [];
        this.locations_array = [];
        this.datetime_array = [];
    }
    // create a new event and save it in the collection
    newEvent(name, photoURL, detail, location, datetime){
        let n = new Event(name)
        let p = new Event(photoURL)
        let d = new Event(detail)
        let l = new Event(location)
        let dt = new Event(datetime)

        // push the event to event array
        this.name_array.push(n)
        this.photoURL_array.push(p)
        this.detail_array.push(d)
        this.location_array.push(l)
        this.datetime_array.push(dt)

        return (n, p, d, l, dt)
    }
    // get all events in event array
    get allEvents(){
        return (this.names, this.photoURLs, this.details, this.locations, this.datetimes)
    }
}


//example: 
let event_list = new Events();

event_List.newEvent("Steve's BBQ", "https://~", "Eating BBQ with Steve", "San Marcos, CA", "October 4, 2023, 12:00pm" )
event_List.newEvent("Mike's Hunt", "https://~", "Hunting with Mike", "San Marcos, CA", "October 5, 2023, 12:00pm" )


window.addEventListener("load", function() {
    displayDashboardEvent(event_list);
});

// In the dashboard, just show picture and name of event
// show the event list using loop
function displayDashboardEvent(event) {
    for(let i=0; i<Events.names.length; i++){
        nameDiv = document.getElementById("dashboardEventName");
        photoURLDiv = document.getElementById("dashboardEventPic");
        
        appendElmtToDiv(nameDiv, event.names[i])
        appendElmtToDiv(photoURLDiv, event.photoURLs[i])
    }
}

function appendElmtToDiv(divNode, value, elmt='p') {
    let child = document.createElement(elmt);
    child.innerHTML = value;
    divNode.appendChild(child);
}
