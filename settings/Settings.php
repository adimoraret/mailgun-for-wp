<?php
namespace MailGunApiForWp\Settings {

    use MailGunApiForWp\Settings\Menu\MenuBuilder;
    use MailGunApiForWp\Settings\Pages\Modules\GeneralSettings\GeneralSettings;
    use MailGunApiForWp\Settings\Pages\Modules\Tracking\Tracking;
    use MailGunApiForWp\Utils\String\StringHelper;

    final class Settings{

        private $pages;

        public function __construct() {
            $this->pages = array(new GeneralSettings(),new Tracking());
            add_action('admin_init', array($this, 'initializePage'));
            add_action('admin_enqueue_scripts', array($this, 'enqueueScripts'));
            add_action('wp_ajax_mgwp_test_configuration', array($this, 'testConfiguration') );
        }

        public function testConfiguration(){
            wp_send_json_success(
                array(
                    'message' => 'Email was sent successfull'
                )
            );
            wp_die();
        }

        public function initializePage(){
            foreach ($this->pages as $page) {
                register_setting($page->getOptionGroup(), $page->getOptionName(), array($page, 'validateForm'));
            }
        }

        public function enqueueScripts($hook){
            $activePage = $this->getAdminPageByHook($hook);
            if ($activePage != null) {
                $activePage->enqueuePageScripts();
            }
        }

        private function getAdminPageByHook($hook){
            foreach ($this->pages as $page) {
                if (StringHelper::endsWith($hook, $page->getSlug())){
                    return $page;
                }
            }
            return null;
        }

        public function showMenu() {
            $menuBuilder = new MenuBuilder($this->pages);
            $menuBuilder->buildMenu(false);
        }
    }
}