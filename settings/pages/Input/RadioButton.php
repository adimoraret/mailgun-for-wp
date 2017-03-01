<?php
namespace MailGunApiForWp\Settings\Pages\Input{
    class RadioButton extends Input{
        private $isChecked;
        
        public function __construct($label, $name, $id, $type, $description, $isChecked, $isRequired) {
           parent::__construct($label, $name, $id, $type, $description, $isRequired);
            $this->isChecked = $isChecked;
        }

        public function getIsChecked() {
            return $this->isChecked;
        }
    }
}