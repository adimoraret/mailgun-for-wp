<?php
namespace MailGunApiForWp\Utils\Wordpress\Page\Input {
    class RadioButtonGroup {
        private $label;
        private $name;
        private $radioButtons;

        public function __construct($label, $radioButtons) {
            $this->label = $label;
            $this->radioButtons = $radioButtons;
            $this->name = $this->radioButtons[0]->getName();
        }

        public function getLabel() {
            return $this->label;
        }

        public function getName() {
            return $this->name;
        }

        public function getRadioButtons() {
            return $this->radioButtons;
        }
    }
}