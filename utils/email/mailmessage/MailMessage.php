<?php
/**
 * Created by PhpStorm.
 * User: Adi
 * Date: 4/13/2017
 * Time: 7:05 PM
 */

namespace MailGunApiForWp\utils\mailgun;


class MailMessage {

    private $to;
    private $cc;
    private $bcc;
    private $subject;
    private $message;
    private $isHtml;
    private $attachment;

    public function __construct($to, $cc, $bcc, $subject, $message, $isHtml, $attachment) {
        $this->to = $to;
        $this->cc = $cc;
        $this->bcc = $bcc;
        $this->subject = $subject;
        $this->message = $message;
        $this->isHtml = $isHtml;
        $this->attachment = $attachment;
    }

}