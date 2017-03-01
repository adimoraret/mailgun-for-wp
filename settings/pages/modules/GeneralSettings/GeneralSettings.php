<?php
namespace MailGunApiForWp\Settings\Pages\Modules\GeneralSettings {
    class GeneralSettings extends \MailGunApiForWp\Settings\Pages\Modules\AdminBasePage{
        private $sendMethod;                
        private $domainName;        
        private $apiKey;
        private $fromAddress;
        private $fromName;

        public function __construct(){
            parent::__construct();
            $this->sendMethod = new \MailGunApiForWp\Settings\Pages\Input\RadioButtonGroup('Email send method', array(
                new \MailGunApiForWp\Settings\Pages\Input\RadioButton('Http', 'sendmethod', 'httpmethod', 'radio', 'Send emails via HTTP calls', true, true),
                new \MailGunApiForWp\Settings\Pages\Input\RadioButton('Smtp', 'sendmethod', 'smtpmethod', 'radio', 'Send emails via SMTP calls', false, true))
            );
            $this->domainName = new \MailGunApiForWp\Settings\Pages\Input\TextInput('Domain Name', 'domainname', 'domainname', 'text', 'Mailgun domain name', 'Your mailgun domain name', true);
            $this->apiKey = new \MailGunApiForWp\Settings\Pages\Input\TextInput('API Key', 'apikey', 'apikey', 'text', 'Mailgun api key', 'Your mailgun api key', true);
            $this->fromAddress =  new \MailGunApiForWp\Settings\Pages\Input\TextInput('From address', 'fromaddress', 'fromaddress', 'email', 'From email address', 'Your from email address', true);
            $this->fromName =  new \MailGunApiForWp\Settings\Pages\Input\TextInput('From name', 'fromname', 'fromname', 'text', 'From name', 'Your from name', true);
        }

        public function getSlug() {
            return \MailGunApiForWp\MailGunApiForWp::PLUGIN_SHORT_CODE . '-' . 'pg-1';
        }
        public function getTitle(){
            return 'MailGun 4 WP';
        }
        public function getBrowserTitle(){
            return 'MailGun for Wordpress';
        }

        public function getInputs(){
            return array(
                $this->sendMethod, 
                $this->domainName, 
                $this->apiKey, 
                $this->fromAddress,
                $this->fromName);
        }

        public function renderPage(){
            include_once  dirname(__FILE__) . DIRECTORY_SEPARATOR . 'partial_general_settings.php';
        }

        private function getSubmitButtonText(){
            return 'Save changes';
        }

        public function validateForm($formData){
            $nameInputValue = $formData[$this->nameInput->getName()];
            return $formData;
        }

 
    }
}