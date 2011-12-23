<?php

class Mailer
{
    private $mailer;
    
    function __construct($mail) {
        $this->mailer = $mail;
    }
    public function setHead()
    {
        $this->mailer->Host = 'localhost';
        $this->mailer->IsSMTP();
        $this->mailer->IsHTML(true);
        $this->mailer->CharSet = 'UTF-8';
    }
    
    public function setFrom($fromAddress, $fromName)
    {
        $this->mailer->From = $fromAddress;
        $this->mailer->FromName = $fromName;
    }
    
    public function setAddress($address)
    {
        $this->mailer->AddAddress($address);
    }
    
    public function setSubject($name, $subject)
    {
        $this->mailer->Subject = Yii::t($name, $subject);
    }
    
    public function setBody($head, $body, $warning, $password)
    {
        $message = '<div style="font-size: 20px;">'.$head.'</div><br>'.$body.'<div style="color:red">'.$warning;
        $message .= $password;
        $message .= '</div><br>请勿直接回复此邮件，联系我们：<br>hnkfliyao@gmail.com<br>tecton69@gmail.com<br>zwl.sjtu@gmail.com<br>';
        $this->mailer->Body = $message;
    }
    
    public function send()
    {
        if ($this->mailer->Send())
            return true;
        else
            return false;
    }
}

?>