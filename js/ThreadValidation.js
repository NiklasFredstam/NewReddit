function valdiateThread() {
    let form = document.forms['create-thread'];
    let topic = form['topic'].value;
    let text = form['text'].value;
    if(topic.length > 8){
        return true;
    }
    let error= "";
    if(uname.length < 8)
        error += "Subject title must be at least 8 letters long\r\n";
    alert(error)
    return false;
}