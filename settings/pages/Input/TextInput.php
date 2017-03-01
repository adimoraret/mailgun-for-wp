<?php
namespace MailGunApiForWp\Settings\Pages\Input {
    class TextInput extends Input {
        private $placeholder;
        
        public function __construct($label, $name, $id, $type, $description, $placeholder, $isRequired, $value) {
           parent::__construct($label, $name, $id, $type, $description, $isRequired, $value);
            $this->placeholder = $placeholder;
        }

        public function getPlaceholder() {
            return $this->placeholder;
        }
    }
}