function filterThreads(val) {

    var xmlhttp=new XMLHttpRequest();
    xmlhttp.onreadystatechange=function() {
        if (this.readyState==4 && this.status==200) {
        document.getElementById("thread-container").innerHTML=this.responseText;
        }
    }
    getop = "./php/update_thread_list.php";
    if(val.length != 0) {
        getop += "?filter_text=" + val
    }  
    xmlhttp.open("GET",getop,true);
    xmlhttp.send();


}

function createThreadForm() {
    var xmlhttp=new XMLHttpRequest();
    xmlhttp.onreadystatechange=function() {
        if (this.readyState==4 && this.status==200) {
        document.getElementById("create-thread").innerHTML=this.responseText;
        }
    }
    getop = "./partial/_threadform.php";
    xmlhttp.open("GET",getop,true);
    xmlhttp.send();
}

function checkThread() {
    let form = document.forms['create-thread'];
    let topic = form['topic'].value;
    let text = form['text'].value;
    let error = "";
    if(topic.length >= 8 && text.lengt <= 500){
        return true;
    }
    if(topic.length < 8) {
        error = "Title must be at least 8 characters long";
    }
    if(text.length > 500) {
        error = "Thread text can't be longer than 500 characters";
    }
    alert(error)
    return false;
}