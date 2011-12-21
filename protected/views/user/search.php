<?php
Yii::app()->clientScript->registerScript('search', "
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('user-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
$this->renderPartial('_menu');
?>

<h1>用户</h1>

<div class="search-form">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php
    $attributes = array('UID',
		                'USER_NAME',
            		   );
            		   
    if (Yii::app()->user->role==="admin") {
        $attr = array('class'=>'CLinkColumn',
            		  'label'=>'管理资料',
            		  'urlExpression'=>'CHtml::normalizeUrl(array(
            				"user/update",
            				"id"=>$data->UID,
            		  ))');
        array_push($attributes, $attr);
    }
    
    $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'user-grid',
	'dataProvider'=>$model->search(),
	'columns'=>$attributes,
)); ?>
