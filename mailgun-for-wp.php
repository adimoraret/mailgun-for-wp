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
            'Input'                 => '/settings/pages/input/Input.php',
            'AdminBasePage'         => '/settings/pages/modules/AdminBasePage.php',
            'GeneralSettings'       => '/settings/pages/modules/generalsettings/GeneralSettings.php',
            'AdditionalSettings'    => '/settings/pages/modules/additionalsettings/AdditionalSettings.php',
            'MenuBuilder'           => '/settings/menu/MenuBuilder.php',
            'WordpressUtil'         => '/utils/WordpressUtil.php'
        );

        private function __construct(){

        }

        public static function start(){
            $settings = new Settings\Settings();
            $settings->showMenu();
        }

        public static function activate(){
        }

        public static function deactivate(){
        }

        public static function includeClasses(){
            foreach(self::$classes as $className => $classPath){
                self::includeClass($className, $classPath);
            }
        }

        private static function includeClass($className, $classPath) {
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