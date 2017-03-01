<?php

namespace MailGunApiForWp\Settings\Pages\Modules {
    abstract class AdminBasePage {
        protected function __construct() {
            add_action('admin_init', array($this, 'initializePage'));
        }

        public function initializePage() {
            register_setting($this->getOptionGroup(), $this->getOptionName(), array($this, 'validateForm'));
        }

        protected function getOptionGroup() {
            return \MailGunApiForWp\MailGunApiForWp::PLUGIN_SHORT_CODE . '-' . $this->getSlug();
        }

        protected function getOptionName() {
            return \MailGunApiForWp\MailGunApiForWp::PLUGIN_SHORT_CODE . '-' . $this->getSlug() . '-setting';
        }

        protected function getSavedOptions() {
            return get_option($this->getOptionName());
        }

        protected abstract function getSlug();
        protected abstract function getTitle();
        protected abstract function getBrowserTitle();
        protected abstract function validateForm($formData);
        protected abstract function renderPage();
    }
}