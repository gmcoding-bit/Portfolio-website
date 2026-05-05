const postButton = document.getElementById("post");
const clearButton = document.getElementById("clear");
const previewButton = document.getElementById("preview");


postButton.addEventListener("click", function(e) {
    if(document.getElementById("title_box").value == "" || document.getElementById("text_box").value == "") { 
        event.preventDefault();
        window.alert("Title and text box cannot be empty.");
    }else{
        window.alert("Entry has been posted!");
    }
});

clearButton.addEventListener("click", function(e) {
    if(window.confirm("Do you want to clear your entry?")){
        document.getElementById("title_box").value = "";
        document.getElementById("text_box").value = "";    
    }
});

previewButton.addEventListener("click",function(e){
    const title = document.getElementById("title_box");
    const text = document.getElementByIf("text_box");
    if(document.getElementById("title_box").value == "" || document.getElementById("text_box").value == ""){
        window.alert("Title and text box cannot be empty.");
    }else{
        const date = new Date();
        document.getElementById('preview_title').textcontent = title;
        document.getElementBy
    }
});
