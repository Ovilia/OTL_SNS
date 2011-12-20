<?php
// Status
$recentStatus = $dataProvider->getData();
// Be fed
$fed = array();
$fedAmt = count($fedUser);
for ($i = 0; $i < $fedAmt; ++$i){
    $fed[$i]['UID'] = $fedUser[$i]->FEEDER_ID;
	$fed[$i]['email'] = User::model()->findByPk($fedUser[$i]->FEEDER_ID)->EMAIL;
}
// Feed
$feed = array();
$feedAmt = count($feedUser);
for ($i = 0; $i < $feedAmt; ++$i){
    $feed[$i]['UID'] = $feedUser[$i]->FED_ID;
	$feed[$i]['email'] = User::model()->findByPk($feedUser[$i]->FED_ID)->EMAIL;
}
// Classmate
$classmateData = array();
$classmateAmt = count($classmate);
for ($i = 0; $i < $classmateAmt; ++$i){
    $classmateData[$i]['UID'] = $classmate[$i]->UID;
    $classmateData[$i]['email'] = User::model()->findByPk($classmate[$i]->UID)->EMAIL;
}

$this->sidebar=array(
	'fed'=>$fed,
	'feed'=>$feed,
    'classmate'=>$classmateData,
    'recentStatus'=> $recentStatus == null ? 'ta很懒，什么都没说' : $recentStatus[0]->CONTENT,
	'UID'=>$model->UID,
	'email'=>$model->EMAIL,
	'user_name'=>$model->USER_NAME,
);
Yii::app()->clientScript->registerScript('comment', "
    $('.comment-button').click(function(){
        formID = '#form' + this.id;
    	$(formID).toggle();
    	return false;
    });
");

Yii::app()->clientScript->registerScript('showComment', "
    $('.show-comment-button').click(function(){
        commentsID = '#comments' + this.id.substr(4);
    	$(commentsID).toggle();
    	return false;
    });
");
?>

<h1>我的首页</h1>
<div>
    <form>
        <textarea name="contents" id="statusContent" placeholder="说点什么吧..."></textarea>
        <?php echo CHtml::button('发状态', array('submit'=>array('status/publish'),
            'class'=>'button medium green')); ?>
    </form>
    <div class="search_suggest" id="status_search_suggest">
       Content of search suggest.
    </div>
    <script type='text/javascript'>
    function setCid(cid) {
        var test = $("#statusContent")[0];
        $("#statusContent")[0].focus();
        $("#statusContent")[0].value += cid + " ";
        
    }
    
    function submitComment(id){
            var commentID='#comment' + id;
    	    var contents=$(commentID).val();
        	$('#form' + id).toggle();
        	$.ajax({
                type:"POST",
                url:"<?php echo CHtml::normalizeUrl(array('status/comment')); ?>",
                data:"ajax='ajax'&sid="+id+"&content="+contents,
                dataType:"json",
                success:function(result) {
                    if (result == 1)
                        alert(contents);
                }
            });
        	return false;
        }
        
    function sendCourseName(course) {
        $.ajax({
            type:"POST",
            url:"<?php echo CHtml::normalizeUrl(array('class/tip')); ?>",
            data:"ajax='ajax'&name="+course,
            dataType:"json",
            success:function(result) {
                $("#status_search_suggest").html("<div class='search_type'>哪个课程 " + course + "</div>");
                for (i in result.classes) {
                    for (j in result.classes[i].teachers) {
                        $("#status_search_suggest").append("<div class='course_suggest_result' onclick='setCid(" + result.classes[i].cid+ ")'>教师：" + result.classes[i].teachers[j].TEACHER_NAME + "</div>");
                    }
                }
            }
        });
    }
    
    function sendContent(content) {
        $.ajax({
            type:"POST",
            url:"<?php echo CHtml::normalizeUrl(array('course/tip')); ?>",
            data:"ajax='ajax'&name='" + content + "'",
            dataType:"json",
            success:function(result) {
                $("#status_search_suggest").html("<div class='search_type'>哪个课程 " + content + "</div>");
                for (i in result.courses) {
                    $("#status_search_suggest").append("<div class='course_suggest_result'>名称：" + result.courses[i].COURSE_NAME + "</div>");
                }
            }
        });
    }
    $(document).ready(function(){
        $("#statusContent").keyup(function(){
            keywordval=$('#statusContent').val();
            //alert(keywordval);
            if (keywordval == null || keywordval == ''){
                $('#status_search_suggest').html('');
                return;
            }
            //indexOfSharp = keywordval.lastIndexOf('#', 0, keywordval.length - startIndex);
            indexOfSharp = keywordval.lastIndexOf('#');
            if (indexOfSharp != -1) {
                content = keywordval.substr(indexOfSharp + 1);
                spaceIndex = content.indexOf(' ');
                if (spaceIndex != -1) {
                    course = content.substr(0, spaceIndex);
                    if (course.indexOf(' ') == -1)
                        sendCourseName(course);
                    //alert(course);
                }
                else if (content !== "") {
                    sendContent(content);
                }
                return;
            }
            return;
        });
        $("#statusContent").focus(function(){
            $("#status_search_suggest").slideDown();
            if ($("#statusContent").val() == null ||
                $("#statusContent").val() == ''){
                $("#status_search_suggest").html('');
                return;
            }
            // If current is 
        });
        $("#statusContent").blur(function(){
            $("#status_search_suggest").slideUp();
        });
    });
    </script>
    
</div><!-- status-form -->

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
