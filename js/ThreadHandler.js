function insertComment() {
    let id = document.getElementById("thread-id").value;
    let text = document.getElementById("comment-input").value;
    let xmlhttp=new XMLHttpRequest();
    xmlhttp.onreadystatechange=function() {
        if (this.readyState==4 && this.status==200) {
        document.getElementById("comment-container").innerHTML += this.responseText;
        }
    }
    getop = "./php/create_comment.php?thread=" + id + "&text=" + text;
    xmlhttp.open("GET",getop,true);
    xmlhttp.send();

    sleep(2000).then(() => {
        loadComments(id)
    });

}

function loadComments(id) {

    let xmlhttp=new XMLHttpRequest();
    xmlhttp.onreadystatechange=function() {
        if (this.readyState==4 && this.status==200) {
        document.getElementById("comment-container").innerHTML = this.responseText;
        }
    }
    getop = "./partial/_commentlist.php?thread=" + id;
    xmlhttp.open("GET",getop,true);
    xmlhttp.send();


}

function validateComment() {
    let form = document.forms['create-comment'];
    let text = form['text'].value;
    if(text.length > 2){
        return true;
    }
    let error= "";
    alert(error)
    return false;
}

function sleep (time) {
    return new Promise((resolve) => setTimeout(resolve, time));
}
