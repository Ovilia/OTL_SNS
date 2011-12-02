<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'user-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'username'); ?>
		<?php echo $form->textField($model,'username',array('size'=>32,'maxlength'=>32)); ?>
		<?php echo $form->error($model,'username'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'EMAIL'); ?>
		<?php echo $model->email; ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'old_password'); ?>
		<?php echo $form->passwordField($model,'old_password',array('size'=>60,'maxlength'=>64)); ?>
		<?php echo $form->error($model,'old_password'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'new_password'); ?>
		<?php echo $form->passwordField($model,'new_password',array('size'=>60,'maxlength'=>64)); ?>
		<?php echo $form->error($model,'new_password'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'new_password_repeat'); ?>
		<?php echo $form->passwordField($model,'new_password_repeat',array('size'=>60,'maxlength'=>64)); ?>
		<?php echo $form->error($model,'new_password_repeat'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'register_time'); ?>
		<?php echo $model->register_time; ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'isAdmin'); ?>
		<?php echo $model->isAdmin; ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->