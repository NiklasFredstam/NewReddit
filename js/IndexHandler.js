function filterThreads(val) {

    var xmlhttp=new XMLHttpRequest();
    xmlhttp.onreadystatechange=function() {
        if (this.readyState==4 && this.status==200) {
        document.getElementById("thread-container").innerHTML=this.responseText;
        }
    }
    getop = "./php/updatethreadlist.php";
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
    getop = "./php/create_thread.php";
    xmlhttp.open("GET",getop,true);
    xmlhttp.send();
}

function checkThread() {
    let form = document.forms['create-thread'];
    let topic = form['topic'].value;
    let text = form['text'].value;
    if(topic.length > 8){
        return true;
    }
    let error= "";
    alert(error)
    return false;
}