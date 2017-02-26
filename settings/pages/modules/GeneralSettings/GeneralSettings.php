<?php
namespace MailGunApiForWp\Settings\Pages\Modules\GeneralSettings {
    class GeneralSettings extends \MailGunApiForWp\Settings\Pages\Modules\AdminBasePage{
        public function getSlug() {
            return 'mgwp-pg-1';
        }
        public function getTitle(){
            return 'MailGun 4 WP';
        }
        public function getBrowserTitle(){
            return 'MailGun for Wordpress';
        }

        public function getInputs(){
            return array(
                new \MailGunApiForWp\Settings\Pages\Input\Input('Name', 'text', 'To the do the best', 'Here is the name', true),
                new \MailGunApiForWp\Settings\Pages\Input\Input('Address', 'textarea', 'Where is not what', 'Here is the address', false),
                new \MailGunApiForWp\Settings\Pages\Input\Input('Password', 'password', 'One password is never enough', 'Enter password', false),
            );
        }

        public function renderPage(){
            include_once  dirname(__FILE__) . DIRECTORY_SEPARATOR . 'partial_general_settings.php';
        }


        protected function validateForm(){

        }

        private function getSubmitButtonText(){
            return 'Save changes';
        } 
    }
}