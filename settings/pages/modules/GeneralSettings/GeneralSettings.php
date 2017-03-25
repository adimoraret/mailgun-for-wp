<?php
namespace MailGunApiForWp\Settings\Pages\Modules\GeneralSettings {

    use MailGunApiForWp\MailGunApiForWp;
    use MailGunApiForWp\Settings\Pages\Modules\AdminBasePage;
    use MailGunApiForWp\Utils\Wordpress\Page\Button\Button;
    use MailGunApiForWp\Utils\Wordpress\Page\Input\RadioButton;
    use MailGunApiForWp\Utils\Wordpress\Page\Input\RadioButtonGroup;
    use MailGunApiForWp\Utils\Wordpress\Page\Input\TextInput;

    class GeneralSettings extends AdminBasePage {

        private $radioButtonGroup;
        private $domainName;
        private $apiKey;
        private $fromAddress;
        private $fromName;
        private $submitButton;
        private $testConfigurationButton;

        public function __construct() {
            parent::__construct();
            $this->initializeInputs();
            $this->initializeButtons();
        }

        public function getSlug() {
            return MailGunApiForWp::PLUGIN_SHORT_CODE . '-' . 'pg-1';
        }

        public function getTitle() {
            return 'MailGun 4 WP';
        }

        public function getBrowserTitle() {
            return 'MailGun for Wordpress';
        }

        public function renderPage() {
            include_once dirname(__FILE__) . DIRECTORY_SEPARATOR . 'partial_general_settings.php';
        }

        public function validateForm($formData) {
            return $formData;
        }

        private function initializeInputs() {
            $this->radioButtonGroup = new RadioButtonGroup('Email send method', array(
                    new RadioButton('Http', 'sendmethod', 'httpmethod', 'radio', 'Send emails via HTTP calls', true, true, 0),
                    new RadioButton('Smtp', 'sendmethod', 'smtpmethod', 'radio', 'Send emails via SMTP calls', false, true, 1))
            );
            $this->domainName = new TextInput('Domain Name', 'domainname', 'domainname', 'text', 'Mailgun domain name', 'Your mailgun domain name', true, '');
            $this->apiKey = new TextInput('API Key', 'apikey', 'apikey', 'text', 'Mailgun api key', 'Your mailgun api key', true, '');
            $this->fromAddress = new TextInput('From address', 'fromaddress', 'fromaddress', 'email', 'From email address', 'Your from email address', true, '');
            $this->fromName = new TextInput('From name', 'fromname', 'fromname', 'text', 'From name', 'Your from name', true, '');
        }

        private function getInputs() {
            return array($this->radioButtonGroup,
                $this->domainName,
                $this->apiKey,
                $this->fromAddress,
                $this->fromName
            );
        }

        private function initializeButtons() {
            $this->submitButton = new Button('submit', 'submit', 'submit', 'button button-primary', 'Save changes', null);
            $this->testConfigurationButton = new Button('button', 'testconfiguration', 'testconfiguration', '', 'Test Configuration', null);
        }

        private function getButtons() {
            return array($this->submitButton, $this->testConfigurationButton);
        }

        public function enqueuePageScriptsAndStyles() {
            wp_enqueue_script('mgwp-general-settings-script', plugins_url('/generalsettings.js', __FILE__));
            wp_enqueue_style('mgwp-general-settings-style', plugins_url('/generalsettings.css', __FILE__));
        }

        public function enqueueAjaxCalls() {
            add_action('wp_ajax_mgwp_test_configuration', array($this, 'testConfiguration'));
        }

        public function testConfiguration() {
            sleep(2);
            wp_send_json_success(
                array(
                    'message' => 'Email was sent successfull'
                )
            );
            wp_die();
        }


    }
}