<?php
use MailGunApiForWp\settings\pages\modules\AdminBaseForm;
use MailGunApiForWp\Utils\Wordpress\Page\Button\Button;
use MailGunApiForWp\Utils\Wordpress\Page\Input\RadioButton;
use MailGunApiForWp\Utils\Wordpress\Page\Input\RadioButtonGroup;

/**
 * Created by PhpStorm.
 * User: Adi
 * Date: 4/5/2017
 * Time: 11:30 PM
 */
class ProviderSettingsForm extends AdminBaseForm{

    private $submitButton;
    private $selectedProvider;

    function __construct() {
        parent::__construct();
    }

    public function getId() {
        return "mgwp-provider-settings";
    }

    public function getName() {
        return "Select Mailgun send method";
    }

    public function enqueueAjaxCalls() {
        add_action('wp_ajax_mgwp_test_configuration', array($this, 'testConfiguration'));
    }

    public function getButtons() {
        return array($this->submitButton);
    }

    public function getInputs() {
        return array($this->selectedProvider);
    }

    public function validateForm($formData) {
        // TODO: Implement validateForm() method.
    }

    protected function getSlug() {
        return "provider-settings";
    }

    protected function initializeInputs() {
        $radioButtons = array(
            new RadioButton('Http', 'selectedProvider', 'httpProvider', 'radio', 'Http Provider', false, true, 0),
            new RadioButton('Smtp', 'selectedProvider', 'smtpProvider', 'radio', 'Smtp Provider', false, true, 1)
        );
        $this->selectedProvider = new RadioButtonGroup('Sending method', $radioButtons);
    }

    protected function initializeButtons() {
        $this->submitButton = new Button('button', 'saveProviderSettings', 'saveProviderSettings', 'Save changes', null);
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
}