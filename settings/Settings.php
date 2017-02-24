<?php
    namespace MailGunApiForWp\Settings {
        class Settings{
            
            CONST NAME = 'MailGun 4 WP';

            private function __construct(){
                add_action('admin_init', array($this, 'initializeAdminPlugin'));
                $this->displayPluginSettings(false);
            }

            public static function getInstance() {
                static $instance = null;
                if ($instance === null) {
                    $instance = new Settings();
                }
                return $instance;
            }

            private function displayPluginSettings($isMultisite) {
                if ($isMultisite) {
	                add_action('network_admin_menu', array($this, 'buildPluginMenu'));
                } else {
                    add_action('admin_menu', array($this, 'buildPluginMenu'));
                }
            }

            public function buildPluginMenu(){
                add_menu_page(self::NAME, self::NAME, 'manage_options', 'slug', '', 'dashicons-email', null);
            }

            public function initializeAdminPlugin(){}

        }
    }
?>
