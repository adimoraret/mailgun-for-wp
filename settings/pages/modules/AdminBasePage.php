<?php

namespace MailGunApiForWp\Settings\Pages\Modules {
    abstract class AdminBasePage {
        protected function __construct() {
            add_action('admin_init', array($this, 'initializePage'));
        }

        public abstract function getSlug();
        public abstract function getTitle();
        public abstract function getBrowserTitle();
        public abstract function validateForm($formData);
        protected abstract function renderPage();
        public function getOptionGroup(){
            return 'mg_wp_stg' . '_' . $this->getSlug();
        }
        public function getOptionName(){
            return 'mg_wp' . '_' . $this->getSlug();
        }

        public function initializePage(){
            register_setting($this->getOptionGroup(), $this->getOptionName(), array($this, 'validateForm'));
        }

        public function getSavedOptions(){
            return get_option($this->getOptionName());
        }
    }
}