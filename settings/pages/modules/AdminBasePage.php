<?php

namespace MailGunApiForWp\Settings\Pages\Modules {

    abstract class AdminBasePage {
        protected function __construct() {
            $this->initializeForms();
        }

        public abstract function getForms();
        public abstract function enqueuePageScriptsAndStyles();

        protected abstract function getSlug();
        protected abstract function getTitle();
        protected abstract function getBrowserTitle();
        protected abstract function renderPage();
        protected abstract function initializeForms();
    }
}