<?php

namespace Topvisor\TinkoffSdk\Core\Http;

interface Client {

	function send(Request $req): Response;

}