function filterThreads() {
    //option 
    //let filteroption = 'thread-' + document.getElementByID('filterOption');
    const threadcon = document.getElementById('threads');
    const originalarrthreads = document.getElementByClass('thread-topic');
    var filteredlist;
    var filter = document.getElementById('filter').value;
    if(filter == "") {
        threadcon.replaceChildren(originalarrthreads);
        // listofdivs = document.getElementByClass('thread-username');
    }
    else {
        threadcon.replaceChildren(new Array(1));
        //t.replaceChildren(...new array of elements);
    //     for(let i = 0; i < listofdivs + 1; i++) {
    //         if(listofdivs[i].innerText.includes(filter)) {

    //         }
    //    }
    }
}

function updateThreads() {
    theDiv.appendChild(content);
}