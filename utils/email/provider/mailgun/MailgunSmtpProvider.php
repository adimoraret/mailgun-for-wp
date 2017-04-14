<?php
namespace MailGunApiForWp\Utils\Email\Provider\Mailgun {
    class MailgunSmtpProvider extends MailgunBaseProvider {
        const HOST_NAME = 'smtp.mailgun.com';
        private $username;
        private $password;
        private $mailMessage;

        function __construct($username,
                             $password,
                             $mailMessage) {
            $this->username = $username;
            $this->password = $password;
            $this->mailMessage = $mailMessage;
        }

        public function sendEmail() {
            wp_mail(
                $this->mailMessage->to,
                $this->mailMessage->subject,
                $this->mailMessage->message);
        }

        public function IsValid() {
            return false;
        }

        public function getValidationMessage() {
            return 'Error in MailgunSmtpProvider';
        }
    }
}