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
		<?php echo $form->label($teacher,'TEACHER_NAME'); ?>
		<?php echo $form->textField($teacher,'TEACHER_NAME',array('size'=>32,'maxlength'=>32)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('搜索'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->
