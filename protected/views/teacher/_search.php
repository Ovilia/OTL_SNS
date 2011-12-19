<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'TID'); ?>
		<?php echo $form->textField($model,'TID'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'TEACHER_NAME'); ?>
		<?php echo $form->textField($model,'TEACHER_NAME',array('size'=>32,'maxlength'=>32)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->