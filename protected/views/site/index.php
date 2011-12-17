<?php $this->pageTitle=Yii::app()->name; ?>
<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'login-form',
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>
<div id="loginDiv">
    <form id="loginForm">
        <table id="loginTable">
            <tr>
                <td>
                    <label for="email">邮箱：</label>
                </td>
                <td>
                    <?php echo $form->textField($model,'email'); ?>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="password">密码：</label>
                </td>
                <td>
                    <?php echo $form->passwordField($model,'password'); ?>
                </td>
            </tr>
        </table>
        <table id="buttonTable">
            <tr>
                <td>
                    <button class="button small green" type="submit" id="loginBtn">登录</button>
                </td>
                <td>
                    <button class="button small green" type="button" id="registerBtn" onclick="self.location='<?php echo Yii::app()->request->baseUrl; ?>/index.php/site/page?view=register'">注册</button>
                </td>
                <td>
                    <button class="button small green" type="button" id="forgetBtn" onclick="self.location='<?php echo Yii::app()->request->baseUrl; ?>/index.php/Anonymous/resetPassword'">忘记密码</button>
                </td>
            </tr>
        </table>
    </form>
<?php $this->endWidget(); ?>
</div><!-- End of loginDiv -->

