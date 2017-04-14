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

        private $domainName;
        private $username;
        private $password;
        private $port;
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
            return array($this->domainName, $this->username, $this->password, $this->port);
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
            $this->domainName = new TextInput('Domain Name', 'domainname2', 'domainname2', 'text', 'Mailgun domain name', 'Your mailgun domain name', '');
            $this->username = new TextInput('Username', 'username', 'username', 'text', 'Mailgun smtp username', 'Your mailgun smtp username', '');
            $this->password = new TextInput('Password', 'password', 'password', 'password', 'Mailgun smtp passowrd', 'Your mailgun smtp password', '');
            $ports = array(
                new RadioButton('25', 'port', 'port25', 'radio', 'Port 25', false, '0'),
                new RadioButton('465 SSL/TLS', 'port', 'port465', 'radio', 'Port 465 (SSL/TLS)', false, '1'),
                new RadioButton('587 STARTTLS', 'port', 'port587', 'radio', 'Port 587 (STARTTLS)', false, '2'),
                new RadioButton('2525', 'port', 'port2525', 'radio', 'Port 2525', false, '3'),
            );
            $this->port = new RadioButtonGroup('Port', $ports);
        }
    }
}