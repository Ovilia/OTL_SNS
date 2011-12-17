<h2>
<?php echo User::model()->findByPk($uid)->USER_NAME; ?>
的课程信息
</h2>

<div style="width: 500px">
<?php $this->widget('zii.widgets.CListView', array(
    'dataProvider'=>$dataProvider,
    'itemView'=>'_takes',
)); ?>
</div>

