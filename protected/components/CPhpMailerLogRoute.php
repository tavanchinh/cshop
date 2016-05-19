<?php 
class CPhpMailerLogRoute extends CEmailLogRoute
{
    protected function sendEmail($email, $subject, $message)
    {
        $mail = new PHPMailer();
        $mail->IsSMTP();
        //$mail->SMTPDebug = true;
        $mail->Host = "smtp.gmail.com";
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = "tls";
        $mail->Port = 587;
        $mail->FromName = "[Bilutv.com] Warning"; 
        $mail->Username = "warning.bilutv@gmail.com";
        $mail->Password = "bilutv@123"; //best to keep this in your config file
        $mail->Subject = $subject;
        $mail->Body = $message;
        $mail->addAddress($email);
        
        //CVarDumper::dump($mail,10,true);die;
        //$mail->send();
    }
}
?>