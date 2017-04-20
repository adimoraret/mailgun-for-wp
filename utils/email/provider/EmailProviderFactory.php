<?php
namespace MailGunApiForWp\Utils\Email\Provider {

    use MailGunApiForWp\Settings\Pages\Modules\Options;
    use MailGunApiForWp\Utils\Email\Provider\Mailgun\MailgunSmtpProvider;
    use MailGunApiForWp\Utils\Email\Provider\Mailgun\MailgunHttpProvider;

    final class EmailProviderFactory{

        const HTTP_PROVIDER = 0;
        const SMTP_PROVIDER = 1;

        public static function getEmailProvider($provider){
            switch ($provider) {
                case self::HTTP_PROVIDER: return self::createMailgunHttpProvider();
                case self::SMTP_PROVIDER: return self::createMailgunSmtpProvider();
                default: self::createMailgunHttpProvider();
            }
        }

        private static function createMailgunSmtpProvider(){
            $smtpSettings = Options::getSavedOptionsByFormSlug(Options::GeneralSettings_SmtpSettings);
            $username = $smtpSettings['username'];
            $password = $smtpSettings['password'];
            $encryption = $smtpSettings['encryption'];
            return new MailgunSmtpProvider($username, $password, $encryption);
        }

        private static function createMailgunHttpProvider(){
            $httpSettings = Options::getSavedOptionsByFormSlug(Options::GeneralSettings_HttpSettings);
	        $domain = $httpSettings['domain'];
            $apiKey = $httpSettings['apikey'];
            return new MailgunHttpProvider($domain, $apiKey);
        }
    }
}