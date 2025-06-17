<?php

namespace Topvisor\TinkoffSdk\Business;

use Topvisor\TinkoffSdk\Core\Http\Client;
use Topvisor\TinkoffSdk\Core\Http\Request;
use Topvisor\TinkoffSdk\Core\JsonParser;
use Topvisor\TinkoffSdk\Core\ParsersChain;
use Topvisor\TinkoffSdk\Core\Service;
use Topvisor\TinkoffSdk\Id\Session;

class BankStatementService {

	private const URL = Service::ENDPOINT_BUSINESS . '/api/v1/statement';

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

	public function get(string $accountNumber, ?\DateTime $from = null, ?\DateTime $to = null, ?Client $http = null): BankStatement {
		$queryData = [
			'accountNumber' => $accountNumber,
			'limit' => 5000,
		];

		if ($from)
			$queryData['from'] = $from->format('Y-m-d\TH:i:s\Z');

		if ($to) {
			$queryData['to'] = $to->format('Y-m-d\TH:i:s\Z');
		}

		$url = self::GET_URL . '?' . http_build_query($queryData);

		$req = new Request($url);
		$req->headers->valuesByName = self::GET_HEADERS;
		$req->method = self::GET_METHOD;

		$resp = $this->service->send($req, $http);
		$parser = new ParsersChain(JsonParser::instance(), BankStatementParser::instance());

		return $parser->parse($resp->body);
	}

}
