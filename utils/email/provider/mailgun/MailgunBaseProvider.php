<?php
namespace MailGunApiForWp\Utils\Email\Provider\Mailgun {
    abstract class MailgunBaseProvider {
        public abstract function sendEmail();
        public abstract function IsValid();
        public abstract function getValidationMessage();
    }
}