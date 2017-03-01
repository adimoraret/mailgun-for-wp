<?php
namespace MailGunApiForWp\Settings\Pages\Input{
    class RadioButton extends Input{
        private $isChecked;
        
        public function __construct($label, $name, $id, $type, $description, $isChecked, $isRequired, $value) {
           parent::__construct($label, $name, $id, $type, $description, $isRequired, $value);
            $this->isChecked = $isChecked;
        }

        public function getIsChecked() {
            return $this->isChecked;
        }
    }
}