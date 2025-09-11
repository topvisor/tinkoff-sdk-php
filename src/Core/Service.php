<?php

namespace Topvisor\TinkoffSdk\Core;

use Topvisor\TinkoffSdk\Core\Http\Client;
use Topvisor\TinkoffSdk\Core\Http\Curl;
use Topvisor\TinkoffSdk\Core\Http\Request;
use Topvisor\TinkoffSdk\Core\Http\Response;

class Service {

	public const ENDPOINT_ID = 'https://id.tbank.ru';
	public const ENDPOINT_BUSINESS = 'https://business.tbank.ru/openapi';
	public const ENDPOINT_SECURED_BUSINESS = 'https://secured-openapi.business.tbank.ru';

	public const HEADER_NAME_REQUEST_ID = 'X-Request-Id';

	private array $middlewares = [];

	public function __destruct() {
		for ($i = 0; $i < count($this->middlewares); $i++)
			unset($this->middlewares[$i]);
	}

	public function addMiddleware(Middleware $middleware) {
		$this->middlewares[] = $middleware;
	}

	public function send(Request $req, ?Client $http = NULL): Response {
		$http = $http ?? new Curl();

		foreach ($this->middlewares as $middleware) {
			$middleware->onRequest($req);
		}

		$resp = $http->send($req);

		foreach (array_reverse($this->middlewares) as $middleware) {
			$middleware->onResponse($resp);
		}

		return $resp;
	}

}
