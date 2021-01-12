<?php

namespace Topvisor\TinkoffSdk\Id;

use Topvisor\TinkoffSdk\Core\Parser;

class AuthTokenParser implements Parser {

	private static ?self $instance = NULL;

	private function __construct() {}

	public static function instance(): self {
		if (!self::$instance)
			self::$instance = new self();

		return self::$instance;
	}

	public function parse($raw) {
		return new AuthToken(
			$raw->access_token ?? NULL,
			($raw->expires_in ?? NULL) + time(),
			$raw->refresh_token ?? NULL
		);
	}

}