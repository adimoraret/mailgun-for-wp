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
    private $testConfigurationButton;

    public function __construct() {
        parent::__construct();
    }

    public function getInputs() {
        return array($this->domainName, $this->apiKey, $this->fromAddress, $this->fromName);
    }

    public function getButtons() {
        return array($this->submitButton, $this->testConfigurationButton);
    }

    public function validateForm($formData) {
        return $formData;
    }

    public function enqueueAjaxCalls() {
        add_action('wp_ajax_mgwp_test_configuration', array($this, 'testConfiguration'));
    }

    public function testConfiguration() {
        sleep(2);
        wp_send_json_success(
            array(
                'message' => 'Email was sent successfull'
            )
        );
        wp_die();
    }

    protected function initializeButtons() {
        $this->submitButton = new Button('submit', 'submit', 'submit', 'button button-primary', 'Save changes', null);
        $this->testConfigurationButton = new Button('button', 'testconfiguration', 'testconfiguration', '', 'Test Configuration', null);
    }

    protected function initializeInputs() {
        $this->domainName = new TextInput('Domain Name', 'domainname', 'domainname', 'text', 'Mailgun domain name', 'Your mailgun domain name', true, '');
        $this->apiKey = new TextInput('API Key', 'apikey', 'apikey', 'text', 'Mailgun api key', 'Your mailgun api key', true, '');
        $this->fromAddress = new TextInput('From address', 'fromaddress', 'fromaddress', 'email', 'From email address', 'Your from email address', true, '');
        $this->fromName = new TextInput('From name', 'fromname', 'fromname', 'text', 'From name', 'Your from name', true, '');
    }

    protected function getSlug() {
        return "http-settings";
    }
}