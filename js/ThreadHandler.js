function insertComment(id) {

    let text = document.getElementById("comment-input").value;
    if(validateComment(text)) {
        var xmlhttp=new XMLHttpRequest();
        xmlhttp.onreadystatechange=function() {
            if (this.readyState==4 && this.status==200) {
            document.getElementById("comment-container").innerHTML += this.responseText;
            }
        }
        getop = "./php/create_comment.php?thread=" + id + "&text=" + text;
        xmlhttp.open("GET",getop,true);
        xmlhttp.send();

        loadComments(id);
    }
}

function loadComments(id) {

    var xmlhttp=new XMLHttpRequest();
    xmlhttp.onreadystatechange=function() {
        if (this.readyState==4 && this.status==200) {
        document.getElementById("comment-container").innerHTML = this.responseText;
        }
    }
    getop = "./partial/_commentlist.php?thread=" + id;
    xmlhttp.open("GET",getop,true);
    xmlhttp.send();


}

function validateComment(text) {
    //not
    return true;
}