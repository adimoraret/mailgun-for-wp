<?php
namespace MailGunApiForWp\Utils\String {
    final class StringHelper {
        public static function endsWith($string, $substring) {
            $stringLength = strlen($string);
            $substringLength = strlen($substring);
            if ($substringLength > $stringLength) return false;
            return substr_compare($string, $substring, $stringLength - $substringLength, $substringLength) === 0;
        }
    }
}