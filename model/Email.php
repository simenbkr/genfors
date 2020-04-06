<?php


namespace genfors;


class Email
{
    public static function sendEmail(string $title, string $content, string $receiver) {

        $mail = new \SendGrid\Mail\Mail();
        $mail->setFrom(MAIL_FROM, "Genfors Voting");
        $mail->setSubject($title);
        $mail->addTo($receiver);
        $mail->addContent("text/plain", $content);
        $mail->addContent("text/html", $content);

        $sendgrid = new \SendGrid(SEND_GRID_API_KEY);

        try {
            $response = $sendgrid->send($mail);
        } catch(\Exception $e) {
            error_log("Failed sending email - {$e->getMessage()} --- {$e->getTraceAsString()}");
        }
    }
}