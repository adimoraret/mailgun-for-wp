<?php
namespace MailGunApiForWp\Utils\Email\Provider\Mailgun {
    abstract class MailgunBaseProvider {
        const HOST_NAME = 'smtp.mailgun.org';
        protected $invalidEmail;
        protected $validationMessage = '';
        protected $mailMessage;

        function __construct($mailMessage) {
            $this->mailMessage = $mailMessage;
        }

        public abstract function sendEmail();
        public abstract function IsValid();
        public abstract function getValidationMessage();

        public function getContentType(){
            if ($this->mailMessage->getIsHtml()){
                return 'text/html';
            }
            return 'text/plain';
        }

        protected function validateRecipients() {
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

        protected function validateSubject() {
            if (empty($this->mailMessage->getSubject())) {
                $this->validationMessage .= 'Subject is empty.';
            }
        }

        protected function validateMessage() {
            if (empty($this->mailMessage->getMessage())) {
                $this->validationMessage .= 'Message is empty.';
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
    }
}