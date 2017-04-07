<?php
namespace MailGunApiForWp\Settings\Pages\Modules\GeneralSettings {

    use MailGunApiForWp\MailGunApiForWp;
    use MailGunApiForWp\Settings\Pages\Modules\AdminBasePage;
    use ProviderSettingsForm;

    class GeneralSettings extends AdminBasePage {

        private $httpSettingsForm;
        private $smtpSettingsForm;
        private $providerSettingsForm;

        public function __construct() {
            parent::__construct();
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

        public function enqueuePageScriptsAndStyles() {
            wp_enqueue_script('mgwp-general-settings-script', plugins_url('/generalsettings.js', __FILE__));
            wp_enqueue_style('mgwp-general-settings-style', plugins_url('/generalsettings.css', __FILE__));
        }

        public function getForms() {
            return array($this->httpSettingsForm, $this->smtpSettingsForm, $this->providerSettingsForm);
        }

        protected function initializeForms() {
            $this->httpSettingsForm = new HttpSettingsForm();
            $this->smtpSettingsForm = new SmtpSettingsForm();
            $this->providerSettingsForm = new ProviderSettingsForm();
        }
    }
}