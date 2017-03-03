<?php
namespace MailGunApiForWp\Settings {

    use MailGunApiForWp\Settings\Pages\Modules\GeneralSettings\GeneralSettings;
    use MailGunApiForWp\Settings\Pages\Modules\Tracking\Tracking;

    class Settings{
        public function showMenu() {
            $pages = $this->getPages();
            $menuBuilder = new Menu\MenuBuilder($pages);
            $menuBuilder->buildMenu(false);
        } 

        private function getPages() {
            return array(
                new GeneralSettings(),
                new Tracking(),
            );
        }
    }
}