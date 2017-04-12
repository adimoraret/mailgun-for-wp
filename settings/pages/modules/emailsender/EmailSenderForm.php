<?php
/**
 * Created by PhpStorm.
 * User: Adi
 * Date: 4/9/2017
 * Time: 1:40 PM
 */

namespace MailGunApiForWp\settings\pages\modules\EmailSender {

    use MailGunApiForWp\settings\pages\modules\AdminBaseForm;
    use MailGunApiForWp\Settings\Pages\Modules\Options;
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
            add_action('wp_ajax_mgwp_test_configuration', array($this, 'sendEmail') );
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

        public function sendEmail(){
            $usedProtocol = Options::getSavedOptionsByFormSlug(Options::GeneralSettings_ProviderSettings);
            sleep(2);
            wp_send_json_success(
                array(
                    'data' => $usedProtocol,
                    'message' => 'Email was sent successfull'
                )
            );
            wp_die();
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
    }
}