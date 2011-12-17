<h1>忘记密码</h1>
<hr>
<form id="forgetPw">
    注册邮箱：
    <input id="email" /><br><br>
    <button class="button green small" type="button" onclick="self.location='<?php echo Yii::app()->request->baseUrl; ?>/index.php/Anonymous/sendPassword/email/' + encodeURIComponent(document.getElementById('email').value)">重设密码</button>
</form>
