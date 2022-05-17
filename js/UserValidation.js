function checkRegistration() {
        let form = document.forms['registration'];
        let uname = form['username'].value;
        let email = form['email'].value;
        let psw = form['password'].value;
        if(uname.length > 3 && passwordChecker(psw)  && validateEmail(email)){
            return true;
        }
        let error= "";
        if(uname.length < 4)
            error += "Username must be at least 4 letters long\r\n";
        if(!validateEmail(email))
            error += "Please enter a valid email address\r\n";
        if(!passwordChecker(psw))
            error += "Password must be longer than 8 characters and contain at least one numeric value, one lowercase letter and one uppercase letter";
        alert(error)
        return false;
    }

function checkLogin() {
    let form = document.forms['login'];
    let uname = form['username'].value;
    let error = "";
    if(uname.length > 3){
        return true;
    }
    else
        error += "Username must be at least 4 letters long\r\n";
    alert(error)
    return false;
}
    
function validateEmail(email){
    if(email.lastIndexOf(".") > email.indexOf("@") + 2 && email.indexOf("@") > 0 && email.length - email.lastIndexOf(".") >2 ){
        return true;
    }
        return false;
}
function passwordChecker(psw){
    if(psw.length > 7 && hasNumeric(psw) && hasUppercase(psw) && hasLowercase(psw))
        return true;
    return false;
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