<?php

namespace Topvisor\TinkoffSdk\Core\Http;

class HeadersParser {

	private static ?self $instance = NULL;

	private function __construct() {}

	public static function instance(): self {
		if (!self::$instance)
			self::$instance = new self();

		return self::$instance;
	}

	public function parse(string $headersRaw): Headers {
		$headersRaw = trim($headersRaw);
		$headersRaw = explode("\r\n", $headersRaw);

		if (strpos($headersRaw[0], "HTTP/") === 0)
			array_shift($headersRaw);

		$headers = new Headers();

		foreach ($headersRaw as $headerRaw)
			$headers->add(HeaderParser::instance()->parse($headerRaw));

		return $headers;
	}

}