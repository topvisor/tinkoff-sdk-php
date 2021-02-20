<?php

namespace Topvisor\TinkoffSdk\Business;

use Topvisor\TinkoffSdk\Core\Parser;

class TransitAccountParser implements Parser {

	private static ?self $instance = NULL;

	private function __construct() {}

	public static function instance(): self {
		if (!self::$instance)
			self::$instance = new self();

		return self::$instance;
	}

	public function parse($raw) {
		$transitAccount = new TransitAccount();
		if (isset($raw->accountNumber))
			$transitAccount->accountNumber = $raw->accountNumber;
		if (isset($raw->balance))
			$transitAccount->balance = $raw->balance;

		return $transitAccount;
	}

}