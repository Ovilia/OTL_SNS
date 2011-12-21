<?php
$this->pageTitle=Yii::app()->name . ' - 查看课程安排';
$this->renderPartial('_menu');
$this->breadcrumbs=array(
	'返回浏览课程信息'=>array(
		'course/view',
		'course_code'=>$model->COURSE_CODE,
		'year'=>$model->YEAR,
		'semester'=>$model->SEMESTER,
	),
);
?>

<?php
// Display all flash messages.
$flashMessages = Yii::app()->user->getFlashes();
if ($flashMessages) {
	echo '<ul class="flashes">';
	foreach($flashMessages as $key => $message) {
		echo '<li><div class="flash-' . $key . '">' . $message . "</div></li>\n";
	}
	echo '</ul>';
}
?>

<?php
// An animation for displaying flash messages.
Yii::app()->clientScript->registerScript(
		'flashMsgHideEffect',
		'$(".flashes").animate({opacity: 1.0}, 3000).fadeOut("slow");',
		CClientScript::POS_READY
		);
?>

<h1>课程<?php echo $model->course->COURSE_NAME; ?></h1>

<?php $this->renderPartial('_info', array('model'=>$model)); ?>

<script language="javascript">

window.onload = function(){
   var star = <?php if ($star !== null) echo $star; else echo 0; ?>;
   var test = $("#divStars")[0];
   if (star == -1)
       $("#divStars")[0].style.cssText="display:none";
   else
       ChangeState(star, false);
}

function ChangeState(index, isfixed){
    var colStars = divStars.getElementsByTagName("input");
    var i = 0;
    var k = isfixed? parseInt(textfield.value) : index;

    for(i=0; i<colStars.length; i++){
        colStars[i].src = (i<k? "<?php echo Yii::app()->request->baseUrl; ?>/images/2.png" : "<?php echo Yii::app()->request->baseUrl; ?>/images/1.png");
    }
}

function Click(index)
{
    //alert("Star: " + index);
	$.ajax({
            type:"POST",
            url:"<?php echo CHtml::normalizeUrl(array('class/rate')); ?>",
            data:"ajax='ajax'&star="+index+"&cid="+<?php echo $model->CID ?>,
            dataType:"json",
            success:function(result) {
                if (result == 1)
                    alert("Rate success. Star: " + index);// + " Rate: " + result.model.RATE + "CID: " + result.model.CID + "UID: " + result.model.UID);
                else if (result == 0)
                    alert("You have rated this class");
                else
                    alert("You haven't take this class.");
            }
        });
}

function MouseOver(index){
    ChangeState(index,false);
}

function MouseOut(){
    ChangeState(0,true);
}

-->
</script>
<div id="divStars">
    <h2>Rate this class</h2>
	<input type="image" name="imageField1" src="<?php echo Yii::app()->request->baseUrl; ?>/images/1.png" onClick="Click(1)" onMouseOver = "MouseOver(1)" onMouseOut="MouseOut()">
	<input type="image" name="imageField2" src="<?php echo Yii::app()->request->baseUrl; ?>/images/1.png" onClick="Click(2)" onMouseOver = "MouseOver(2)" onMouseOut="MouseOut()">
	<input type="image" name="imageField3" src="<?php echo Yii::app()->request->baseUrl; ?>/images/1.png" onClick="Click(3)" onMouseOver = "MouseOver(3)" onMouseOut="MouseOut()">
	<input type="image" name="imageField4" src="<?php echo Yii::app()->request->baseUrl; ?>/images/1.png" onClick="Click(4)" onMouseOver = "MouseOver(4)" onMouseOut="MouseOut()">
	<input type="image" name="imageField5" src="<?php echo Yii::app()->request->baseUrl; ?>/images/1.png" onClick="Click(5)" onMouseOver = "MouseOver(5)" onMouseOut="MouseOut()">
</div>
