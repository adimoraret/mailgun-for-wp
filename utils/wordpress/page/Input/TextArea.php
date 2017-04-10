<?php
namespace MailGunApiForWp\Utils\Wordpress\Page\Input {
    class TextArea extends Input {
        private $placeholder;

        public function __construct($label, $name, $id, $type, $description, $placeholder, $value) {
            parent::__construct($label, $name, $id, $type, $description, $value);
            $this->placeholder = $placeholder;
        }

        public function getPlaceholder() {
            return $this->placeholder;
        }
    }
}