<?php
/**
 * Created by PhpStorm.
 * User: Adi
 * Date: 3/27/2017
 * Time: 10:52 PM
 */

namespace MailGunApiForWp\settings\pages\modules\GeneralSettings {

    use MailGunApiForWp\settings\pages\modules\AdminBaseForm;
    use MailGunApiForWp\Settings\Pages\Modules\Options;
    use MailGunApiForWp\Utils\Wordpress\Page\Button\Button;
    use MailGunApiForWp\Utils\Wordpress\Page\Input\RadioButton;
    use MailGunApiForWp\Utils\Wordpress\Page\Input\RadioButtonGroup;
    use MailGunApiForWp\Utils\Wordpress\Page\Input\TextInput;

    class SmtpSettingsForm extends AdminBaseForm {

        private $username;
        private $password;
        private $encryption;
        private $submitButton;

        function __construct() {
            parent::__construct();
        }

        public function getName() {
            return "Smtp settings";
        }

        public function enqueueAjaxCalls() {
        }

        public function getButtons() {
            return array($this->submitButton);
        }

        public function getInputs() {
            return array($this->username, $this->password, $this->encryption);
        }

        public function validateForm($formData) {
            return $formData;
        }

        public function getSlug() {
            return Options::GeneralSettings_SmtpSettings;
        }

        public function getIconClass() {
            return "dashicons dashicons-admin-tools mirror";
        }

        protected function initializeButtons() {
            $this->submitButton = new Button('button', 'saveSmtpSettings', 'saveSmtpSettings', 'Save changes', null);
        }

        protected function initializeInputs() {
            $this->username = new TextInput('Username', 'username', 'username', 'text', 'Mailgun smtp username', 'Your mailgun smtp username', '');
            $this->password = new TextInput('Password', 'password', 'password', 'password', 'Mailgun smtp passowrd', 'Your mailgun smtp password', '');
            $encrypts = array(
                new RadioButton('None', 'encryption', 'no_encryption', 'radio', 'No encryption', false, ''),
                new RadioButton('SSL', 'encryption', 'ssl_encryption', 'radio', 'SSL encryption', false, 'ssl'),
                new RadioButton('TLS', 'encryption', 'tls_encryption', 'radio', 'TLS encryption', false, 'tls'),
                new RadioButton('TLS 2525', 'encryption', 'tls_2525_encryption', 'radio', 'TLS encryption', false, 'tls_2525')
            );
            $this->encryption = new RadioButtonGroup('Encryption', $encrypts);
        }
    }
}