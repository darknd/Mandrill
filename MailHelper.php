<?php

use MailHandler;

class MailHelper {

       public function sendMail($content, $type, $subject, $from, $name, $addCC = null, $addBCC = null)
        {
            $mail = new MailHandler();
            $mail->setContent($content,$type);
            $mail->setSubject($subject);
            $mail->setFrom($from, $name);

            if (!empty($addCC))
            {
                foreach ($addCC as $key)
                {
                    $mail->addCC($key['email'],$key['name'] );
                }

            }

            if (!empty($addBCC)) {
                foreach ($addCC as $key)
                {
                    $mail->addBCC($key['email'], $key['name']);
                }
            }

            $mail->send();
        }
}
