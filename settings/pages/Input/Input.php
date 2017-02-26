<?php
namespace MailGunApiForWp\Settings\Pages\Input{
    class Input {
        private $name;
        private $type;
        private $placeholder;
        private $isRequired;
        private $description;
        public $value;
        
        public function __construct($name, $type, $description, $placeholder, $isRequired){
            $this->name = $name;
            $this->type = $type;
            $this->description = $description;
            $this->placeholder = $placeholder;
            $this->isRequired = $isRequired;
        }
        
        public function getName(){
            return $this->name;
        }

        public function getType(){
            return $this->type;
        }

        public function getDescription(){
            return $this->description;
        }

        public function getPlaceholder(){
            return $this->placeholder;
        }

        public function getIsRequired(){
            return $this->isRequired;
        }
    }
}