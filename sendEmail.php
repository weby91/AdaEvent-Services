<?php
require 'PHPMailer_5.2.0/PHPMailer_5.2.0/PHPMailerAutoload.php';
$email = 'webster.tulai@modalku.co.id';                    
                    $password = 'powerranger';
                    $to_id = 'lebronwebz@gmail.com';
                    $message = 'test';

                    $mail = new PHPMailer;

                    $mail->isSMTP();

                    $mail->Host = 'smtp.gmail.com';

                    $mail->Port = 587;

                    $mail->SMTPSecure = 'tls';

                    $mail->SMTPAuth = true;

                    $mail->Username = $email;

                    $mail->Password = $password;

                    $mail->setFrom('webster.tulai@modalku.co.id', 'AdaEvent Email Notifier');

                    $mail->addAddress($to_id);

                    $mail->Subject = $subjects;

                    $mail->msgHTML($message);

$mail->send();

                    

?>
