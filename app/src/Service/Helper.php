<?php
/**
 * Created by PhpStorm.
 * User: hizbul
 * Date: 5/25/15
 * Time: 9:39 PM
 */

namespace Module\Service;

use PHPMailer;

class Helper {

    public static function sendMail($arrEmail){
        $mail = new \PHPMailer();
        $mailConfig = require ROOT_DIR . 'config/mail.php';
        $mail->isSMTP();
        $mail->Host = $mailConfig['host'];
        $mail->SMTPAuth = $mailConfig['auth'];
        $mail->Username = $mailConfig['username'];
        $mail->Password = $mailConfig['password'];
        $mail->SMTPSecure = $mailConfig['secret'];
        $mail->Port = $mailConfig['port'];

        $mail->From('no-reply@hizbul.com');
        $mail->addAddress($arrEmail['email']);
        $mail->Subject($arrEmail['subject']);
        $mail->Body($arrEmail['body']);
        dd($mail->send());
        if($mail->send()) {
            return true;
        }
        return false;
    }

}