<?php
namespace MailGunApiForWp\Utils\Email\Provider\Mailgun {
    class MailgunHttpProvider extends MailgunBaseProvider {

        public function sendEmail() {
        }

        public function IsValid() {
            return false;
        }

        public function getValidationMessage() {
            return "Error in MailgunHttpProvider";
        }
    }
}