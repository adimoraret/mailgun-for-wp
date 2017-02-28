<?php
namespace MailGunApiForWp\Settings\Pages\Modules\GeneralSettings {
    class GeneralSettings extends \MailGunApiForWp\Settings\Pages\Modules\AdminBasePage{
        private $nameInput;
        private $addressInput;
        private $passwordInput;

        public function __construct(){
            parent::__construct();
            $this->nameInput = new \MailGunApiForWp\Settings\Pages\Input\Input('Name', 'text', 'To the do the best', 'Here is the name', true);
            $this->addressInput = new \MailGunApiForWp\Settings\Pages\Input\Input('Address', 'textarea', 'Where is not what', 'Here is the address', false);
            $this->passwordInput =  new \MailGunApiForWp\Settings\Pages\Input\Input('Email', 'email', 'One email is never enough', 'Enter email', false);
        }

        public function getSlug() {
            return \MailGunApiForWp\MailGunApiForWp::PLUGIN_SHORT_CODE . '-' . 'pg-1';
        }
        public function getTitle(){
            return 'MailGun 4 WP';
        }
        public function getBrowserTitle(){
            return 'MailGun for Wordpress';
        }

        public function getInputs(){
            return array($this->nameInput, $this->addressInput, $this->passwordInput);
        }

        public function renderPage(){
            include_once  dirname(__FILE__) . DIRECTORY_SEPARATOR . 'partial_general_settings.php';
        }

        public function validateForm($formData){
            $nameInputValue = $formData[$this->nameInput->getName()];
        }

        private function getSubmitButtonText(){
            return 'Save changes';
        } 
    }
}