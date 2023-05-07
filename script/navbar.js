function getCookie(cname) {
    let name = cname + "=";
    let decodedCookie = decodeURIComponent(document.cookie);
    let ca = decodedCookie.split(';');
    for (let i = 0; i < ca.length; i++) {
        let c = ca[i];
        while (c.charAt(0) == ' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
        }
    }
    return "";
}

window.addEventListener("load", function () {

    let navdiv = document.createElement('div')
    navdiv.id = 'navDiv';
    
    let navbar = document.createElement('nav');
    navbar.id = 'navSpacing';
    navbar.classList.add('navbar'); 
    navbar.classList.add('navbar-expand'); 
    navbar.classList.add('navbar-dark'); 
    navbar.classList.add('bg-dark');
    navdiv.appendChild(navbar);

    let ezrsvp = document.createElement('a');
    ezrsvp.href = 'home.php';
    ezrsvp.classList.add('navbar-brand');
    ezrsvp.innerHTML = 'EZ-RSVP';
    navbar.appendChild(ezrsvp);

    let leftdiv = document.createElement('div');
    leftdiv.id = 'leftdiv';
    leftdiv.classList.add('navbar-nav');
    leftdiv.classList.add('mr-auto');
    navbar.appendChild(leftdiv);

    let homeli = document.createElement('li');
    homeli.classList.add('nav-item');
    leftdiv.appendChild(homeli);

    let home = document.createElement('a');
    home.href = 'home.php';
    home.classList.add('nav-link');
    home.innerHTML = ' Home';
    homeli.appendChild(home);

    let homeicon = document.createElement('i');
    homeicon.classList.add('fa-solid');
    homeicon.classList.add('fa-house');
    home.prepend(homeicon);

    let aboutli = document.createElement('li');
    aboutli.classList.add('nav-item');
    leftdiv.appendChild(aboutli);

    let about = document.createElement('a');
    about.classList.add( 'nav-link');
    about.href = 'about.php';
    about.innerHTML = ' About';
    aboutli.appendChild(about);

    let abouticon = document.createElement('i');
    abouticon.classList.add('fa-solid');
    abouticon.classList.add('fa-table-columns');
    about.prepend(abouticon);

    let rightdiv = document.createElement('div');
    rightdiv.id = 'rightdiv';
    rightdiv.classList.add('navbar-nav');
    rightdiv.classList.add('ms-auto');
    navbar.appendChild(rightdiv);

    if (getCookie('loggedin') == 1) {
        let logoutli = document.createElement('li');
        logoutli.classList.add('nav-item');
        rightdiv.appendChild(logoutli);

        let logout = document.createElement('a');
        logout.href = 'user_login.php';
        logout.classList.add('nav-link');
        logout.innerHTML = ' Logout';
        logoutli.appendChild(logout);

        let logouticon = document.createElement('i');
        logouticon.classList.add('fa-solid');
        logouticon.classList.add('fa-right-to-bracket');
        
        logout.prepend(logouticon);
    }
    else {
        let loginli = document.createElement('li');
        loginli.classList.add('nav-item');
        rightdiv.appendChild(loginli);

        let login = document.createElement('a');
        login.href = 'user_login.php';
        login.classList.add('nav-link');
        login.innerHTML = ' Login';
        loginli.appendChild(login);

        let logouticon = document.createElement('i');
        logouticon.classList.add('fa-solid');
        logouticon.classList.add('fa-right-to-bracket');
        login.prepend(logouticon);

        let registerli = document.createElement('li');
        registerli.classList.add('nav-item');
        rightdiv.appendChild(registerli);

        let register = document.createElement('a');
        register.href = 'user_register.php';
        register.classList.add('nav-link');
        register.innerHTML = ' Sign Up';
        registerli.appendChild(register);

        let registericon = document.createElement('i');
        registericon.classList.add('fa-solid');
        registericon.classList.add('fa-user-plus');
        register.prepend(registericon);
    }

    document.body.prepend(navdiv);
})