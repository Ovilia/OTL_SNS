<div class="view">
	<?php echo CHtml::encode($data->CONTENT); ?>
    <div class="status_time">
        <?php echo CHtml::encode($data->UPDATE_TIME); ?>
    </div>
    <br>
    <button class="button small gray" type="button" onclick="comment(<?php echo CHtml::encode($data->SID); ?>)">回复</button>
    <button class="button small gray" type="button" onclick="show_comment(<?php echo CHtml::encode($data->SID); ?>)">查看评论</button>

</div>
