<?php
include("Mailer.php");

class MailSenderFacade
{
    private $pMailer;
    private $head;
    private $body;
    private $warning;
    
    function __construct($mail, $head, $body, $warning)
    {
        $this->pMailer = $mail;
        $this->head = $head;
        $this->body = $body;
        $this->warning = $warning;
    }
    
    public function getRandString($length)
    {
        $characters = "abcdefghijklmnopqrstuvwxyz0123456789";
        $char_length = strlen($characters);
        $result = "";
        for ($i = 0; $i < $length; ++$i){
            $result .= $characters[mt_rand(0, $char_length - 1)];
        }
        return $result;
    }
    
    public function sendMail($model)
    {
        $password = $this->getRandString(8);
        $mailer = new Mailer($this->pMailer);
        $mailer->setHead();
        $mailer->setFrom('admin@otl.com', 'OTL SNS');
        $mailer->setAddress($model->EMAIL);
        $mailer->setSubject('demo', $this->head);
        $mailer->setBody($this->head, $this->body, $this->warning, $password);
        if (!$mailer->send()){
            throw new CHttpException(400, 'Error in sending email.');
            return false;
        }
        
        return true;
    }
}

?>