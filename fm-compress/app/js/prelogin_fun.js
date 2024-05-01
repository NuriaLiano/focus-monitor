addEventListener('load', ()=>{
    let showPassword = document.querySelector("#toggleBtn");
        showPassword.addEventListener('click', function () {
            showHidePasswordPrelogin();
        }, false)
    
}, false)



function showHidePasswordPrelogin() {
    let showPassword = document.querySelector("#toggleBtn");
    if (document.querySelector("#passfield").getAttribute("type") == "password") {
        showPassword.setAttribute("src", "../../../img/show_password.png")
        document.querySelector("#passfield").setAttribute("type", "text")
        document.querySelector("#repassfield").setAttribute("type", "text")
        document.getElementById("registerButton").disabled = true;

        //add css only if button is disabled
        document.querySelector("#registerButton").setAttribute("class", "buttonDisabled");
    } else {
        showPassword.setAttribute("src", "../../../img/hide_password.png")
        document.querySelector("#passfield").setAttribute("type", "password")
        document.querySelector("#repassfield").setAttribute("type", "password")
        document.querySelector("#registerButton").removeAttribute("disabled");

        //remove css only if button is not disabled
        document.querySelector("#registerButton").removeAttribute("class");
    }
}