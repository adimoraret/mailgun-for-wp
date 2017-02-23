<?php
    namespace MailGunApiForWp\Settings {
        class Settings{
            
            private function __construct(){

            }

            public static function GetInstance(){
                static $inst = null;
                if ($inst === null) {
                    $inst = new Settings();
                }
                return $inst;
            } 
        }
    }
?>
