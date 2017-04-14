<?php
namespace MailGunApiForWp\Utils\MailGun {
    class MailgunSmtpProvider extends MailgunBaseProvider {

        private $username;
        private $password;
        private $message;
        private $hostname;
        private $to;
        private $subject;

        function __construct() {
        }
        /*function __construct($to,
                             $subject,
                             $message,
                             $hostname,
                             $username,
                             $password) {
            $this->to = $to;
            $this->subject = $subject;
            $this->message = $message;
            $this->hostname = $hostname;
            $this->username = $username;
            $this->password = $password;
        }
*/
        public function sendEmail() {
            wp_mail($this->to, $this->subject, $this->message);
        }
    }
}