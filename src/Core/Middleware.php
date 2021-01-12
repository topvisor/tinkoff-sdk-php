<?php

namespace Topvisor\TinkoffSdk\Core;

use Topvisor\TinkoffSdk\Core\Http\Request;
use Topvisor\TinkoffSdk\Core\Http\Response;

interface Middleware {

	public function onRequest(Request $req): void;
	public function onResponse(Response $resp): void;

}