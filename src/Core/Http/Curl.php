<?php

namespace Topvisor\TinkoffSdk\Core\Http;

class Curl implements Client {

	private $handle = NULL;
	private array $options = [CURLOPT_TIMEOUT => 10];

	public function __construct(array $options = []) {
		foreach ($options as $key => $val) {
			$this->options[$key] = $val;
		}
	}

	public function __destruct() {
		$this->close();
	}

	public function send(Request $req): Response {
		$options = $this->options;
		$options[CURLOPT_URL] = $req->url;
		$options[CURLOPT_HTTPHEADER] = $req->headers->getAllStrings();
		$options[CURLOPT_CUSTOMREQUEST] = $req->method;
		$options[CURLOPT_POSTFIELDS] = $req->body;
		$options[CURLOPT_RETURNTRANSFER] = true;
		$options[CURLOPT_HEADER] = true;

		if ($req->ssl) {
			$options[CURLOPT_SSLCERT] = $req->ssl->certPath;
			$options[CURLOPT_SSLKEY] = $req->ssl->keyPath;

			if ($req->ssl->keyPasswd)
				$options[CURLOPT_SSLKEYPASSWD] = $req->ssl->keyPasswd;
		}

		if (!$this->handle)
			$this->handle = curl_init();

		curl_setopt_array($this->handle, $options);
		$respRaw = curl_exec($this->handle);

		if ($errorCode = curl_errno($this->handle))
			throw new \Exception("curl: ($errorCode) " . curl_error($this->handle), $errorCode);

		$respRaw = explode("\r\n\r\n", $respRaw);
		$body = array_pop($respRaw)??'';
		$headersRaw = array_pop($respRaw)??'';

		$resp = new Response();
		$resp->code = (int) curl_getinfo($this->handle, CURLINFO_RESPONSE_CODE);
		$resp->headers = HeadersParser::instance()->parse($headersRaw);
		$resp->body = $body;

		return $resp;
	}

	public function close(): void {
		if ($this->handle) {
			$this->handle = NULL;
		}
	}

}