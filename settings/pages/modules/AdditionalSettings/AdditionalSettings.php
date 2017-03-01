<?php
namespace MailGunApiForWp\Settings\Pages\Modules\AdditionalSettings {
    //TODO
    class AdditionalSettings extends \MailGunApiForWp\Settings\Pages\Modules\AdminBasePage{
        public function __construct(){
            parent::__construct();
        }
        public function getSlug() {
            return \MailGunApiForWp\MailGunApiForWp::PLUGIN_SHORT_CODE . '-' . 'pg-2';
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
        public function renderPage(){
            include_once  dirname(__FILE__) . DIRECTORY_SEPARATOR . 'partial_additional_settings.php';
        }
        public function validateForm($formData){
            echo "AdditionalSettings";
            die();
        }  
    }
}