<?php
/**
 * Created by PhpStorm.
 * User: Adi
 * Date: 4/9/2017
 * Time: 1:40 PM
 */

namespace MailGunApiForWp\settings\pages\modules\EmailSender {

    use MailGunApiForWp\settings\pages\modules\AdminBaseForm;
    use MailGunApiForWp\Utils\Wordpress\Page\Button\Button;
    use MailGunApiForWp\Utils\Wordpress\Page\Input\TextInput;

    class EmailSenderForm extends AdminBaseForm {

        private $submitButton;
        private $toEmail;
        private $message;
        private $isHtml;

        function __construct() {
            parent::__construct();
        }

        public function getId() {
            return "mgwp-email-sender";
        }

        public function getName() {
            return "Send a test email with Mailgun";
        }

        public function enqueueAjaxCalls() {
        }

        public function getButtons() {
            return array($this->submitButton);
        }

        public function getInputs() {
           return array($this->toEmail, $this->message, $this->isHtml);
        }

        public function validateForm($formData) {
            return $formData;
        }

        public function getIconClass() {
            return "dashicons dashicons-format-status";
        }

        protected function getSlug() {
            return "email-sender";
        }

        protected function initializeInputs() {
            $this->toEmail = new TextInput('To', 'to', 'to', 'text', 'To', 'To', '');
            $this->isHtml = new TextInput('Is Html', 'isHtml', 'isHtml', 'text', 'Is Html', 'Is Html', '');
            $this->message = new TextInput('Message', 'message', 'message', 'email', 'Message', 'Message', '');
        }

        protected function initializeButtons() {
            $this->submitButton = new Button('button', 'emailSender', 'emailSender', 'Send email', null);
        }
    }
}