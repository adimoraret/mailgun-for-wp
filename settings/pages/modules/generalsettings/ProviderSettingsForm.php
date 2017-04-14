<?php

namespace MailGunApiForWp\settings\pages\modules\GeneralSettings {

    use MailGunApiForWp\settings\pages\modules\AdminBaseForm;
    use MailGunApiForWp\Settings\Pages\Modules\Options;
    use MailGunApiForWp\Utils\Wordpress\Page\Button\Button;
    use MailGunApiForWp\Utils\Wordpress\Page\Input\RadioButton;
    use MailGunApiForWp\Utils\Wordpress\Page\Input\RadioButtonGroup;

    /**
     * Created by PhpStorm.
     * User: Adi
     * Date: 4/5/2017
     * Time: 11:30 PM
     */
    class ProviderSettingsForm extends AdminBaseForm {
        const HTTP_PROVIDER = '0';
        const SMTP_PROVIDER = '1';
        private $submitButton;
        private $selectedProvider;

        function __construct() {
            parent::__construct();
        }

        public function getName() {
            return "Select Mailgun send method";
        }

        public function enqueueAjaxCalls() {
        }

        public function getButtons() {
            return array($this->submitButton);
        }

        public function getInputs() {
            return array($this->selectedProvider);
        }

        public function validateForm($formData) {
            return $formData;
        }

        public function getIconClass() {
            return "dashicons dashicons-pressthis";
        }

        public function getSlug() {
            return Options::GeneralSettings_ProviderSettings;
        }

        protected function initializeInputs() {
            $radioButtons = array(
                new RadioButton('Http', 'selectedProvider', 'httpProvider', 'radio', 'Http Provider', false, self::HTTP_PROVIDER),
                new RadioButton('Smtp', 'selectedProvider', 'smtpProvider', 'radio', 'Smtp Provider', false, self::SMTP_PROVIDER)
            );
            $this->selectedProvider = new RadioButtonGroup('Sending method', $radioButtons);
        }

        protected function initializeButtons() {
            $this->submitButton = new Button('button', 'saveProviderSettings', 'saveProviderSettings', 'Save changes', null);
        }
    }
}