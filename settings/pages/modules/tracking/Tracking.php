<?php
namespace MailGunApiForWp\Settings\Pages\Modules\Tracking {

    use MailGunApiForWp\MailGunApiForWp;
    use MailGunApiForWp\Settings\Pages\Modules\AdminBasePage;
    use MailGunApiForWp\Utils\Wordpress\Page\Button\Button;
    use MailGunApiForWp\Utils\Wordpress\Page\Input\Input;

    class Tracking extends AdminBasePage{
        private $trackLinks;
        private $trackOpenEmail;
        private $submitButton;

        public function __construct(){
            parent::__construct();
            $this->initializeInputs();
            $this->initializeButtons();
        }
        public function getSlug() {
            return MailGunApiForWp::PLUGIN_SHORT_CODE . '-' . 'pg-2';
        }
        public function getTitle(){
            return 'Email Tracking';
        }
        public function getBrowserTitle(){
            return 'Email Tracking';
        }
        public function getInputs(){
            return array($this->trackLinks, $this->trackOpenEmail);
        }
        public function renderPage(){
            include_once dirname(__FILE__) . DIRECTORY_SEPARATOR . 'partial_tracking.php';
        }

        private function initializeInputs() {
            $this->trackLinks = new Input('Track Links', 'tracklinks', 'tracklinks', 'checkbox', 'Tracking links', false, 1);
            $this->trackOpenEmail = new Input('Track Open Email', 'trackopen', 'trackopen', 'checkbox', 'Track open emails', false, 1);
        }

        public function validateForm($formData) {
            return $formData;
        }

        private function initializeButtons() {
            $this->submitButton = new Button('submit', 'submit', 'submit', 'button button-primary', 'Save changes', null);
        }

        private function getButtons() {
            return array($this->submitButton);
        }

        public function enqueueAjaxCalls(){}

        public function enqueuePageScriptsAndStyles() {}
    }
}