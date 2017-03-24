<?php

namespace MailGunApiForWp\Settings\Pages\Modules {

    use MailGunApiForWp\MailGunApiForWp;

    abstract class AdminBasePage {
        protected function __construct() {
        }

        public function getOptionGroup() {
            return MailGunApiForWp::PLUGIN_SHORT_CODE . '-' . $this->getSlug();
        }

        public function getOptionName() {
            return MailGunApiForWp::PLUGIN_SHORT_CODE . '-' . $this->getSlug() . '-setting';
        }

        public function getSavedOptions() {
            return get_option($this->getOptionName());
        }

        protected abstract function getSlug();
        protected abstract function getTitle();
        protected abstract function getBrowserTitle();
        protected abstract function validateForm($formData);
        protected abstract function renderPage();
        public abstract function enqueuePageScripts();
        public abstract function enqueueAjaxCalls();
    }
}