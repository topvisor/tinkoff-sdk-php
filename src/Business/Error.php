<?php

namespace Topvisor\TinkoffSdk\Business;

use Topvisor\TinkoffSdk\Core\Http\Response;
use Topvisor\TinkoffSdk\Core\Service;
use Throwable;

class Error extends \Exception {

	public function __construct($message = "", $code = 0, Throwable $previous = null){
		parent::__construct($message, $code, $previous);
	}

	public int $statusCode;
	public ?string $xRequestId;
	public ?string $id;
	public ?array $details;

}