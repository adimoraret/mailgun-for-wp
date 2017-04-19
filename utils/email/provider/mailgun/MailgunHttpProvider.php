<?php
namespace MailGunApiForWp\Utils\Email\Provider\Mailgun {
    class MailgunHttpProvider extends MailgunBaseProvider {

        public function __construct($from, $fromName) {
            parent::__construct($from, $fromName);
        }

        public function sendEmail($mailMessage) {
        }

        public function IsValid($mailMessage) {
            return false;
        }

        public function getValidationMessage() {
            return "Error in MailgunHttpProvider";
        }
    }
}