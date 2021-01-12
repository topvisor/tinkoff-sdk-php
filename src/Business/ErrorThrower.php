<?php

namespace Topvisor\TinkoffSdk\Business;

use Topvisor\TinkoffSdk\Core\Http\Request;
use Topvisor\TinkoffSdk\Core\Http\Response;
use Topvisor\TinkoffSdk\Core\Middleware;

class ErrorThrower implements Middleware {

	public function onRequest(Request $req): void {}

	public function onResponse(Response $resp): void {
		if ($resp->code != 200)
			throw ErrorParser::instance()->parse($resp);
	}

}