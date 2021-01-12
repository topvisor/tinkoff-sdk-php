<?php

namespace Topvisor\TinkoffSdk\Core\Http;

class Request {

	public string $url;
	public Headers $headers;
	public ?string $body;
	public string $method;
	public ?Ssl $ssl;

	public function __construct(string $url, ?Headers $headers = NULL, ?string $body = NULL, string $method = "", ?Ssl $ssl = NULL) {
		$this->url = $url;
		$this->headers = $headers ?? new Headers();
		$this->body = $body;
		$this->method = $method;
		$this->ssl = $ssl;

		if (!$this->method) {
			if ($body)
				$this->method = "POST";
			else
				$this->method = "GET";
		}
	}

	public function __destruct(){
		unset($this->headers);
		unset($this->ssl);
	}

}