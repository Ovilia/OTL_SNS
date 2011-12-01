<?php
$this->pageTitle=Yii::app()->name . ' - 注册';
$this->layout="//layouts/no_nav";
?>
<h1><?php echo Yii::app()->name . ' - 注册';?></h1>
<hr>

<div id="regDiv">
    <form id="regForm">
        <table id="regTable">
            <tr>
                <td>
                    邮箱：
                </td>
                <td>
                    <input id="email" name="email" />
                </td>
            </tr>
            <tr>
                <td>
                    用户名：
                </td>
                <td>
                    <input id="uer_name" name="user_name" />
                </td>
            </tr>
            <tr>
                <td>
                    密码：
                </td>
                <td>
                    <input id="password" name="password" type="password"/>
                </td>
            </tr>
            <tr>
                <td>
                    重复密码：
                </td>
                <td>
                    <input id="repeat_password" name="repeat_password" type="password" />
                </td>
            </tr>
        </table>
        <button class="button small green" type="submit" id="regBtn">确认注册</button>
    </form>
</div><!-- end of regDiv -->

