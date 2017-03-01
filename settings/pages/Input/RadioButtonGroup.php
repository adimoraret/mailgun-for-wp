<?php
namespace MailGunApiForWp\Settings\Pages\Input{
    class RadioButtonGroup {
        private $label;
        private $name;
        private $radioButtons;
        private $isRequired;
        
        public function __construct($label, $radioButtons) {
            $this->label = $label;
            $this->radioButtons = $radioButtons;
            $this->name = $this->radioButtons[0]->getName();
            $this->isRequired = $this->radioButtons[0]->getIsRequired();
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

        public function getIsRequired() {
            return $this->isRequired;
        }
    }
}