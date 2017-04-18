<?php
/**
 * Created by PhpStorm.
 * User: Adi
 * Date: 4/13/2017
 * Time: 7:05 PM
 */

namespace MailGunApiForWp\utils\mailgun;

class MailMessage {

    private $from;
    private $fromName;
    private $to;
    private $cc;
    private $bcc;
    private $subject;
    private $message;
    private $isHtml;
    private $attachment;

    public function __construct($from, $fromName, $to, $cc, $bcc, $subject, $message, $isHtml, $attachment) {
        $this->from = $from;
        $this->fromName = $fromName;
        $this->to = $to;
        $this->cc = $cc;
        $this->bcc = $bcc;
        $this->subject = $subject;
        $this->message = $message;
        $this->isHtml = $isHtml;
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

    public function getIsHtml() {
        return $this->isHtml;
    }

    public function getAttachment() {
        return $this->attachment;
    }

    public function getFrom() {
        return $this->from;
    }

    public function getFromName() {
        return $this->fromName;
    }
}