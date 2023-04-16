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

const event_node_array = new Array();



window.addEventListener("load", function() {
    displayEvent(event_node_array);
});

