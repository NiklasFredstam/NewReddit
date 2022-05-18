function createComment(val) {

    var xmlhttp=new XMLHttpRequest();
    xmlhttp.onreadystatechange=function() {
        if (this.readyState==4 && this.status==200) {
        document.getElementById("comment-container").innerHTML += this.responseText;
        }
    }
    getop = "./php/create_comment.php";
    xmlhttp.open("GET",getop,true);
    xmlhttp.send();


}