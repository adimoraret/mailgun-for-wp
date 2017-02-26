<?php
namespace MailGunApiForWp\Settings {
    class Settings{
        public function __construct(){
        }

        public function showMenu(){
            $pages = $this->getPages();
            $menuBuilder = new Menu\MenuBuilder($pages);
            $menuBuilder->buildMenu(false);
        } 

        private function getPages(){
            return array(
                new Pages\Modules\GeneralSettings\GeneralSettings(),
                new Pages\Modules\AdditionalSettings\AdditionalSettings(),
            );
        }
    }
}