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

var event_node_array = new Array();
event_node_array.push(new Event('','','','',''));



window.addEventListener("load", function() {
    displayEvent(event_node_array);
});

function displayEvent(){

}