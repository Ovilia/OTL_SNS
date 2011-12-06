<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'MID'); ?>
		<?php echo $form->textField($model,'MID'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'UID'); ?>
		<?php echo $form->textField($model,'UID'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'USE_UID'); ?>
		<?php echo $form->textField($model,'USE_UID'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'SEND_TIME'); ?>
		<?php echo $form->textField($model,'SEND_TIME'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'ISREAD'); ?>
		<?php echo $form->textField($model,'ISREAD'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'CONTENT'); ?>
		<?php echo $form->textArea($model,'CONTENT',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->