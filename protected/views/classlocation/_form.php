<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'classtime-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'BUILDING_NUMBER'); ?>
		<?php echo $form->textField($model,'BUILDING_NUMBER'); ?>
		<?php echo $form->error($model,'BUILDING_NUMBER'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'CLASSROOM'); ?>
		<?php echo $form->textField($model,'CLASSROOM'); ?>
		<?php echo $form->error($model,'CLASSROOM'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
