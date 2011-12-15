<div class="view">
    <?php
    if ($data->ISREAD == 0){
        echo '<div class="notRead">';
    }else{
        echo '<div class="isRead">';
    }
    ?>	

	<b><?php echo CHtml::encode('发件人'); ?>:</b>
	<?php echo CHtml::encode($data->Sender->USER_NAME); ?>
	<br />

	<b><?php echo CHtml::encode('收件人'); ?>:</b>
	<?php echo CHtml::encode($data->Receiver->USER_NAME); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('SEND_TIME')); ?>:</b>
	<?php echo CHtml::encode($data->SEND_TIME); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('CONTENT')); ?>:</b>
	<?php echo CHtml::encode($data->CONTENT); ?>
	<br />

    </div>

</div>
