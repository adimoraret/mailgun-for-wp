<?php

namespace MailGunApiForWp\Settings\Pages\Modules\EmailSender {

    use MailGunApiForWp\MailGunApiForWp;
    use MailGunApiForWp\Settings\Pages\Modules\AdminBasePage;

    class EmailSender extends AdminBasePage {

        private $emailSenderForm;

        public function __construct() {
            parent::__construct();
        }

        public function getForms() {
            return array($this->emailSenderForm);
        }

        public function enqueuePageScriptsAndStyles() {
            wp_enqueue_script('mgwp-general-settings-script', plugins_url('/emailsender.js', __FILE__));
            wp_enqueue_style('mgwp-general-settings-style', plugins_url('/emailsender.css', __FILE__));
        }

        public function getSlug() {
            return MailGunApiForWp::PLUGIN_SHORT_CODE . '-' . 'emailsender';
        }

        public function getTitle() {
           return 'Test email';
        }

        public function renderPage() {
            include_once dirname(__FILE__) . DIRECTORY_SEPARATOR . 'partia_email_sender.php';
        }

        protected function getBrowserTitle() {
            return 'Send Email';
        }

        protected function initializeForms() {
            $this->emailSenderForm = new EmailSenderForm();
        }
    }
}