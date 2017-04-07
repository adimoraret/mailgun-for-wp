<?php
/**
 * Created by PhpStorm.
 * User: Adi
 * Date: 3/27/2017
 * Time: 9:23 PM
 */

namespace MailGunApiForWp\settings\pages\modules\generalsettings;

use MailGunApiForWp\settings\pages\modules\AdminBaseForm;
use MailGunApiForWp\Utils\Wordpress\Page\Button\Button;
use MailGunApiForWp\Utils\Wordpress\Page\Input\TextInput;

class HttpSettingsForm extends AdminBaseForm {

    private $domainName;
    private $apiKey;
    private $fromAddress;
    private $fromName;
    private $submitButton;

    public function __construct() {
        parent::__construct();
    }

    public function getId() {
        return "mgwp-http-settings";
    }

    public function getName() {
        return "Http settings";
    }

    public function getInputs() {
        return array($this->domainName, $this->apiKey, $this->fromAddress, $this->fromName);
    }

    public function getButtons() {
        return array($this->submitButton);
    }

    public function validateForm($formData) {
        return $formData;
    }

    public function enqueueAjaxCalls() {
    }

    protected function initializeButtons() {
        $this->submitButton = new Button('button', 'saveHttpSettings', 'saveHttpSettings', 'Save changes', null);
    }

    protected function initializeInputs() {
        $this->domainName = new TextInput('Domain Name', 'domainname', 'domainname', 'text', 'Mailgun domain name', 'Your mailgun domain name', '');
        $this->apiKey = new TextInput('API Key', 'apikey', 'apikey', 'text', 'Mailgun api key', 'Your mailgun api key', '');
        $this->fromAddress = new TextInput('From address', 'fromaddress', 'fromaddress', 'email', 'From email address', 'Your from email address', '');
        $this->fromName = new TextInput('From name', 'fromname', 'fromname', 'text', 'From name', 'Your from name', '');
    }

    protected function getSlug() {
        return "http-settings";
    }
}