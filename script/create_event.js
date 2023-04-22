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
    // get value from each input
    var eventName = document.getElementById("eventName");
    var eventLocation = document.getElementById("eventLocation");
    var eventDate = document.getElementById("eventDate");
    var eventDetails = document.getElementById("eventDetails");

    this.name = eventName;
    this.location = eventLocation;
    this.datetime = eventDate;
    this.details = eventDetails;


    // store array in local storage
    localStorage.setItem('createdEvent', .stringify);

    location.href = "user_dashboard.html"

    console.log("local data store.")
}
