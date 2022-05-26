
function activateForm() {
    document.getElementById("username").disabled = false;
    document.getElementById("email").disabled = false;
    document.getElementById("submit-button").disabled = false;
    document.getElementById("submit-button").className = "standard-button large";

    document.getElementById("old-password").disabled = false;
    document.getElementById("new-password").disabled = false;
    document.getElementById("edit-button").disabled = true;
    document.getElementById("edit-button").className = "disabled-button small";

}

function validateUserInfo() {
    let form = document.forms['edit-user-info'];
    let uname = form['username'].value;
    let email = form['email'].value;
    let oldpwd = form['old-password'].value;
    let newpwd = form['new-password'].value;
    if(newpwd.length == 0 && oldpwd.length == 0) {
        return validateNoPwd(uname, email);
    }
    else {
        return validateAll(uname,email,oldpwd,newpwd);
    }
}

function validateAll(uname, email, oldpwd, newpwd) {
    if(uname.length >= 4 && validateEmail(email) && passwordChecker(oldpwd) && passwordChecker(newpwd)){
        return true;
    }
    let error= "";
    if(uname.length < 4)
        error += "Username must be at least 4 letters long\r\n";
    if(!validateEmail(email))
        error += "Please enter a valid email address\r\n";
    if(!passwordChecker(oldpwd)) {
        error += "Incorrect password";
    }
    else {
        if(!passwordChecker(newpwd)) {
            error += "New password must be longer than 8 characters and contain at least one numeric value, one lowercase letter and one uppercase letter";
        }
    }

    alert(error)
    return false;
}

function validateNoPwd(uname, email) {
    if(uname.length >= 4 && validateEmail(email) && passwordChecker(oldpwd) && passwordChecker(newpwd)){
        return true;
    }
    let error= "";
    if(uname.length < 4)
        error += "Username must be at least 4 letters long\r\n";
    if(!validateEmail(email))
        error += "Please enter a valid email address\r\n";
    alert(error)
    return false;
}

function validateEmail(email){
    if(email.lastIndexOf(".") > email.indexOf("@") + 2 && email.indexOf("@") > 0 && email.length - email.lastIndexOf(".") >2 ){
        return true;
    }
        return false;
}
function passwordChecker(pwd){
    return pwd.length > 7 && hasNumeric(pwd) && hasUppercase(pwd) && hasLowercase(pwd);
}

function hasNumeric(s){
    for (let i = 0; i < s.length; i++) {
        const c = s[i];
        if(!isNaN(c))
        return true;
    }
    return false;
}
function hasUppercase(s){
    for (let i = 0; i < s.length; i++) {
        const c = s[i];
        if(isNaN(c) && c == c.toUpperCase())
        return true;
    }
    return false;
}
function hasLowercase(s){
    for (let i = 0; i < s.length; i++) {
        const c = s[i];
        if(isNaN(c) && c == c.toLowerCase())
        return true;
    }
    return false;
}