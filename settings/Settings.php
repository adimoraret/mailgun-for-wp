<?php
    namespace MailGunApiForWp\Settings {
        class Settings{
            
            CONST NAME = 'MailGun 4 WP';

            private function __construct(){
                $this->displayPluginMenu(false);
            }

            public static function getInstance() {
                static $instance = null;
                return null !== $instance ? $instance : $instance = new self();
            }

            private function displayPluginMenu($isMultisite) {
                if ($isMultisite) {
	                add_action('network_admin_menu', array($this, 'buildPluginMenu'));
                } else {
                    add_action('admin_menu', array($this, 'buildPluginMenu'));
                }
            }

            public function buildPluginMenu(){
                $pages = $this->getPages();
                $firstPage = $pages[0];
                add_menu_page($firstPage->getTitle(), $firstPage->getTitle(), 'manage_options', $firstPage->getSlug(), '', 'dashicons-email-alt', null);
                foreach($pages as $page){
                    add_submenu_page( $firstPage->getSlug(), $page->getTitle(), $page->getTitle(), 'manage_options', $page->getSlug());      
                }
            }

            private function getPages(){
                return array(
                    new AdminPage('mgwp-pg-1', 'MailGun 4 WP', 'MailGun for Wordpress'),
                    new AdminPage('mgwp-pg-2', 'Option-1', 'Option number 1'),
                    new AdminPage('mgwp-pg-3', 'Option-2', 'Option number 2'),
                );
            }
        }
    }
?>