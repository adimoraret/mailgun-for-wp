<?php

namespace MailGunApiForWp\Utils\Wordpress\Page\Button;

class Button {
    private $type;
    private $name;
    private $id;
    private $value;
    private $onClick;

    function __construct($type, $name, $id, $value, $onClick) {
        $this->type = $type;
        $this->name = $name;
        $this->id = $id;
        $this->value = $value;
        $this->onClick = $onClick;
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

    public function getValue() {
        return $this->value;
    }

    public function getOnClick(){
        return $this->onClick;
    }
}