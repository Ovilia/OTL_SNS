<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'message-form',
	'enableAjaxValidation'=>true,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'UID'); ?>
		<?php echo $form->textField($model, 'UID', array('readonly'=>'readonly')); ?>
		<?php echo $form->error($model,'UID'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'USE_UID'); ?>
		<?php echo $form->textField($model,'USE_UID'); ?>
		<?php echo $form->error($model,'USE_UID'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'CONTENT'); ?>
		<?php echo $form->textArea($model,'CONTENT',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'CONTENT'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('发送'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
