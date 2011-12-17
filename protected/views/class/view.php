<?php
$this->breadcrumbs=array(
	'Aclasses'=>array('index'),
	$model->CID,
);

$this->menu=array(
	array('label'=>'List AClass', 'url'=>array('index')),
	array('label'=>'Create AClass', 'url'=>array('create')),
	array('label'=>'Update AClass', 'url'=>array('update', 'id'=>$model->CID)),
	array('label'=>'Delete AClass', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->CID),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage AClass', 'url'=>array('admin')),
);
?>

<h1>课程<?php echo $model->course->COURSE_NAME; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		array(
			'type'=>'raw',
			'label'=>'课程代号',
			'value'=>$model->course->COURSE_CODE,
		),
		array(
			'type'=>'raw',
			'label'=>'课程名称',
			'value'=>$model->course->COURSE_NAME,
		),
		array(
			'type'=>'raw',
			'label'=>'学年',
			'value'=>$model->course->YEAR,
		),
		array(
			'type'=>'raw',
			'label'=>'学期',
			'value'=>$model->course->SEMESTER,
		),
		array(
			'type'=>'raw',
			'label'=>'课程安排',
			'value'=>$model->classAtomClassesToString(),
		),
		array(
			'type'=>'raw',
			'label'=>'任课教师',
			'value'=>$model->teachersToString(),
		),
		array(
			'type'=>'raw',
			'value'=>CHtml::link("修改课程安排", array(
				'update', 'id'=>$model->CID,
			)),
		),
	),
)); ?>

<h2>Rate this class</h2>

<script language="javascript">

window.onload = function(){
   var star = <?php echo $star ?>;
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
	<input type="image" name="imageField1" src="<?php echo Yii::app()->request->baseUrl; ?>/images/1.png" onClick="Click(1)" onMouseOver = "MouseOver(1)" onMouseOut="MouseOut()">
	<input type="image" name="imageField2" src="<?php echo Yii::app()->request->baseUrl; ?>/images/1.png" onClick="Click(2)" onMouseOver = "MouseOver(2)" onMouseOut="MouseOut()">
	<input type="image" name="imageField3" src="<?php echo Yii::app()->request->baseUrl; ?>/images/1.png" onClick="Click(3)" onMouseOver = "MouseOver(3)" onMouseOut="MouseOut()">
	<input type="image" name="imageField4" src="<?php echo Yii::app()->request->baseUrl; ?>/images/1.png" onClick="Click(4)" onMouseOver = "MouseOver(4)" onMouseOut="MouseOut()">
	<input type="image" name="imageField5" src="<?php echo Yii::app()->request->baseUrl; ?>/images/1.png" onClick="Click(5)" onMouseOver = "MouseOver(5)" onMouseOut="MouseOut()">
</div>
