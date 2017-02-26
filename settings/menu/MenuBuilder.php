<?php
namespace MailGunApiForWp\Settings\Menu {
    class MenuBuilder{
        private $pages;

        public function __construct($pages){
            $this->pages = $pages;
        }

        public function buildMenu($isMultisite) {
            if ($isMultisite) {
                add_action('network_admin_menu', array($this, 'createMenu'));
            } else {
                add_action('admin_menu', array($this, 'createMenu'));
            }
        }

        public function createMenu(){
            $firstPage = $this->pages[0];
            add_menu_page($firstPage->getTitle(), $firstPage->getTitle(), 'manage_options', $firstPage->getSlug(), array($firstPage, 'renderPage'), 'dashicons-email-alt', null);
            foreach($this->pages as $page){
                add_submenu_page( $firstPage->getSlug(), $page->getTitle(), $page->getTitle(), 'manage_options', $page->getSlug(), array($page, 'renderPage'));      
            }
        }
    }
}