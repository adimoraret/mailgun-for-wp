<?php

namespace MailGunApiForWp\Settings\Pages\Modules {
    abstract class AdminBasePage {
        private $caller;
        protected function __construct($caller) {
            $this->caller = $caller;
            add_action('admin_init', array($this, 'initializePage'));
        }

        public abstract function getSlug();
        public abstract function getTitle();
        public abstract function getBrowserTitle();
        public abstract function validateForm($formData);
        protected abstract function renderPage();
        public function getOptionGroup(){
            return 'mailgun-4-wp-settings' . '-' . $this->getSlug();
        }
        private function getOptionName(){
            return 'mailgun_4_wp' . '-' . $this->getSlug();
        }

        public function initializePage(){
            register_setting($this->getOptionGroup(), $this->getOptionName(), array($this, 'validate'));
        }

        public function getSavedOptions(){
            return get_option('mailgun_4_wp');
        }

        public function validate($formData){
           return $this->validateForm($formData);
        }
    }
}