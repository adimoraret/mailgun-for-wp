<?php
namespace MailGunApiForWp\Settings\Pages\Modules\AdditionalSettings {
    class AdditionalSettings extends \MailGunApiForWp\Settings\Pages\Modules\AdminBasePage{
        public function getSlug() {
            return 'mgwp-pg-2';
        }
        public function getTitle(){
            return 'Additional Settings';
        }
        public function getBrowserTitle(){
            return 'Some additional settings';
        }
        public function getInputs(){
            return array();
        }
        protected function getPartialFile(){
            return dirname(__FILE__) . DIRECTORY_SEPARATOR . 'partial_additional_settings.php';
        }
    }
}
?>