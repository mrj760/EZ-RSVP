var path = window.location.pathname;
var title = path.split("/").pop();
title = title.substring(0,title.length-5);
title = title.split('_');
for (let i=0; i < title.length; i++) {
    title[i] = title[i][0].toUpperCase() + title[i].substring(1);
}
title = '<title>EZ-RSVP: ' + title.join(' ') + '</title>\n';

let meta = 
 + '<meta charset="UTF-8">\n'
 + '<meta http-equiv="X-UA-Compatible" content="IE=edge">\n'
 + '<meta name="viewport" content="width=device-width, initial-scale=1.0">\n'

let dependencies =
 '<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"/>\n'
 + '<script src="https://kit.fontawesome.com/ff3950c27f.js" crossorigin="anonymous"></script>\n'
 + '<link href="../style/_global.css" rel="stylesheet">\n';

document.head.innerHTML = title + meta + dependencies + document.head.innerHTML;