class Event {
    constructor(name, photoURL, details, location, datetime)
    {
        this.name = name;
        this.photoURL = photoURL;
        this.details = details;
        this.location = location;
        this.datetime = datetime;
    }
    get stringify () {
        return this.name + this.parseSplitter + this.photoURL + this.parseSplitter + this.details + this.parseSplitter 
        + this.location + this.parseSplitter + this.datetime;}
    
    parse(str) {
        str = str.split(this.parseSplitter);
        this.name = str[0];
        this.photoURL = str[1];
        this.details = str[2];
        this.location = str[3];
        this.datetime = str[4];
    }
}
// get event name from create_event.html
const createdEvent = document.getElementById('eventName');

// implement passCreateEvent()
window.addEventListener("load", function () {
    passCreatedEvent(createdEvent);
});

// pass the event name from create page to dashboard page
function passCreatedEvent(event) { 
    
    let eventDiv = document.createElement("div");
    eventDiv.addEventListener("click", function(){
        localStorage.setItem('event', createdEvent.stringify);
    });

    let eventNameDiv = document.createElement('div');
    eventNameDiv.classList.add('eventNameDiv');
    let eventName = document.createElement('p');
    eventName.innerHTML = event.name;
    eventName.classList.add('eventName');
    eventNameDiv.appendChild(eventName);
    eventDiv.appendChild(eventNameDiv);

    userEventsDiv.appendChild(eventDiv);
}
