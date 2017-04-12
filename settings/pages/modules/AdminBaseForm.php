<?php
/**
 * Created by PhpStorm.
 * User: Adi
 * Date: 3/27/2017
 * Time: 9:20 PM
 */

namespace MailGunApiForWp\settings\pages\modules {

    abstract class AdminBaseForm {
        protected function __construct() {
            $this->initializeInputs();
            $this->initializeButtons();
        }

        public function getSavedOptions() {
            return get_option($this->getSlug());
        }

        public abstract function getName();
        public abstract function enqueueAjaxCalls();
        public abstract function getButtons();
        public abstract function getInputs();
        public abstract function validateForm($formData);
        public abstract function getIconClass();
        public abstract function getSlug();

        protected abstract function initializeInputs();
        protected abstract function initializeButtons();
    }
}