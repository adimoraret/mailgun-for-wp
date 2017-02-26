<?php

namespace MailGunApiForWp\Settings\Pages\Modules {
    abstract class AdminBasePage {
        public function __construct() {

            add_action('admin_init', array($this, 'initializePage'));
            //add_action('current_screen', array($this, 'showForm'));
        }

        public abstract function getSlug();
        public abstract function getTitle();
        public abstract function getBrowserTitle();
        protected abstract function renderPage();
        protected abstract function validateForm();

        public function showForm(){
           /* register_setting(
                $this->getSlug(), 
                $this->getSlug(), 
                array( $this, 'validateForm' ) );*/
        }
        
        public function initializePage(){
            register_setting('mailgun_4_wp_settings', 'mailgun_4_wp', array($this, 'validateForm'));
        }

        public function getSavedOptions(){
            return get_option('mailgun_4_wp');
        }
    }
}