/* 
    Sets the title of the page.
    Sets the meta characteristics of the page.
    Adds the given stylesheets to the page.
        - Includes project-global stylesheet and page-specific stylesheet.
    
    Finally adds all given Scripts to the page
*/


function addScript(src, crossorigin = -1, append = true) {
    let script = document.createElement('script');
    script.setAttribute('src', src);
    if (crossorigin != -1) {
        script.setAttribute('crossorigin', crossorigin);
    }
    document.head.appendChild(script);
}

var path = window.location.pathname;
var pagename = path.split("/").pop();
pagename = pagename.substring(0, pagename.length - 4);
let title = pagename.split('_');


addScript('../script/' + pagename + '.js?<?=filesize("../script/' + pagename + '.js"); ?>');
addScript('../script/' + 'navbar' + '.js?<?=filesize("../script/' + 'navbar' + '.js"); ?>');

for (let i = 0; i < title.length; i++) {
    title[i] = title[i][0].toUpperCase() + title[i].substring(1);
}
title = '<title>EZ-RSVP: ' + title.join(' ') + '</title>\n';

function addMeta(attrVals) {
    for (i in attrVals) {
        let meta = document.createElement('meta');
        meta.setAttribute(attrVals[i][0], attrVals[i][1]);
        document.head.appendChild(meta);
    }
}

addMeta([
    ['charset', 'UTF-8'],
    ['http-equiv', 'X-UA-Compatible'],
    ['content', 'IE=edge'],
    ['name', 'viewport'],
    ['content', 'width=device-width, initial-scale=1.0'],
]);

let stylesheets =
    '<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"/>\n'
    + '<link rel="stylesheet" type="text/css" href="../style/' + pagename + '.css?<?=filesize("../style/' + pagename + '.css"); ?>"/>\n'

// console.log(document.head.innerHTML)
document.head.innerHTML = title + document.head.innerHTML + stylesheets;

window.addEventListener("load", function (event) {
    
    addScript('https://kit.fontawesome.com/ff3950c27f.js', 'anonymous');

    navspace = document.createElement('div');
    navspace.id = 'navspace';
    document.body.prepend(navspace);
})