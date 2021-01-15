<?php


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

$mail = new PHPMailer(true);                                      
    $mail->isSMTP();   
    $mail->CharSet="UTF-8";     
    $mail->Encoding='base64';
    $mail->SMTPSecure='ssl';
    $mail->Host='smtp.gmail.com';
    $mail->Port='465';
    $mail->isHTML();                                    
    $mail->SMTPAuth=true;                                   
    $mail->Username='gestao.sad9@gmail.com';                     
    $mail->Password='contaadminsad';                                                                                                    


    $mail->setFrom('gestao.sad9@gmail.com', 'Serviços de apoio Domiciliário');
       
?>