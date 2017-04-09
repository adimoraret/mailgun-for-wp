<?php
/**
 * Created by PhpStorm.
 * User: Adi
 * Date: 3/27/2017
 * Time: 9:20 PM
 */

namespace MailGunApiForWp\settings\pages\modules;


use MailGunApiForWp\MailGunApiForWp;

abstract class AdminBaseForm {
    protected function __construct() {
        $this->initializeInputs();
        $this->initializeButtons();
    }

    public function getOptionGroup() {
        return MailGunApiForWp::PLUGIN_SHORT_CODE . '-' . $this->getSlug();
    }

    public function getOptionName() {
        return MailGunApiForWp::PLUGIN_SHORT_CODE . '-' . $this->getSlug() . '-setting';
    }

    public function getSavedOptions() {
        return get_option($this->getOptionName());
    }

    public abstract function getId();
    public abstract function getName();
    public abstract function enqueueAjaxCalls();
    public abstract function getButtons();
    public abstract function getInputs();
    public abstract function validateForm($formData);
    public abstract function getIconClass();

    protected abstract function getSlug();
    protected abstract function initializeInputs();
    protected abstract function initializeButtons();
}