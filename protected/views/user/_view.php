<div class="view">

	<?php echo CHtml::encode($data->getAttributeLabel('SID')); ?>:
	<?php echo CHtml::link(CHtml::encode($data->SID), array('view', 'id' => $data->SID)); ?>
	<br />

	<?php echo CHtml::encode($data->getAttributeLabel('UPDATE_TIME')); ?>:
	<?php echo CHtml::encode($data->UPDATE_TIME); ?>
	<br />
	<?php echo CHtml::encode($data->getAttributeLabel('CONTENT')); ?>:
	<?php echo CHtml::encode($data->CONTENT); ?>
	<br />


</div>
