navDiv = document.createElement('div')
navDiv.id = 'navDiv';
navDiv.innerHTML = 
    "<nav class=\"navbar navbar-expand navbar-dark bg-dark\" id=\"navSpacing\">\n" +
    "    <a href=\"home.php\" class=\"navbar-brand\">EZ-RSVP</a>\n" +
    "    <div class=\"navbar-nav mr-auto\">\n" +
    "        <li class=\"nav-item\">\n" +
    "            <a href=\"home.php\" class=\"nav-link\">\n" +
    "                <i class=\"fa-solid fa-house\"></i> Home" +
    "            </a>\n" +
    "        </li>\n" +
    "        <li class=\"nav-item\">\n" +
    "            <a href=\"about.php\" class=\"nav-link\">About</a>\n" +
    "        </li>\n" +
    "        <li class=\"nav-item\">\n" +
    "            <a href=\"user_dashboard.php\" class=\"nav-link\">\n" +
    "                <i class=\"fa-solid fa-table-columns\"></i> Dashboard" +
    "            </a>\n" +
    "        </li>\n" +
    "    </div>\n" +
    "    <div class=\"navbar-nav ms-auto\">\n" +
    "        <li class=\"nav-item\">\n" + "<?php if (!isset($_SESSION['logged_in'])){?>" + 
    "            <a href=\"user_login.php\" class=\"nav-link\">\n" +
    "               <i class=\"fa-solid fa-right-to-bracket\"></i> Login" + "<?php } ?>" +
    "           <?php else {" + "<a href=\"user_login.php\" class=\"nav-link\">\n" + 
    "               <i class=\"fa-solid fa-right-to-bracket\"></i> Logout" + "<?php } ?>"
    "            </a>\n" + 
    "        </li>\n" +
    "        <li class=\"nav-item\">\n" +
    "            <a href=\"user_register.php\" class=\"nav-link\">\n" +
    "                <i class=\"fa-solid fa-user-plus\"></i> Sign Up" +
    "            </a>\n" +
    "        </li>\n" +
    "    </div>\n" +
    "</nav>\n" +
    "</div>";

window.addEventListener("load", function () {document.body.prepend(navDiv);})