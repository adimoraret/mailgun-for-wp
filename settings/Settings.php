<?php
namespace MailGunApiForWp\Settings {

    use MailGunApiForWp\Settings\Menu\MenuBuilder;
    use MailGunApiForWp\Settings\Pages\Modules\EmailSender\EmailSender;
    use MailGunApiForWp\Settings\Pages\Modules\GeneralSettings\GeneralSettings;
    use MailGunApiForWp\Utils\String\StringHelper;

    final class Settings{

        private $pages;

        public function __construct() {
            $this->pages = array(new GeneralSettings(),new EmailSender());
            add_action('admin_init', array($this, 'initializePages'));
            add_action('admin_enqueue_scripts', array($this, 'enqueueScripts'));
        }

        public function initializePages(){
            foreach ($this->pages as $page) {
                $this->initializeForms($page->getForms());
            }
        }

        private function initializeForms($forms){
            foreach ($forms as $form) {
                register_setting($form->getOptionGroup(), $form->getOptionName(), array($form, 'validateForm'));
                $form->enqueueAjaxCalls();
            }
        }

        public function enqueueScripts($hook){
            $activePage = $this->getAdminPageByHook($hook);
            if ($activePage != null) {
                $activePage->enqueuePageScriptsAndStyles();
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