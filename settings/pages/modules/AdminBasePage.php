<?php

namespace MailGunApiForWp\Settings\Pages\Modules {
    abstract class AdminBasePage {
        public function __construct() {
        }

        public abstract function getSlug();
        public abstract function getTitle();
        public abstract function getBrowserTitle();
        public abstract function getInputs();
        protected abstract function getPartialFile();

        public function renderPage() {
            $partialRender = \MailGunApiForWp\Utils\PartialRender::getInstance();
            $fileName = $this->getPartialFile();
            $partialRender->render($fileName);
        }
    }
}