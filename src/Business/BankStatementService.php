<?php

namespace Topvisor\TinkoffSdk\Business;

use Topvisor\TinkoffSdk\Core\Http\Client;
use Topvisor\TinkoffSdk\Core\Http\Request;
use Topvisor\TinkoffSdk\Core\JsonParser;
use Topvisor\TinkoffSdk\Core\ParsersChain;
use Topvisor\TinkoffSdk\Core\Service;
use Topvisor\TinkoffSdk\Id\Session;

class BankStatementService {

	private const URL = Service::ENDPOINT_BUSINESS . '/api/v1/bank-statement';

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

	public function get(string $accountNumber, ?\DateTime $from = NULL, ?\DateTime $till = NULL, ?Client $http = NULL): BankStatement {
		$queryData = ['accountNumber' => $accountNumber];

		if ($from)
			$queryData['from'] = $from->format('Y-m-d+H:i:s');

		if ($till)
			$queryData['till'] = $till->format('Y-m-d+H:i:s');

		$url = self::GET_URL . '?' . http_build_query($queryData);

		$req = new Request($url);
		$req->headers->valuesByName = self::GET_HEADERS;
		$req->method = self::GET_METHOD;

		$resp = $this->service->send($req, $http);
		$parser = new ParsersChain(JsonParser::instance(), BankStatementParser::instance());

		return $parser->parse($resp->body);
	}


}