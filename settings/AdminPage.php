<?php

namespace MailGunApiForWp\Settings{
    class AdminPage {
        private $slug;
        private $title;
        private $browserTitle;

        public function __construct($slug, $title, $browserTitle){
            $this->slug = $slug;
            $this->title = $title;
            $this->browserTitle = $browserTitle;
        }

        public function getSlug() {
            return $this->slug;
        }
        
        public function getTitle(){
            return $this->title;
        }

        public function getBrowserTitle(){
            return $this->browserTitle;
        }

        public function renderPage(){
            echo "<h1>$this->browserTitle</h1>";
        }
    }
}
?>