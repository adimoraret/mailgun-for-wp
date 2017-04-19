<?php
namespace MailGunApiForWp\Utils\Email\Provider\Mailgun {
	class MailgunHttpProvider extends MailgunBaseProvider {
		const MAILGUN_SEND_URL = '';
		private $domain;
		private $apiKey;

		public function __construct( $domain, $apiKey ) {
			$this->domain = $domain;
			$this->apiKey = $apiKey;
		}

		public function sendEmail( $mailMessage ) {
			$requestBody = $this->convertMailMessageToRequestBody( $mailMessage );
			$headers     = $this->createRequestHeaders();
			$postData    = array(
				'body'    => $requestBody,
				'headers' => $headers
			);
			$url         = $this->getMailgunSendEmailUrl();

			return wp_remote_post( $url, $postData );
		}

		public function IsValid( $mailMessage ) {
			return false;
		}

		public function getValidationMessage() {
			return "Error in MailgunHttpProvider";
		}

		private function convertMailMessageToRequestBody( $mailMessage ) {
		}

		private function createRequestHeaders() {
		}

		private function getMailgunSendEmailUrl() {
			return "https://api.mailgun.net/v3/$this->domain/messages";
		}

	}
}