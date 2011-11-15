<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'user-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'UID'); ?>
		<?php echo $form->textField($model,'UID'); ?>
		<?php echo $form->error($model,'UID'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'LOGIN_NAME'); ?>
		<?php echo $form->textField($model,'LOGIN_NAME',array('size'=>32,'maxlength'=>32)); ?>
		<?php echo $form->error($model,'LOGIN_NAME'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'EMAIL'); ?>
		<?php echo $form->textField($model,'EMAIL',array('size'=>60,'maxlength'=>64)); ?>
		<?php echo $form->error($model,'EMAIL'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'PASSWORD'); ?>
		<?php echo $form->passwordField($model,'PASSWORD',array('size'=>20,'maxlength'=>64)); ?>
		<?php echo $form->error($model,'PASSWORD'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'REGISTER_TIME'); ?>
		<?php echo $form->textField($model,'REGISTER_TIME'); ?>
		<?php echo $form->error($model,'REGISTER_TIME'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'NICK_NAME'); ?>
		<?php echo $form->textField($model,'NICK_NAME',array('size'=>32,'maxlength'=>32)); ?>
		<?php echo $form->error($model,'NICK_NAME'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'ISADMIN'); ?>
		<?php echo $form->textField($model,'ISADMIN'); ?>
		<?php echo $form->error($model,'ISADMIN'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->