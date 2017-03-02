<?php
namespace MailGunApiForWp\Settings\Pages\Modules\Tracking {
    class Tracking extends \MailGunApiForWp\Settings\Pages\Modules\AdminBasePage{
        public function __construct(){
            parent::__construct();
        }
        public function getSlug() {
            return \MailGunApiForWp\MailGunApiForWp::PLUGIN_SHORT_CODE . '-' . 'pg-2';
        }
        public function getTitle(){
            return 'Email Tracking';
        }
        public function getBrowserTitle(){
            return 'Email Tracking';
        }
        public function getInputs(){
            return array();
        }
        public function renderPage(){
            include_once  dirname(__FILE__) . DIRECTORY_SEPARATOR . 'partial_tracking.php';
        }
        public function validateForm($formData){
            return $formData;
        }  
    }
}