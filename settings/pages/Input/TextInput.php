<?php
namespace MailGunApiForWp\Settings\Pages\Input{
    class TextInput extends Input{
        private $placeholder;
        
        public function __construct($label, $name, $id, $type, $description, $placeholder, $isRequired){
           parent::__construct($label, $name, $id, $type, $description, $isRequired);
            $this->placeholder = $placeholder;
        }

        public function getPlaceholder(){
            return $this->placeholder;
        }
    }
}