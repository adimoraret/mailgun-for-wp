<?php
namespace MailGunApiForWp\Utils\Email\Provider\Mailgun {
    class MailgunSmtpProvider extends MailgunBaseProvider {
        private $username;
        private $password;
        private $encryption;
        private $mailMessage;
        private $validationMessage = '';
        private $invalidEmail;

        function __construct($username,
                             $password,
                             $encryption,
                             $mailMessage) {
            $this->username = $username;
            $this->password = $password;
            $this->encryption = $encryption;
            $this->mailMessage = $mailMessage;
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

        public function getContentType(){
            if ($this->mailMessage->getIsHtml()){
                return 'text/html';
            }
            return 'text/plain';
        }

        private function validateRecipients() {
            $toRecipientsArray = $this->getRecipientsFromString($this->mailMessage->getTo());
            $ccRecipientsArray = $this->getRecipientsFromString($this->mailMessage->getCc());
            $bccRecipientsArray = $this->getRecipientsFromString($this->mailMessage->getBcc());
            if ($this->areAllEmpty($toRecipientsArray, $ccRecipientsArray, $bccRecipientsArray)) {
                $this->validationMessage .= 'No recipient found. ';
                return;
            }
            if ($this->hasInvalidEmail($toRecipientsArray, $ccRecipientsArray, $bccRecipientsArray)) {
                $this->validationMessage .= 'At least one invalid email address: ' . $this->invalidEmail . '. ';
                return;
            }
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

        private function validateSubject() {
            if (empty($this->mailMessage->getSubject())) {
                $this->validationMessage .= 'Subject is empty.';
            }
        }

        private function validateMessage() {
            if (empty($this->mailMessage->getMessage())) {
                $this->validationMessage .= 'Message is empty.';
            }
        }

        private function validateSmtpSettings(){
            if (empty($this->username)) {
                $this->validationMessage .= 'SMTP username not found.';
            }
            if (empty($this->password)) {
                $this->validationMessage .= '';
            }
        }

        private function areAllEmpty($toRecipientsArray, $ccRecipientsArray, $bccRecipientsArray) {
            return empty($toRecipientsArray) && empty($ccRecipientsArray) && empty($bccRecipientsArray);
        }

        private function hasInvalidEmail($toRecipientsArray, $ccRecipientsArray, $bccRecipientsArray) {
            return $this->containsInvalidEmail($toRecipientsArray)
                || $this->containsInvalidEmail($ccRecipientsArray)
                || $this->containsInvalidEmail($bccRecipientsArray);
        }

        private function containsInvalidEmail($recipientsArray) {
            foreach ($recipientsArray as $recipient) {
                if (!empty($recipient) && !$this->isValidEmailAddress($recipient)) {
                    $this->invalidEmail = $recipient;
                    return true;
                }
            }
            return false;
        }

        private function isValidEmailAddress($recipient) {
            return filter_var($recipient, FILTER_VALIDATE_EMAIL);
        }

        private function getRecipientsFromString($recipientsStr) {
            $recipientArray = explode(',', trim($recipientsStr));
            return array_filter($recipientArray, function ($element) {
                return !empty($element);
            });
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
