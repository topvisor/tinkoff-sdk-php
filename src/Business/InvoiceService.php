<?php

namespace Topvisor\TinkoffSdk\Business;

use Topvisor\TinkoffSdk\Core\Http\Client;
use Topvisor\TinkoffSdk\Core\Http\Request;
use Topvisor\TinkoffSdk\Core\JsonParser;
use Topvisor\TinkoffSdk\Core\ParsersChain;
use Topvisor\TinkoffSdk\Core\Service;
use Topvisor\TinkoffSdk\Id\Session;

class InvoiceService {

	private const URL = Service::ENDPOINT_BUSINESS . '/api/v1/invoice/send';

	private const ADD_URL = self::URL;
	private const ADD_METHOD = 'POST';
	private const ADD_HEADERS = ['Content-Type' => ['application/json']];

	private Service $service;

	public function __construct(Session $session) {
		$this->service = new Service();
		$this->service->addMiddleware($session);
		$this->service->addMiddleware(new ErrorThrower());
	}

	public function __destruct() {
		unset($this->service);
	}

	public function add(Invoice $invoice, ?Client $http = NULL): InvoicePdf {
		$req = new Request(self::ADD_URL);
		$req->headers->valuesByName = self::ADD_HEADERS;
		$req->method = self::ADD_METHOD;
		$req->body = json_encode($invoice);

		var_dump($req->body);
		exit();

		$resp = $this->service->send($req, $http);
		$parser = new ParsersChain(JsonParser::instance(), InvoicePdfParser::instance());

		return $parser->parse($resp->body);
	}

}