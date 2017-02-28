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
            return \MailGunApiForWp\MailGunApiForWp::PLUGIN_SHORT_CODE . '-' . $this->getSlug();
        }
        public function getOptionName(){
            return \MailGunApiForWp\MailGunApiForWp::PLUGIN_SHORT_CODE . '-' . $this->getSlug() . '-setting';
        }

        public function initializePage(){
            register_setting($this->getOptionGroup(), $this->getOptionName(), array($this, 'validateForm'));
        }

        public function getSavedOptions(){
            return get_option($this->getOptionName());
        }
    }
}