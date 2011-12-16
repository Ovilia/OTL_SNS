/* For search menu */
var tip = function(q, for_q){
    q = document.getElementById(q);
    for_q = document.getElementById(for_q);
    q.onfocus = function(){
        for_q.style.display = 'none';
        q.style.backgroundPosition = "right -17px";
        $("#search_suggest").slideDown();
    }
    q.onblur = function(){
        if(!this.value) for_q.style.display = 'block';
        q.style.backgroundPosition = "right 0";
        $("#search_suggest").slideUp();
    }
    for_q.onclick = function(){
        this.style.display = 'none';
        q.focus();
    }
};
$(document).ready(function(){
    tip('keyword','for-keyword');
    $("#keyword").keyup(function(){
        keywordval=$('#keyword').val();
        if (keywordval == null || keywordval == ''){
            $('#search_suggest').html('');
            return;
        }
        $.ajax({
            type:"POST",
            url:"<?php echo CHtml::normalizeUrl(array('site/search')); ?>",
            data:"ajax='ajax'&name='"+keywordval+"'",
            dataType:"json",
            success:function(result) {
                $("#search_suggest").html("<a href='#'><div class='search_type'>搜索用户 " + keywordval + "</div></a>");
                for (i in result.users) {
                    $("#search_suggest").append("<div class='search_suggest_result'><a href='<?php echo CHtml::normalizeUrl(array('user/view')); ?>/" + result.users[i].uid + "'><br>"+result.users[i].username + "</a></div>");
                }
                $("#search_suggest").append("<a href='#'><div class='search_type'>搜索课程 " + keywordval + "</div></a>");
                for (i in result.courses) {
                    $("#search_suggest").append("<div class='search_suggest_result'>"+result.courses[i].coursename + "</div>");
                }
            }
        });
    });
});

/* for comment */
function comment(id){
    alert("Comment on " + id + "!");
}

function show_comment(id){
    alert("Show " + id + "'s comment!");
}
