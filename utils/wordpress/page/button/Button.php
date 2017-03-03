<?php

namespace MailGunApiForWp\Utils\Wordpress\Page\Button;

class Button {
    private $type;
    private $name;
    private $id;
    private $className;
    private $value;

    function __construct($type, $name, $id, $className, $value) {
        $this->type = $type;
        $this->name = $name;
        $this->id = $id;
        $this->className = $className;
        $this->value = $value;
    }

    public function getType() {
        return $this->type;
    }

    public function getName() {
        return $this->name;
    }

    public function getId() {
        return $this->id;
    }

    public function getClassName() {
        return $this->className;
    }

    public function getValue() {
        return $this->value;
    }
}