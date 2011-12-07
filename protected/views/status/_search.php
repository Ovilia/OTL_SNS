<div class="wide form">

<?php $form = $this->beginWidget('GxActiveForm', array(
	'action' => Yii::app()->createUrl($this->route),
	'method' => 'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model, 'SID'); ?>
		<?php echo $form->textField($model, 'SID'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'UID'); ?>
		<?php echo $form->dropDownList($model, 'UID', GxHtml::listDataEx(::model()->findAllAttributes(null, true)), array('prompt' => Yii::t('app', 'All'))); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'UPDATE_TIME'); ?>
		<?php echo $form->textField($model, 'UPDATE_TIME'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'CONTENT'); ?>
		<?php echo $form->textArea($model, 'CONTENT'); ?>
	</div>

	<div class="row buttons">
		<?php echo GxHtml::submitButton(Yii::t('app', 'Search')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->
