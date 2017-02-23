<?php
/**
 *
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
    use MailGunApiForWp\Settings;
    class MailGunApiForWp {
        CONST PLUGIN_VERSION    = '1.0.0';
        CONST PLUGIN_SLUG       = 'mg-wp';
        CONST PLUGIN_NAME       = 'MailGun for Wordpress';
        CONST PLUGIN_SITE_URL   = 'http://www.codetrest.com';
        CONST PLUGIN_SHORT_CODE = 'mgwp';

        private $settings;

        private static $classes = array(
            'Settings'          => '/settings/Settings.php'
        );

        private function __construct(){

        }

        public static function activate(){
            $settings = Settings\Settings::GetInstance();
        }

        public static function deactivate(){
        }

        public static function includeClasses(){
            foreach(self::$classes as $className => $classPath){
                self::classAutoLoad($className);
            }
        }

        private static function classAutoLoad($className) {
            if (!isset(self::$classes[$className])) {
                return null;
            }
            $filePath = dirname(__FILE__) . DIRECTORY_SEPARATOR . trim(self::$classes[$className], '/\\');
            return file_exists($filePath) ? include $filePath : null;
        }
    }
    MailGunApiForWp::includeClasses();

    if (defined('ABSPATH')) {
        register_activation_hook(__FILE__, array('\MailGunApiForWp\MailGunApiForWp', 'activate'));
		register_deactivation_hook(__FILE__, array('\MailGunApiForWp\MailGunApiForWp', 'deactivate'));
    }
}
?>