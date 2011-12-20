/* For search menu */
var tip = function(q, for_q, suggest_id){
    q = document.getElementById(q);
    for_q = document.getElementById(for_q);
    q.onfocus = function(){
        for_q.style.display = 'none';
        q.style.backgroundPosition = "right -17px";
        $("#" + suggest_id).slideDown();
    }
    q.onblur = function(){
        if(!this.value) for_q.style.display = 'block';
        q.style.backgroundPosition = "right 0";
        $("#" + suggest_id).slideUp();
    }
    for_q.onclick = function(){
        this.style.display = 'none';
        q.focus();
    }
};

/* for comment */
function comment(id){
    alert("Comment on " + id + "!");
}

function show_comment(id){
    alert("Show " + id + "'s comment!");
}


