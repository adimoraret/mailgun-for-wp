<?php
namespace MailGunApiForWp\Settings\Pages {
    class GeneralSettings extends AdminBasePage{
        public function getSlug() {
            return 'mgwp-pg-1';
        }
        public function getTitle(){
            return 'MailGun 4 WP';
        }
        public function getBrowserTitle(){
            return 'MailGun for Wordpress';
        }
    }
}
?>