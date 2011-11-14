<?php $this->pageTitle=Yii::app()->name; ?>
<a href="<?php echo Yii::app()->request->baseUrl; ?>/index.php/site/page?view=about">
    This is only a temporary link to About page.
</a>
<div id="loginDiv">
    <form id="loginForm">
        <table id="loginTable">
            <tr>
                <td>
                    <label for="email">邮箱：</label>
                </td>
                <td>
                    <input id="email" />
                </td>
            </tr>
            <tr>
                <td>
                    <label for="password">密码：</label>
                </td>
                <td>
                    <input id="password" type="password" />
                </td>
            </tr>
        </table>
        <table id="buttonTable">
            <tr>
                <td>
                    <button class="button small green" type="submit" id="loginBtn">登录</button>
                </td>
                <td>
                    <button class="button small green" type="button" id="registerBtn">注册</button>
                </td>
            </tr>
        </table>
    </form>
</div><!-- End of loginDiv -->

