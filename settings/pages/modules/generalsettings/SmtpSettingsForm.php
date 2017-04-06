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
    private $testConfigurationButton;

    function __construct() {
        parent::__construct();
    }

    public function getId() {
        return "mgwp-smtp-settings";
    }

    public function enqueueAjaxCalls() {
        add_action('wp_ajax_mgwp_test_configuration', array($this, 'testConfiguration'));
    }

    public function testConfiguration() {
        sleep(2);
        wp_send_json_success(
            array(
                'message' => 'Email was sent successful'
            )
        );
        wp_die();
    }

    public function getButtons() {
        return array($this->submitButton, $this->testConfigurationButton);
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

    protected function initializeButtons() {
        $this->submitButton = new Button('submit', 'submit', 'submit2', 'button button-primary', 'Save changes', null);
        $this->testConfigurationButton = new Button('button', 'testconfiguration', 'testconfiguration2', '', 'Test Configuration', null);
    }

    protected function initializeInputs() {
        $this->domainName = new TextInput('Domain Name', 'domainname2', 'domainname2', 'text', 'Mailgun domain name', 'Your mailgun domain name', true, '');
        $this->username = new TextInput('Username', 'username', 'username', 'text', 'Mailgun smtp username', 'Your mailgun smtp username', true, '');
        $this->password = new TextInput('Password', 'password', 'password', 'password', 'Mailgun smtp passowrd', 'Your mailgun smtp password', true, '');
    }
}