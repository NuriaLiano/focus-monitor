addEventListener('load', () => {

    let btn = document.querySelector("#registerButton");
    btn.addEventListener("click", () => {
        let namefield = document.querySelector("#namefield").value
        let lastnamefield = document.querySelector("#lastnamefield").value
        let userfield = document.querySelector("#userfield").value
        let passfield = document.querySelector("#passfield").value
        let repassfield = document.querySelector("#repassfield").value
        let emailfield = document.querySelector("#emailfield").value
        let officeNumberfield = document.querySelector("#officeNumberfield").value
        let phoneNumber = document.querySelector("#phoneNumber").value

        if (!checkTypeText(namefield) || !checkTypeText(namefield)) {
            //pintar el input
            document.querySelector("#namefield").setAttribute("class", "wrongInput")
            document.querySelector("#lastnamefield").setAttribute("class", "wrongInput")
        }
        if (!chechUsername(userfield, namefield, lastnamefield)) {
            document.querySelector("#userfield")
        }
        if (!checkPasswords(passfield, repassfield)) {
            document.querySelector("#passfield").setAttribute("class", "wrongInput")
            document.querySelector("#repassfield").setAttribute("class", "wrongInput")
        }
        if(!checkTypeEmail(emailfield)){
            document.querySelector("#emailfield").setAttribute("class", "wrongInput")
        }
        if(!checkTypeNumber(officeNumberfield)){
            document.querySelector("#officeNumberfield").setAttribute("class", "wrongInput")
        }
        if(!checkTypePhone(phoneNumber)){
            document.querySelector("#phoneNumber").setAttribute("class", "wrongInput")
        }
    }, false);
}, false);


function chechUsername(username, name, lastname) {
    let newUsername = lastname + name.substr(0, 1);
    return username == newUsername
}


function checkTypeText(str) {
    const regex = /^[a-zA-Z]+$/;
    return regex.test(str)
}

function hasSpace(element) {
    return element.indexOf(" ") !== -1;
}

function checkTypeEmail(str) {
    var regex = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@unican\.es$/;
    return regex.test(str);
}

function checkTypeNumber(num) {
    const regex = /^\d+$/;
    return regex.test(num)
}

function checkTypePhone(phone){
    var regex = /^[0-9]{9,15}$/;
    return regex.test(phone);
}

function checkPasswords(pass1, pass2) {
    if (pass1.length < 8 || pass1.length > 16) {
        return false;
    }
    var hasUppercase = /[A-Z]/.test(pass1);
    var hasLowercase = /[a-z]/.test(pass1);
    var hasNumber = /[0-9]/.test(pass1);
    if (!hasUppercase || !hasLowercase || !hasNumber) {
        return false;
    }
    if(pass1 != pass2){
        return false;
    }
    return true;
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