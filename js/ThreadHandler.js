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
    let text = form['comment'].value;
    let error = "";
    if(text.length >= 2 && text.length <= 500){
        return true;
    }
    if(text.length < 2) {
        error= "Comment can't be less than two characters";
    }
    if(text.length > 500)
    error= "Comment can't be more than 500 characters long";
    alert(error)
    return false;
}

function sleep (time) {
    return new Promise((resolve) => setTimeout(resolve, time));
}
