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

is_owner = false;

example = new Event(
// Name
"Maria's Quincenera", 
// Photo
"https://www.metropolbanquet.com/wp-content/uploads/New-10-1-2000x1333.jpg",
// Description
'We are overjoyed to announce that our daughter, '
    + 'Maria, will be celebrating her quincenera on October 12th. '
    + 'This special day will commemorate Maria\'s 15 years and her passage into young womanhood. '
    + 'We invite you to join us in celebrating Maria on this momentous occasion. '
    + 'The day will begin with a special mass to give thanks for the grace of 15 years of life. '
    + 'We will then gather for a reception with traditional food, dancing, music, and festivities. '
    + 'Maria will make her grand entrance in a beautiful quinceñera gown, '
    + 'freshly shod with elegant ballet-style shoes, completed with her bouquet of roses. '
    + 'There will be memories and joy for all, as Maria shares her first waltz with '
    + 'her father and enjoys this magical night surrounded by family and friends. '
    + 'Guests will have the opportunity to capture photos and videos of the dances, '
    + 'cake cutting, bouquet toss, and other special moments. Please RSVP through our '
    + 'website event page and let us know if you plan to join in the celebration. '
    + 'We look forward to an afternoon full of love, community, and celebration for Maria\'s '
    + 'quincenera! Mementos and testimonials from the day will be posted for all to enjoy '
    + 'following the event. We hope that you can make time to share this memorable quinceañera with us. '
    + 'Maria and our family look forward to celebrating this special occasion with each of you!',
// Location
"San Marcos, CA",
// Date, Time
"October 2, 2020, 12:00pm");

window.addEventListener("load", function() {
    displayEvent(example);
});

function displayEvent(event) {

    nameDiv = document.getElementById("eventName");
    coverPhotoDiv = document.getElementById("eventCoverPhoto");
    detailsDiv = document.getElementById("eventDetails");
    locationDiv = document.getElementById("eventLocation");
    datetimeDiv = document.getElementById("eventDatetime");

    appendElmtToDiv(nameDiv, event.name);
    
    let photo = document.createElement('img');
    photo.src = event.photoURL;
    coverPhotoDiv.appendChild(photo);
    
    appendElmtToDiv(detailsDiv, event.details);
    appendElmtToDiv(locationDiv, "Location: " + event.location);
    appendElmtToDiv(datetimeDiv, "Date: " + event.datetime);
}

function appendElmtToDiv(divNode, value, elmt='p') {
    let child = document.createElement(elmt);
    child.innerHTML = value;
    divNode.appendChild(child);
}