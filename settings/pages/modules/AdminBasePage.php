<?php

namespace MailGunApiForWp\Settings\Pages\Modules {

    abstract class AdminBasePage {
        protected function __construct() {
            $this->initializeForms();
        }

        public abstract function getForms();
        public abstract function enqueuePageScriptsAndStyles();
        public abstract function getTitle();
        public abstract function renderPage();

        protected abstract function getSlug();
        protected abstract function getBrowserTitle();
        protected abstract function initializeForms();
    }
}