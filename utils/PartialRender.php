<?php
    namespace MailGunApiForWp\Utils{
        class PartialRender{
            private function __construct() {
            }

           	public static function getInstance() {
                static $instance = null;
                return null !== $instance ? $instance : $instance = new self();
            }

            public function render($partialFilePath) {
                include_once $partialFilePath;
            }
        }
    }
?>