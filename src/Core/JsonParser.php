<?php

namespace Topvisor\TinkoffSdk\Core;

class JsonParser implements Parser {

	private static ?self $instance = NULL;

	private function __construct() {}

	public static function instance(): self {
		if (!self::$instance)
			self::$instance = new self();

		return self::$instance;
	}

	public function parse($raw) {
		$decoded = NULL;

		if (is_string($raw))
			$decoded = json_decode($raw);
		else
			$decoded = $raw;

		if (is_null($decoded))
			throw new \Exception('wrong json: ' . $raw);

		return $decoded;
	}

}