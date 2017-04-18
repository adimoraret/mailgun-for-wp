<?php
namespace MailGunApiForWp\Utils\Email\Provider\Mailgun {
    abstract class MailgunBaseProvider {
        const HOST_NAME = 'smtp.mailgun.org';

        public abstract function sendEmail();
        public abstract function IsValid();
        public abstract function getValidationMessage();
    }
}