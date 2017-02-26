<?php
namespace Settings{
    class Input {
        private $name;
        private $type;
        private $placeholder;
        private $isRequired;
        
        public function __construct($name, $type, $placeholder, $isRequired){
            $this->name = $name;
            $this->type = $type;
            $this->placeholder = $placeholder;
            $this->isRequired = $isRequired;
        }
    }
}