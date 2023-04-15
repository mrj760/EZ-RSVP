class Event {
    constructor(name, details, location, datetime)
    {
        this.name = name;
        this.details = details;
        this.location = location;
        this.datetime = datetime;
    }
}

example = new Event("foo", "i am an example event", "San Marcos, CA", "October 2, 2020");

window.addEventListener("load", function() {
    console.log(example.name);
    displayEvent(example);
})

function displayEvent(event) {

    nameDiv = document.getElementById("event_name");
    detailsDiv = document.getElementById("event_details");
    locationDiv = document.getElementById("event_location");
    datetimeDiv = document.getElementById("event_datetime");

    nameDiv.innerHTML = "<p>" + event.name + "</p>";
}