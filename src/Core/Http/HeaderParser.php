<?php

namespace Topvisor\TinkoffSdk\Core\Http;

class HeaderParser {

	private static ?self $instance = NULL;

	private function __construct() {}

	public static function instance(): self {
		if (!self::$instance)
			self::$instance = new self();

		return self::$instance;
	}

	public function parse(string $headerRaw): Header {
		$headerChunks = explode(":", $headerRaw, 2);

		if (count($headerChunks) !== 2)
			throw new \Exception('wrong $headerRaw: ' . $headerRaw);

		return new Header($headerChunks[0], $headerChunks[1]);
	}

}