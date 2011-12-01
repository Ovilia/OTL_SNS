<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('UID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->UID), array('view', 'id'=>$data->UID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('USER_NAME')); ?>:</b>
	<?php echo CHtml::encode($data->USER_NAME); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('EMAIL')); ?>:</b>
	<?php echo CHtml::encode($data->EMAIL); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('PASSWORD')); ?>:</b>
	<?php echo CHtml::encode($data->PASSWORD); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('REGISTER_TIME')); ?>:</b>
	<?php echo CHtml::encode($data->REGISTER_TIME); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ISADMIN')); ?>:</b>
	<?php echo CHtml::encode($data->ISADMIN); ?>
	<br />


</div>