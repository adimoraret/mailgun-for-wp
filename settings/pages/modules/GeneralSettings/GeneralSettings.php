<?php
namespace MailGunApiForWp\Settings\Pages\Modules\GeneralSettings {
    class GeneralSettings extends \MailGunApiForWp\Settings\Pages\Modules\AdminBasePage {

        public function __construct() {
            parent::__construct();
        }

        public function getSlug() {
            return \MailGunApiForWp\MailGunApiForWp::PLUGIN_SHORT_CODE . '-' . 'pg-1';
        }
        public function getTitle() {
            return 'MailGun 4 WP';
        }
        public function getBrowserTitle() {
            return 'MailGun for Wordpress';
        }

        public function renderPage() {
            include_once  dirname(__FILE__) . DIRECTORY_SEPARATOR . 'partial_general_settings.php';
        }

        public function validateForm($formData) {
            return $formData;
        }

        private function getInputs() {
            return array(
                new \MailGunApiForWp\Settings\Pages\Input\RadioButtonGroup('Email send method', array(
                    new \MailGunApiForWp\Settings\Pages\Input\RadioButton('Http', 'sendmethod', 'httpmethod', 'radio', 'Send emails via HTTP calls', true, true, 0),
                    new \MailGunApiForWp\Settings\Pages\Input\RadioButton('Smtp', 'sendmethod', 'smtpmethod', 'radio', 'Send emails via SMTP calls', false, true, 1))
                ),
                new \MailGunApiForWp\Settings\Pages\Input\TextInput('Domain Name', 'domainname', 'domainname', 'text', 'Mailgun domain name', 'Your mailgun domain name', true, ''),
                new \MailGunApiForWp\Settings\Pages\Input\TextInput('API Key', 'apikey', 'apikey', 'text', 'Mailgun api key', 'Your mailgun api key', true, ''),
                new \MailGunApiForWp\Settings\Pages\Input\TextInput('From address', 'fromaddress', 'fromaddress', 'email', 'From email address', 'Your from email address', true, ''),
                new \MailGunApiForWp\Settings\Pages\Input\TextInput('From name', 'fromname', 'fromname', 'text', 'From name', 'Your from name', true, '')
            );
        }

        private function getSubmitButtonText() {
            return 'Save changes';
        }
    }
}