<?php

namespace MailGunApiForWp\Settings\Pages {
    abstract class AdminBasePage {
        public function __construct() {
        }

        public abstract function getSlug();
        public abstract function getTitle();
        public abstract function getBrowserTitle();
        // public abstract function getInputs();

        public function renderPage() {
            echo '<h1>'.$this->getBrowserTitle().'</h1>';
        }
    }
}
?>