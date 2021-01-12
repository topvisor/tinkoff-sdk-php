<?php

namespace Topvisor\TinkoffSdk\Business;

use Topvisor\TinkoffSdk\Core\Parser;

class BalanceParser implements Parser {

	private static ?self $instance = NULL;

	private function __construct() {}

	public static function instance(): self {
		if (!self::$instance)
			self::$instance = new self();

		return self::$instance;
	}

	public function parse($raw) {
		$balance = new Balance();
		$balance->otb = $raw->otb ?? NULL;
		$balance->authorized = $raw->authorized ?? NULL;
		$balance->pendingPayments = $raw->pendingPayments ?? NULL;
		$balance->pendingRequisitions = $raw->pendingRequisitions ?? NULL;

		return $balance;
	}

}