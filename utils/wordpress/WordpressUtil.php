<?php
namespace MailGunApiForWp\Utils\Wordpress {
    final class WordpressUtil {
        public static function isMultisite() {
			return is_multisite();
		}

        public static function getFormAction() {
            return self::isMultisite() ? '' : 'options.php';
        }
    }
}