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

<h1>View AClass #<?php echo $model->CID; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'CID',
		'COURSE_CODE',
		'YEAR',
		'SEMESTER',
	),
)); ?>

<h2></h2>
<script language="javascript">
<!--

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
    alert("Star: " + index);
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