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
        this.names = [];
        this.photoURLs = [];
        this.details = [];
        this.locations = [];
        this.datetimes = [];
    }
    // create a new event and save it in the collection
    newEvent(name, photoURL, detail, location, datetime){
        let n = new Event(name)
        let p = new Event(photoURL)
        let d = new Event(detail)
        let l = new Event(location)
        let dt = new Event(datetime)

        this.names.push(n)
        this.photoURLs.push(p)
        this.details.push(d)
        this.locations.push(l)
        this.datetimes.push(dt)

        return (n, p, d, l, dt)
    }
    get allEvents(){
        return (this.names, this.photoURLs, this.details, this.locations, this.datetimes)
    }

}
