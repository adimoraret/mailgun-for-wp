<?php
namespace MailGunApiForWp\Utils { 
    final class WordpressUtil{
        private function __construct(){

        }

        public static function isMultisite()
		{
			return is_multisite();
		}

        public static function getFormAction(){
            return self::isMultisite() ? '' : 'options.php';
        }
    }
}