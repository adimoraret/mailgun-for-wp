<?php
namespace MailGunApiForWp\Settings\Pages\Modules {

    class Options{
        const GeneralSettings = 1;
        const GeneralSettings_HttpSettings = 'mgwp_http_settings';
        const GeneralSettings_SmtpSettings = 'mgwp_smtp_settings';
        const GeneralSettings_ProviderSettings = 'mgwp_provider_settings';
        const EmailSenderSettings = 2;
        const EmailSenderSettings_SendSettings = 'mgwp_email_sender_settings';

        private static $AllOptions = array(
            self::GeneralSettings => array( self::GeneralSettings_HttpSettings,
                                            self::GeneralSettings_SmtpSettings,
                                            self::GeneralSettings_ProviderSettings
                                    )
        );

        private function __construct() {}

        public static function getSavedOptionsByFormSlug($formSlug){
            return get_option($formSlug);
        }

        public static function getSavedOptionsByPage($page){
            $options = array();
            foreach (self::$AllOptions[$page] as $formSlug){
                $options[$formSlug] = get_options($formSlug);
            }
            return $options;
        }

    }
}