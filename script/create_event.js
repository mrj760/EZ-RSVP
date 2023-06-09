
class Event {
    constructor(name, photoURL, details, location, datetime) {
        this.name = name;
        this.photoURL = photoURL;
        this.details = details;
        this.location = location;
        this.datetime = datetime;
        this.parseSplitter = "sdfuynf9s87dfy9 23807r32 98psDFsdf8s76dfSDFASDAF8G8GA"
    }


    get stringify () {
        return this.name + this.parseSplitter + this.photoURL + this.parseSplitter + this.details + this.parseSplitter 
        + this.location + this.parseSplitter + this.datetime;
    }

    parse(str) {
        str = str.split(this.parseSplitter);
        this.name = str[0];
        this.photoURL = str[1];
        this.details = str[2];
        this.location = str[3];
        this.datetime = str[4];
    }
}

function saveCreatedEvent(){
    //event.preventDefault();

    // get values from the input
    var createdEventName = document.getElementById("eventName").value;
    var createdEventLocation = document.getElementById("eventLocation").value;
    var createdEventDate = document.getElementById("eventDate").value;
    var createdEventDetails = document.getElementById("eventDetails").value;

    var newEvent = new Event(createdEventName, "", createdEventLocation, createdEventDate, createdEventDetails);

    localStorage.setItem('createdEvent', newEvent.stringify);
    location.href = 'user_dashboard.php';

    console.log("Stored infor is: " + createdEventName + createdEventLocation + createdEventDate + createdEventDetails);
}
