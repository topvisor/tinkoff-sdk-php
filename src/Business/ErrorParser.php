<?php

namespace Topvisor\TinkoffSdk\Business;

use Topvisor\TinkoffSdk\Core\Http\Response;
use Topvisor\TinkoffSdk\Core\Service;

class ErrorParser {

	private static ?self $instance = NULL;

	private function __construct() {}

	public static function instance(): self {
		if (!self::$instance)
			self::$instance = new self();

		return self::$instance;
	}

	public function parse(Response $resp): Error {
		$data = json_decode($resp->body, true);

		$message = $data['errorMessage'] ?? "http: ($resp->code)";

		if (isset($data['errorCode']))
			$message = "$data[errorCode]: $message";

		$error = new Error($message, $resp->code);
		$error->xRequestId = $resp->headers->get(Service::HEADER_NAME_REQUEST_ID)[0] ?? NULL;
		$error->id = $data['errorId'] ?? NULL;
		$error->details = $data['errorDetails'] ?? NULL;

		return $error;
	}

}