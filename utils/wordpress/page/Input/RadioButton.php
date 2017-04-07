<?php
namespace MailGunApiForWp\Utils\Wordpress\Page\Input {
    class RadioButton extends Input{
        private $isChecked;
        
        public function __construct($label, $name, $id, $type, $description, $isChecked, $value) {
           parent::__construct($label, $name, $id, $type, $description, $value);
            $this->isChecked = $isChecked;
        }

        public function getIsChecked() {
            return $this->isChecked;
        }
    }
}