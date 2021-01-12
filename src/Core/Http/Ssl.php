<?php

namespace Topvisor\TinkoffSdk\Core\Http;

class Ssl {

	public string $certPath;
	public string $keyPath;
	public ?string $keyPasswd;

	public function __construct(string $certPath, string $keyPath, ?string $keyPasswd = NULL) {
		$this->certPath = $certPath;
		$this->keyPath = $keyPath;
		$this->keyPasswd = $keyPasswd;
	}

}