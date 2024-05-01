
/*
1. recoger valores
2. comprobar que son validos (se puede validar en cliente o en servidor)
3. pasar datos a python
*/

addEventListener('load', onload, false);

function onload() {
    if (document.querySelector(".navigation")) {
        showHideNavigation()
    }
    if (document.querySelector("#passfield")) {
        let showPassword = document.querySelector("#toggleBtn");
        showPassword.addEventListener('click', function () {
            showHidePassword();
        }, false)
    }
    if (document.querySelector("#oldPassword")) {
        let showPassword = document.querySelector("#toggleBtn");
        showPassword.addEventListener('click', function () {
            showHidePasswordProfile();
        }, false)
    }
    showHideNavigation();
}


function showHidePassword() {
    let showPassword = document.querySelector("#toggleBtn");
    if (document.querySelector("#passfield").getAttribute("type") == "password") {
        showPassword.setAttribute("src", "../../img/show_password.png")
        document.querySelector("#passfield").setAttribute("type", "text")
        document.getElementById("loginButton").disabled = true;

        //add css only if button is disabled
        document.querySelector("#loginButton").setAttribute("class", "buttonDisabled");
    } else {
        showPassword.setAttribute("src", "../../img/hide_password.png")
        document.querySelector("#passfield").setAttribute("type", "password")
        document.querySelector("#loginButton").removeAttribute("disabled");

        //remove css only if button is not disabled
        document.querySelector("#loginButton").removeAttribute("class");
    }
}
function showHidePasswordProfile() {
    let showPassword = document.querySelector("#toggleBtn");
    if (document.querySelector("#oldPassword").getAttribute("type") == "password") {
        showPassword.setAttribute("src", "../../img/show_password.png")
        document.querySelector("#oldPassword").setAttribute("type", "text")
        document.querySelector("#newPassword").setAttribute("type", "text")
        document.querySelector("#rePassword").setAttribute("type", "text")

    } else {
        showPassword.setAttribute("src", "../../img/hide_password.png")
        document.querySelector("#oldPassword").setAttribute("type", "password")
        document.querySelector("#newPassword").setAttribute("type", "password")
        document.querySelector("#rePassword").setAttribute("type", "password")

    }
}


function showHideNavigation() {
    let navigation = document.querySelector(".navigation")
    let toggle = document.querySelector(".toggle");
    toggle.onclick = function () {
        navigation.classList.toggle('active')
    }
}

function usernameGenerator() {
    //lastname+initial

    let name = document.querySelector("#namefield").value
    let lastname = document.querySelector("#lastnamefield").value

    let newUsername = lastname + name.substr(0, 1);
    document.querySelector("#userfield").value = newUsername;
    return newUsername;

}

function passwordGenerator() {
    //generate length password randomly 
    let passwordLength = Math.floor(Math.random() * (16 - 8)) + 8;

    //generate number part 
    let randomNumber = Math.floor(Math.random() * (9 - 0)) + 0;

    let result = []
    let letter = ""
    let u = 2, l = ((passwordLength - u) - 1);

    //generate the upper part
    for (let i = 0; i < u; i++) {
        let random = Math.ceil(Math.random() * 25)
        result.push(String.fromCharCode(65 + random))
    }
    //generate the lower part
    for (let i = 0; i < l; i++) {
        let random = Math.ceil(Math.random() * 25)
        result.push(String.fromCharCode(97 + random))
    }
    result.push(randomNumber)
    letter += result.join("") //remove coma from array

    let newPassword = letter.toString()
    document.querySelector("#passfield").value = newPassword
    document.querySelector("#repassfield").value = newPassword
    return newPassword
}





