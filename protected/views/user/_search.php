<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'UID'); ?>
		<?php echo $form->textField($model,'UID'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'LOGIN_NAME'); ?>
		<?php echo $form->textField($model,'LOGIN_NAME',array('size'=>32,'maxlength'=>32)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'EMAIL'); ?>
		<?php echo $form->textField($model,'EMAIL',array('size'=>60,'maxlength'=>64)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'PASSWORD'); ?>
		<?php echo $form->passwordField($model,'PASSWORD',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'REGISTER_TIME'); ?>
		<?php echo $form->textField($model,'REGISTER_TIME'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'NICK_NAME'); ?>
		<?php echo $form->textField($model,'NICK_NAME',array('size'=>32,'maxlength'=>32)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'ISADMIN'); ?>
		<?php echo $form->textField($model,'ISADMIN'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->