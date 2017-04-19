<?php
namespace MailGunApiForWp\Utils\Email\Provider\Mailgun {
    abstract class MailgunBaseProvider {
        const HOST_NAME = 'smtp.mailgun.org';
        protected $from;
        protected $fromName;
        protected $isHtml;
        protected $contentType;
        protected $invalidEmail;
        protected $validationMessage = '';


        public abstract function sendEmail($mailMessage);
        public abstract function IsValid($mailMessage);
        public abstract function getValidationMessage();

        public function addFrom($from, $fromName){
            $this->from = $from;
            $this->fromName = $fromName;
        }

        public function setIsHtml($isHtml){
            $this->isHtml = $isHtml;
        }

        public function getContentType(){
            if ($this->contentType){
                return 'text/html';
            }
            return 'text/plain';
        }

        protected function validateRecipients($mailMessage) {
            $toRecipientsArray = $this->getRecipientsFromString($mailMessage->getTo());
            $ccRecipientsArray = $this->getRecipientsFromString($mailMessage->getCc());
            $bccRecipientsArray = $this->getRecipientsFromString($mailMessage->getBcc());
            if ($this->areAllEmpty($toRecipientsArray, $ccRecipientsArray, $bccRecipientsArray)) {
                $this->validationMessage .= 'No recipient found. ';
                return;
            }
            if ($this->hasInvalidEmail($toRecipientsArray, $ccRecipientsArray, $bccRecipientsArray)) {
                $this->validationMessage .= 'At least one invalid email address: ' . $this->invalidEmail . '. ';
                return;
            }
        }

        protected function validateSubject($mailMessage) {
            if (empty($mailMessage->getSubject())) {
                $this->validationMessage .= 'Subject is empty.';
            }
        }

        protected function validateMessage($mailMessage) {
            if (empty($mailMessage->getMessage())) {
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