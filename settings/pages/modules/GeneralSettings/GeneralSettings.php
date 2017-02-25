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
        protected function getPartialFile(){
            return dirname(__FILE__) . DIRECTORY_SEPARATOR . 'partial_general_settings.php';
        }

        public function getInputs(){
            /*return array(
                new Input\Input("Name", "text", "Here is the name", true),
                new Input\Input("Address", "textarea", "Here is the address", false),
                new Input\Input("Password", "password", "Enter password", false),
            );*/
        }
    }
}
?>