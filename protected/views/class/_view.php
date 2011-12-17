<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('CID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->CID), array('view', 'id'=>$data->CID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('COURSE_CODE')); ?>:</b>
	<?php echo CHtml::encode($data->COURSE_CODE); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('YEAR')); ?>:</b>
	<?php echo CHtml::encode($data->YEAR); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('SEMESTER')); ?>:</b>
	<?php echo CHtml::encode($data->SEMESTER); ?>
	<br />


</div>