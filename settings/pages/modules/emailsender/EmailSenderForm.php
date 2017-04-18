<?php
/**
 * Created by PhpStorm.
 * User: Adi
 * Date: 4/9/2017
 * Time: 1:40 PM
 */

namespace MailGunApiForWp\settings\pages\modules\EmailSender {

    use MailGunApiForWp\settings\pages\modules\AdminBaseForm;
    use MailGunApiForWp\settings\pages\modules\GeneralSettings\ProviderSettingsForm;
    use MailGunApiForWp\Settings\Pages\Modules\Options;
    use MailGunApiForWp\Utils\Email\Provider\Mailgun\MailgunHttpProvider;
    use MailGunApiForWp\Utils\Email\Provider\Mailgun\MailgunSmtpProvider;
    use MailGunApiForWp\utils\mailgun\MailMessage;
    use MailGunApiForWp\Utils\Wordpress\Page\Button\Button;
    use MailGunApiForWp\Utils\Wordpress\Page\Input\TextArea;
    use MailGunApiForWp\Utils\Wordpress\Page\Input\TextInput;

    class EmailSenderForm extends AdminBaseForm {

        private $sendEmailButton;
        private $toEmail;
        private $ccEmail;
        private $bccEmail;
        private $subject;
        private $message;

        function __construct() {
            parent::__construct();
        }

        public function getName() {
            return "Send message";
        }

        public function enqueueAjaxCalls() {
            add_action('wp_ajax_mgwp_test_configuration', array($this, 'sendEmail'));
        }

        public function getButtons() {
            return array($this->sendEmailButton);
        }

        public function getInputs() {
            return array($this->toEmail, $this->ccEmail, $this->bccEmail, $this->subject, $this->message);
        }

        public function validateForm($formData) {
            return $formData;
        }

        public function getIconClass() {
            return "dashicons dashicons-format-status";
        }

        public function sendEmail() {
            $providers = Options::getSavedOptionsByFormSlug(Options::GeneralSettings_ProviderSettings);
            $this->validateProviderIsSet($providers);
            $selectedProvider = $providers['selectedProvider'];
            $mailMessage = $this->createMailMessage();
            $mailgunProvider = $this->getMailgunProvider($selectedProvider, $mailMessage);
            $this->validateProviderIsValid($mailgunProvider);
            $isSent = $mailgunProvider->sendEmail();
            $this->validateEmailIsSent($isSent);
            $this->createSuccessResponse('Email was sent successfully');
        }

        private function createSuccessResponse($message) {
            wp_send_json_success(array('message' => $message));
            wp_die();
        }

        private function createErrorResponse($message) {
            wp_send_json_error(array('message' => $message));
            wp_die();
        }

        private function getMailgunProvider($selectedProvider, $mailMessage) {
            if ($selectedProvider == ProviderSettingsForm::HTTP_PROVIDER) {
                return new MailgunHttpProvider();
            }
            return $this->createMailgunSmtpProvider($mailMessage);
        }


        public function getSlug() {
            return Options::EmailSenderSettings_SendSettings;
        }

        protected function initializeInputs() {
            $this->toEmail = new TextInput('To', 'to', 'to', 'email', 'To', 'To', '');
            $this->ccEmail = new TextInput('Cc', 'cc', 'cc', 'email', 'Cc', 'Cc', '');
            $this->bccEmail = new TextInput('Bcc', 'bcc', 'bcc', 'email', 'Bcc', 'Bcc', '');
            $this->subject = new TextInput('Subject', 'subject', 'subject', 'text', 'Subject', 'Subject', '');
            $this->message = new TextArea('', 'message', 'message', 'textarea', 'Message', 'Write your email here', '');
        }


        protected function initializeButtons() {
            $this->sendEmailButton = new Button('button', 'emailSender', 'emailSender', 'Send email', null);
        }

        private function validateProviderIsSet($providerSettings) {
            if (!empty($providerSettings)) return;
            $this->createErrorResponse('Please select a sending method in Configuration page');
            die();
        }

        private function validateProviderIsValid($mailgunProvider) {
            if (!$mailgunProvider->IsValid()) {
                $this->createErrorResponse($mailgunProvider->getValidationMessage());
            }
        }

        private function validateEmailIsSent($isSent) {
            if (!$isSent) {
                $this->createErrorResponse('Unable to send email. Mailgun response: ' . $isSent);
            }
        }

        private function createMailMessage() {
            $from = 'adrian.moraret@codetrest.com';
            $fromName = 'Adrian Moraret';
            $formData = wp_kses_post($_POST[Options::EmailSenderSettings_SendSettings]);
            $to = $formData[$this->toEmail->getName()];
            $cc = $formData[$this->ccEmail->getName()];
            $bcc = $formData[$this->bccEmail->getName()];
            $subject = $formData[$this->subject->getName()];
            $message = $formData[$this->message->getName()];
            $isHtml = true;
            $attachments = null;
            return new MailMessage($from, $fromName, $to, $cc, $bcc, $subject, $message, $isHtml, $attachments);
        }

        private function createMailgunSmtpProvider($mailMessage){
            $smtpSettings = Options::getSavedOptionsByFormSlug(Options::GeneralSettings_SmtpSettings);
            $username = $smtpSettings['username'];
            $password = $smtpSettings['password'];
            $port = $smtpSettings['port'];
            return new MailgunSmtpProvider($username, $password, $port, $mailMessage);
        }
    }
}