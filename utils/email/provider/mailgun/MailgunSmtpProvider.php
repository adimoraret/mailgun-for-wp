<?php
namespace MailGunApiForWp\Utils\Email\Provider\Mailgun {
    class MailgunSmtpProvider extends MailgunBaseProvider {
        private $username;
        private $password;
        private $encryption;

        function __construct($username,
                             $password,
                             $encryption,
                             $mailMessage) {
            parent::__construct($mailMessage);
            $this->username = $username;
            $this->password = $password;
            $this->encryption = $encryption;
        }

        public function sendEmail() {
            $this->setWordpressEmailFilters();
            $response = wp_mail($this->mailMessage->getTo(), $this->mailMessage->getSubject(), $this->mailMessage->getMessage());
            $this->resetWordpressEmailFilters();
            return $response;
        }

        public function IsValid() {
            $this->validateRecipients();
            $this->validateSubject();
            $this->validateMessage();
            $this->validateSmtpSettings();
            return $this->validationMessage === '';
        }

        public function getValidationMessage() {
            return $this->validationMessage;
        }

        public function setPhpMailerConfiguration($phpMailer) {
            $phpMailer->Mailer = 'smtp';
            $phpMailer->Sender = $this->mailMessage->getFrom();
            $phpMailer->From = $this->mailMessage->getFrom();
            $phpMailer->FromName = $this->mailMessage->getFromName();
            $phpMailer->Host = self::HOST_NAME;
            $phpMailer->SMTPAuth = true;
            $phpMailer->Username = $this->username;
            $phpMailer->Password = $this->password;
            $phpMailer->SMTPSecure = $this->encryption;
            $phpMailer->Port = $this->getPort($this->encryption);
        }

        private function getPort($encryption){
            switch ($encryption) {
                case '' : return 25;
                case 'ssl': return 465;
                case 'tls': return 587;
                case 'tls_2525': return 2525;
                default: return 25;
            }
        }

        private function validateSmtpSettings(){
            if (empty($this->username)) {
                $this->validationMessage .= 'SMTP username not found.';
            }
            if (empty($this->password)) {
                $this->validationMessage .= 'SMTP password not found.';
            }
            if (empty($this->encryption)) {
                $this->validationMessage .= 'No encryption method selected.';
            }
        }

        private function setWordpressEmailFilters() {
            $this->setContentType();
            $this->setPhpMailerAction();
        }

        private function resetWordpressEmailFilters() {
            $this->resetContentType();
            $this->resetPhpMailerAction();
        }

        private function setContentType() {
            add_filter('wp_mail_content_type', array($this, 'getContentType'));
        }

        private function resetContentType() {
            remove_filter('wp_mail_content_type', array($this, 'getContentType'));
        }

        private function setPhpMailerAction() {
            add_action('phpmailer_init', array($this, 'setPhpMailerConfiguration'));
        }

        private function resetPhpMailerAction() {
            remove_action('phpmailer_init', array($this, 'setPhpMailerConfiguration'));
        }
    }
}
