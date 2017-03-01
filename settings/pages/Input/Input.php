<?php
namespace MailGunApiForWp\Settings\Pages\Input{
    class Input {
        private $label;
        private $name;
        private $id;
        private $type;
        private $isRequired;
        private $description;
        private $value;
        
        public function __construct($label, $name, $id, $type, $description, $isRequired, $value) {
            $this->label = $label;
            $this->name = $name;
            $this->id = $id;
            $this->type = $type;
            $this->description = $description;
            $this->isRequired = $isRequired;
            $this->value = $value;
        }

        public function getLabel() {
            return $this->label;
        }
        
        public function getName() {
            return $this->name;
        }

        public function getId() {
            return $this->id;
        }

        public function getType() {
            return $this->type;
        }

        public function getDescription() {
            return $this->description;
        }

        public function getPlaceholder() {
            return $this->placeholder;
        }

        public function getIsRequired() {
            return $this->isRequired;
        }

        public function getValue() {
            return $this->value;
        }
    }
}