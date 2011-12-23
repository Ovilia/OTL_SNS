<?php
include("Mailer.php");

class MailSenderFacade
{
    static public function getRandString($length)
    {
        $characters = "abcdefghijklmnopqrstuvwxyz0123456789";
        $char_length = strlen($characters);
        $result = "";
        for ($i = 0; $i < $length; ++$i){
            $result .= $characters[mt_rand(0, $char_length - 1)];
        }
        return $result;
    }
    
    static public function sendMail($model)
    {
        $password = $this->getRandString(8);
        $mailer = new $Mailer;
        $mailer->setHead();
        $mailer->setFrom('admin@otl.com', 'OTL SNS');
        $mailer->setAddress($model->EMAIL);
        $mailer->setSubject('demo', 'OTL SNS 重设密码');
        $mailer->setBody($password);
        if (!$mailer->send()){
            throw new CHttpException(400, 'Error in sending email.');
            return false;
        }
        
        return true;
    }
}

?>