<?php

namespace Topvisor\TinkoffSdk\Business;

use Topvisor\TinkoffSdk\Core\ArrayParser;
use Topvisor\TinkoffSdk\Core\Http\Client;
use Topvisor\TinkoffSdk\Core\Http\Request;
use Topvisor\TinkoffSdk\Core\JsonParser;
use Topvisor\TinkoffSdk\Core\ParsersChain;
use Topvisor\TinkoffSdk\Core\Service;
use Topvisor\TinkoffSdk\Id\Session;

class BankAccountsService {

	private const URL = Service::ENDPOINT_BUSINESS . '/api/v2/bank-accounts';

	private const GET_URL = self::URL;
	private const GET_METHOD = 'GET';
	private const GET_HEADERS = ['Content-Type' => ['application/json']];

	private Service $service;

	public function __construct(Session $session) {
		$this->service = new Service();
		$this->service->addMiddleware($session);
		$this->service->addMiddleware(new ErrorThrower());
	}

	public function __destruct() {
		unset($this->service);
	}

	public function get(?Client $http = NULL): array {
		$req = new Request(self::GET_URL);
		$req->headers->valuesByName = self::GET_HEADERS;
		$req->method = self::GET_METHOD;

		$resp = $this->service->send($req, $http);
		$parser = new ParsersChain(JsonParser::instance(), new ArrayParser(BankAccountParser::instance()));

		return $parser->parse($resp->body);
	}

}