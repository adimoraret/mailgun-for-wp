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
				'headers' => $headers,
				'body'    => $requestBody
			);
			$url         = $this->getMailgunSendEmailUrl();

			return wp_remote_post( $url, $postData );
		}

		public function IsValid( $mailMessage ) {
			$this->validateRecipients($mailMessage);
			$this->validateSubject($mailMessage);
			$this->validateMessage($mailMessage);
			$this->validateHttpSettings();
			return $this->validationMessage === '';
		}

		public function getValidationMessage() {
			return $this->validationMessage;
		}

		private function convertMailMessageToRequestBody( $mailMessage ) {
			return array(
				'from' => $this->getFromNameAndEmail(),
				'to' => $mailMessage->getTo(),
				'subject' => $mailMessage->getSubject(),
				'html' => $mailMessage->getMessage()
			);
		}

		private function createRequestHeaders() {
			return array(
				'Authorization' => 'Basic '.base64_encode('api:' . $this->apiKey)
			);
		}

		private function getMailgunSendEmailUrl() {
			return 'https://api.mailgun.net/v3/' . $this->domain . '/messages';
		}

		private function getFromNameAndEmail(){
			if (empty($this->fromName)) return $this->from;
			return $this->fromName . '<' . $this->from . '>';
		}

		private function validateHttpSettings() {
			if (empty($this->domain)) {
				$this->validationMessage .= 'Domain was not set yet.';
			}
			if (empty($this->apiKey)) {
				$this->validationMessage .= 'Api key was not set yet.';
			}
		}
	}
}