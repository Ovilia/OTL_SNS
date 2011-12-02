<h1>User Profile <?php echo $model->username; ?></h1>

<img src="<?php echo Yii::app()->request->baseUrl; ?>/images/ava.jpeg"/>

<?php echo $this->renderPartial('_profileform', array('model'=>$model)); ?>