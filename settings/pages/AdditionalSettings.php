<?php
namespace MailGunApiForWp\Settings\Pages {
    class AdditionalSettings extends AdminBasePage{
        public function getSlug() {
            return 'mgwp-pg-2';
        }
        public function getTitle(){
            return 'Additional Settings';
        }
        public function getBrowserTitle(){
            return 'Some additional settings';
        }
    }
}
?>