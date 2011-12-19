<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'atomclass-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'CID'); ?>
		<?php echo $form->textField($model,'CID'); ?>
		<?php echo $form->error($model,'CID'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'BUILDING_NUMBER'); ?>
		<?php echo $form->textField($model,'BUILDING_NUMBER'); ?>
		<?php echo $form->error($model,'BUILDING_NUMBER'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'CLASSROOM'); ?>
		<?php echo $form->textField($model,'CLASSROOM',array('size'=>8,'maxlength'=>8)); ?>
		<?php echo $form->error($model,'CLASSROOM'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'TIMEID'); ?>
		<?php echo $form->textField($model,'TIMEID'); ?>
		<?php echo $form->error($model,'TIMEID'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->