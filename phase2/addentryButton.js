const postButton = document.getElementById("post");
const clearButton = document.getElementById("clear");

postButton.addEventListener("click", function(e) {
    if(document.getElementById("title_box").value == "" || document.getElementById("text_box").value == "") { 
        event.preventDefault();
        window.alert("Title and text box cannot be empty.");
        return;
    }
    window.alert("Entry has been posted!")
});

clearButton.addEventListener("click", function(e) {
    if(window.confirm("Do you want to clear your entry?")){
        event.preventDefault();
        document.getElementById("title_box").value = "";
        document.getElementById("text_box").value = "";    
    }else{
        event.preventDefault();
    }
});
