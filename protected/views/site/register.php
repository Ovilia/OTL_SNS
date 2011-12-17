<?php
$this->pageTitle=Yii::app()->name . ' - 注册';
$this->layout="//layouts/no_nav";
?>
<h1><?php echo Yii::app()->name . ' - 注册';?></h1>
<hr>

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'registerForm',
	'enableAjaxValidation'=>false,
)); ?>

<div id="regDiv">
    <form id="regForm">
        <table id="regTable">
            <tr>
                <td>
		            <?php echo $form->label($model,'username'); ?>
		        </td>
		        <td>
        		    <?php echo $form->textField($model,'username',array('size'=>32,'maxlength'=>32)); ?>
        		</td>
        	</tr>
        	<tr>
                <td>
		            <?php echo $form->label($model,'email'); ?>
		        </td>
		        <td>
        		    <?php echo $form->textField($model,'email',array('size'=>32,'maxlength'=>32)); ?>
        		</td>
        	</tr>
        </table>
        <button class="button small green" type="submit" id="regBtn">确认注册</button>
    </form>
</div><!-- end of regDiv -->

<?php $this->endWidget(); ?>