<?php
namespace MailGunApiForWp\Settings\Pages\Modules\Tracking {

    use MailGunApiForWp\MailGunApiForWp;
    use MailGunApiForWp\Settings\Pages\Modules\AdminBasePage;
    use MailGunApiForWp\Utils\Wordpress\Page\Input\Input;

    class Tracking extends AdminBasePage{
        private $trackLinks;
        private $trackOpenEmail;

        public function __construct(){
            parent::__construct();
            $this->initializeInputs();
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
            return array($this->trackLinks
                ,$this->trackOpenEmail
            );
        }
        public function renderPage(){
            include_once  dirname(__FILE__) . DIRECTORY_SEPARATOR . 'partial_tracking.php';
        }

        private function initializeInputs() {
            $this->trackLinks = new Input('Track Links', 'tracklinks', 'tracklinks', 'checkbox', 'Tracking links', false, 1);
            $this->trackOpenEmail = new Input('Track Open Email', 'trackopen', 'trackopen', 'checkbox', 'Track open emails', false, 1);
        }

        public function validateForm($formData) {
            return $formData;
        }

        private function getSubmitButtonText(){
            return 'Save changes';
        }
    }
}