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

const event_node_array = Event;

for(let i=0; event_node_array.length; i++){
    appendElmtToDiv(event_node_array[i])
} 

