<?php

namespace Topvisor\TinkoffSdk\Core;

use Topvisor\TinkoffSdk\Core\Http\Request;
use Topvisor\TinkoffSdk\Core\Http\Response;

class HttpErrorThrower implements Middleware {

	public function onRequest(Request $req): void {}

	public function onResponse(Response $resp): void {
		if ($resp->code != 200)
			throw new \Exception("http: ($resp->code) $resp->body", $resp->code);
	}

}