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

		if (isset($raw->otb))
			$balance->otb = $raw->otb;
		if (isset($raw->authorized))
			$balance->authorized = $raw->authorized;
		if (isset($raw->pendingPayments))
			$balance->pendingPayments = $raw->pendingPayments;
		if (isset($raw->pendingRequisitions))
			$balance->pendingRequisitions = $raw->pendingRequisitions;

		return $balance;
	}

}