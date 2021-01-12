<?php

namespace Topvisor\TinkoffSdk\Id;

class AuthToken {

	public string $accessToken;
	public int $expires;
	public ?string $refreshToken;

	public function __construct(string $accessToken, int $expires, ?string $refreshToken = NULL){
		$this->accessToken = $accessToken;
		$this->expires = $expires;
		$this->refreshToken = $refreshToken;
	}

	public function isExpired(): bool {
		if ($this->expires > time()) {
			$isExpired = false;
		} else {
			$isExpired = true;
		}

		return $isExpired;
	}

}