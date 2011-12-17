<div class="wide form">
<h2>搜索课程</h2>

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'COURSE_CODE'); ?>
		<?php echo $form->textField($model,'COURSE_CODE',array('size'=>16,'maxlength'=>16)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'YEAR'); ?>
		<?php echo $form->textField($model,'YEAR',array('size'=>4,'maxlength'=>4)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'SEMESTER'); ?>
		<?php echo $form->textField($model,'SEMESTER',array('size'=>4,'maxlength'=>4)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'COURSE_NAME'); ?>
		<?php echo $form->textField($model,'COURSE_NAME',array('size'=>16,'maxlength'=>16)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('搜索课程'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->
