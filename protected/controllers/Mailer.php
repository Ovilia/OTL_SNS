<?php

class Mailer
{
    private $mailer = Yii::createComponent('application.extensions.mailer.EMailer');
    
    public function setHead()
    {
        $mailer->Host = 'localhost';
        $mailer->IsSMTP();
        $mailer->IsHTML(true);
        $mailer->CharSet = 'UTF-8';
    }
    
    public function setFrom($fromAddress, $fromName)
    {
        $mailer->From = $fromAddress;
        $mailer->FromName = $fromName;
    }
    
    public function setAddress($address)
    {
        $mailer->AddAddress($email);
    }
    
    public function setSubject($name, $subject)
    {
        $mailer->Subject = Yii::t($name, $subject);
    }
    
    public function setBody($password)
    {
        $message = '<div style="font-size: 20px;">OTL SNS 重设密码</div><br>您刚刚重设了密码，请使用以下密码登录，并尽快修改默认生成的密码。感谢您对OTL SNS的支持！<div style="color:red">您的新密码：';
        $message .= $password;
        $message .= '</div><br>请勿直接回复此邮件，联系我们：<br>hnkfliyao@gmail.com<br>tecton69@gmail.com<br>zwl.sjtu@gmail.com<br>';
        $mailer->Body = $message;
    }
    
    public function send()
    {
        if ($mailer->Send())
            return true;
        else
            return false;
    }
}

?>