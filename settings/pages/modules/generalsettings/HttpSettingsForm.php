<?php
/**
 * Created by PhpStorm.
 * User: Adi
 * Date: 3/27/2017
 * Time: 9:23 PM
 */

namespace MailGunApiForWp\settings\pages\modules\GeneralSettings {

    use MailGunApiForWp\settings\pages\modules\AdminBaseForm;
    use MailGunApiForWp\Settings\Pages\Modules\Options;
    use MailGunApiForWp\Utils\Wordpress\Page\Button\Button;
    use MailGunApiForWp\Utils\Wordpress\Page\Input\TextInput;

    class HttpSettingsForm extends AdminBaseForm {

        private $apiKey;
        private $domain;
        private $submitButton;

        public function __construct() {
            parent::__construct();
        }

        public function getName() {
            return "Http settings";
        }

        public function getInputs() {
            return array($this->apiKey, $this->domain);
        }

        public function getButtons() {
            return array($this->submitButton);
        }

        public function validateForm($formData) {
            return $formData;
        }

        public function getIconClass() {
            return "dashicons dashicons-admin-tools";
        }

        public function enqueueAjaxCalls() {
        }

        protected function initializeButtons() {
            $this->submitButton = new Button('button', 'saveHttpSettings', 'saveHttpSettings', 'Save changes', null);
        }

        protected function initializeInputs() {
            $this->apiKey = new TextInput('API Key', 'apikey', 'apikey', 'text', 'Mailgun api key', 'Your mailgun api key', '');
            $this->domain = new TextInput('Domain', 'domain', 'domain', 'text', 'Domain', 'Your domain (eg. yourwebsite.com)', '');
        }

        public function getSlug() {
            return Options::GeneralSettings_HttpSettings;
        }
    }
}