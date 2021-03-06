<?php
/**
 * @package   MailGun for Wordpress
 * @author    Adrian Moraret
 * @license   GPL-2.0+
 * @link      http://www.codetrest.com/mailgun-for-wp
 * @copyright 2017 Codetrest
 *
 * @wordpress-plugin
 * Plugin Name: MailGun for Wordpress
 * Plugin URI: http://www.codetrest.com/mailgun-for-wp
 * Description: Integrates MailGun withh your Wordpress website.
 * Version: 1.0.0
 * Author: Adrian Moraret
 * Author URI: http://www.codetrest.com
 * Text Domain: mailgun-for-wp
 * License: GPL-2.0+
 */
namespace MailGunApiForWp {
    class MailGunApiForWp {
        CONST PLUGIN_VERSION    = '1.0.0';
        CONST PLUGIN_SLUG       = 'mg-wp';
        CONST PLUGIN_NAME       = 'MailGun for Wordpress';
        CONST PLUGIN_SITE_URL   = 'http://www.codetrest.com';
        CONST PLUGIN_SHORT_CODE = 'mgwp';

        private static $classes = array(
            'Settings'              => '/settings/Settings.php',
            'AdminBaseForm'         => '/settings/pages/modules/AdminBaseForm.php',
            'AdminBasePage'         => '/settings/pages/modules/AdminBasePage.php',
            'Options'               => '/settings/pages/modules/Options.php',
            'GeneralSettings'       => '/settings/pages/modules/generalsettings/GeneralSettings.php',
            'HttpSettingsForm'      => '/settings/pages/modules/generalsettings/HttpSettingsForm.php',
            'SmtpSettingsForm'      => '/settings/pages/modules/generalsettings/SmtpSettingsForm.php',
            'ProviderSettingsForm'  => '/settings/pages/modules/generalsettings/ProviderSettingsForm.php',
            'EmailSender'           => '/settings/pages/modules/emailsender/EmailSender.php',
            'EmailSenderForm'       => '/settings/pages/modules/emailsender/EmailSenderForm.php',
            'Tracking'              => '/settings/pages/modules/tracking/Tracking.php',
            'MenuBuilder'           => '/settings/menu/MenuBuilder.php',
            'MailMessage'           => '/utils/email/mailmessage/MailMessage.php',
            'MailgunBaseProvider'   => '/utils/email/provider/mailgun/MailgunBaseProvider.php',
            'MailgunHttpProvider'   => '/utils/email/provider/mailgun/MailgunHttpProvider.php',
            'MailgunSmtpProvider'   => '/utils/email/provider/mailgun/MailgunSmtpProvider.php',
            'EmailProviderFactory'  => '/utils/email/provider/EmailProviderFactory.php',
            'WordpressUtil'         => '/utils/wordpress/WordpressUtil.php',
            'WordpressDisplayUtil'  => '/utils/wordpress/page/WordpressDisplayUtil.php',
            'Button'                => '/utils/wordpress/page/button/Button.php',
            'Input'                 => '/utils/wordpress/page/input/Input.php',
            'TextArea'              => '/utils/wordpress/page/input/TextArea.php',
            'TextInput'             => '/utils/wordpress/page/input/TextInput.php',
            'RadioButton'           => '/utils/wordpress/page/input/RadioButton.php',
            'RadioButtonGroup'      => '/utils/wordpress/page/input/RadioButtonGroup.php',
            'Checkbox'              => '/utils/wordpress/page/input/Checkbox.php',
            'CheckboxGroup'         => '/utils/wordpress/page/input/CheckboxGroup.php',
            'StringHelper'          => '/utils/string/StringHelper.php'
        );

        private function __construct() {}

        public static function start() {
            $settings = new Settings\Settings();
            $settings->showMenu();
        }

        public static function activate() {}

        public static function deactivate() {}

        public static function includeClasses() {
            foreach(self::$classes as $className => $classPath){
                self::includeClass($classPath);
            }
        }

        private static function includeClass($classPath) {
            $filePath = dirname(__FILE__) . DIRECTORY_SEPARATOR . trim($classPath, '/\\');
            return file_exists($filePath) ? include $filePath : null;
        }
    }
    MailGunApiForWp::includeClasses();

    if (defined('ABSPATH')) {
        register_activation_hook(__FILE__, array('\MailGunApiForWp\MailGunApiForWp', 'activate'));
		register_deactivation_hook(__FILE__, array('\MailGunApiForWp\MailGunApiForWp', 'deactivate'));
        add_action('plugins_loaded', array('\MailGunApiForWp\MailGunApiForWp', 'start'), 0);
    }
}