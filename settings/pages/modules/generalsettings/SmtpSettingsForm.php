<?php
/**
 * Created by PhpStorm.
 * User: Adi
 * Date: 3/27/2017
 * Time: 10:52 PM
 */

namespace MailGunApiForWp\settings\pages\modules\generalsettings;


use MailGunApiForWp\settings\pages\modules\AdminBaseForm;
use MailGunApiForWp\Utils\Wordpress\Page\Button\Button;
use MailGunApiForWp\Utils\Wordpress\Page\Input\TextInput;

class SmtpSettingsForm extends AdminBaseForm {

    private $domainName;
    private $username;
    private $password;
    private $submitButton;

    function __construct() {
        parent::__construct();
    }

    public function getId() {
        return "mgwp-smtp-settings";
    }

    public function getName() {
        return "Smtp settings";
    }

    public function enqueueAjaxCalls() {}

    public function getButtons() {
        return array($this->submitButton);
    }

    public function getInputs() {
        return array($this->domainName, $this->username, $this->password);
    }

    public function validateForm($formData) {
        return $formData;
    }

    protected function getSlug() {
        return "smtp-settings";
    }

    public function getIconClass() {
        return "dashicons dashicons-admin-tools mirror";
    }

    protected function initializeButtons() {
        $this->submitButton = new Button('button', 'saveSmtpSettings', 'saveSmtpSettings', 'Save changes', null);
    }

    protected function initializeInputs() {
        $this->domainName = new TextInput('Domain Name', 'domainname2', 'domainname2', 'text', 'Mailgun domain name', 'Your mailgun domain name', '');
        $this->username = new TextInput('Username', 'username', 'username', 'text', 'Mailgun smtp username', 'Your mailgun smtp username', '');
        $this->password = new TextInput('Password', 'password', 'password', 'password', 'Mailgun smtp passowrd', 'Your mailgun smtp password', '');
    }
}