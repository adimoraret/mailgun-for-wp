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
                add_menu_page($firstPage->getTitle(), $firstPage->getTitle(), 'manage_options', $firstPage->getSlug(), array($firstPage, 'renderPage'), 'dashicons-email-alt', null);
                foreach($pages as $page){
                    add_submenu_page( $firstPage->getSlug(), $page->getTitle(), $page->getTitle(), 'manage_options', $page->getSlug(), array($page, 'renderPage'));      
                }
            }

            private function getPages(){
                return array(
                    new Pages\GeneralSettings(),
                    new Pages\AdditionalSettings(),
                );
            }
        }
    }
?>