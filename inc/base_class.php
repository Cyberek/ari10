<?php
class AriClass {
	protected string $widget_id;
	protected string $widget_secret;
	protected float $transaction_amount;
	protected string $transaction_currency;
	protected string $return_url;

	protected string $api_backend;

	protected array $partner_metadata;

	const TEST_EMAIL = 'marcin.bobowski@ari10.com';
	const TEST_PHONE_NR = '48999999999';
	const TEST_WEBHOOK_URL = 'https://webhook.site/3db218f6-7918-45d0-a069-fec0c912901f';
	const API_DEV_BACKEND = 'https://gateway-dev.ari10.com/goods/transaction';
	const API_PRD_BACKEND = 'https://gateway.ari10.com/goods/transaction';

	const ENABLE_PROXY = false;

	public function __construct(string $widget_id, string $widget_secret, bool $is_prod=false, array $partner_metadata=array()) {
		$this->widget_id = $widget_id;
		$this->widget_secret = $widget_secret;
		$this->return_url = self::TEST_WEBHOOK_URL;

		if ($is_prod) {
			$this->api_backend = self::API_PRD_BACKEND;
		} else {
			$this->api_backend = self::API_DEV_BACKEND;
		}

		if (!empty($partner_metadata)) {
			$this->partner_metadata = $partner_metadata;
		} else {
			$this->partner_metadata = array();
		}
	}

	public function setAmount(float $transaction_amount) {
		$this->transaction_amount = $transaction_amount;
	}

	public function setCurrency(string $transaction_currency) {
		$this->transaction_currency = $transaction_currency;
	}

	private function calculateNoDecimalsAmount(float $transaction_amount) {
		return $transaction_amount * 100;
	}

	private function constructSignatureStr() {
		$no_decimals_amount = $this->calculateNoDecimalsAmount($this->transaction_amount);
		return $no_decimals_amount . $this->transaction_currency . $this->return_url;
	}	

	private function calculateTransactionSignature() {
		$signature_string = $this->constructSignatureStr();
		return hash_hmac('sha256', $signature_string, $this->widget_secret);
	}

	private function calculateTransactionId() {
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $this->api_backend);
		curl_setopt($ch, CURLOPT_POST, 1);

		$post_fields_array = array(
			'widgetBaseUrl' => $this->return_url,
			'offeredCurrencyCode' => $this->transaction_currency,
			'offeredAmount' => $this->transaction_amount,
			'signature' => $this->calculateTransactionSignature()
		);

		if (!empty($this->partner_metadata)) {
			$post_fields_array['partnerMetadata'] = $this->partner_metadata;
		}

		$post_fields = json_encode($post_fields_array);

		curl_setopt($ch, CURLOPT_POSTFIELDS, $post_fields);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, [
			'Content-Type: application/json',
			'Ari10-Widget-Id: '.$this->widget_id
		]);

		if (self::ENABLE_PROXY) {
			$proxy = '127.0.0.1:8080';
			curl_setopt($ch, CURLOPT_PROXY, $proxy);
		}

		$ch_response = curl_exec($ch);
		$response_json = json_decode($ch_response, false);
		return $response_json->transactionId;
	}

	public function getApiBackend() {
		return $this->api_backend;
	}

	public function getTestEmail() {
		return self::TEST_EMAIL;
	}

	public function getTestPhoneNr() {
		return self::TEST_PHONE_NR;
	}

	public function getWidgetId() {
		return $this->widget_id;
	}

	public function getWidgetSecret() {
		return $this->widget_secret;
	}

	public function getTransactionAmount() {
		return $this->transaction_amount;
	}

	public function getTransactionCurrency() {
		return $this->transaction_currency;
	}

	public function getReturnUrl() {
		return $this->return_url;
	}

	public function getSignatureStr() {
		return $this->constructSignatureStr();
	}

	public function getTransactionSignature() {
		return $this->calculateTransactionSignature();
	}

	public function getTransactionId() {
		return $this->calculateTransactionId();
	}
}

?>