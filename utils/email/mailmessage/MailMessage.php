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
    private $attachment;

    public function __construct($to, $cc, $bcc, $subject, $message, $attachment) {
        $this->to = $to;
        $this->cc = $cc;
        $this->bcc = $bcc;
        $this->subject = $subject;
        $this->message = $message;
        $this->attachment = $attachment;
    }

    public function getTo() {
        return $this->to;
    }

    public function getCc() {
        return $this->cc;
    }

    public function getBcc() {
        return $this->bcc;
    }

    public function getSubject() {
        return $this->subject;
    }

    public function getMessage() {
        return $this->message;
    }

    public function getAttachment() {
        return $this->attachment;
    }
}