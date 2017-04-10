<?php
namespace MailGunApiForWp\Utils\Wordpress\Page\Input {
    class CheckboxGroup {
        private $label;
        private $name;
        private $checkboxes;

        public function __construct($label, $name, $checkboxes) {
            $this->label = $label;
            $this->checkboxes = $checkboxes;
            $this->name = $name;
        }

        public function getLabel() {
            return $this->label;
        }

        public function getCheckboxes() {
            return $this->checkboxes;
        }

        public function getName(){
            return $this->name;
        }
    }
}