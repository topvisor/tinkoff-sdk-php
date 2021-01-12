<?php

namespace Topvisor\TinkoffSdk\Business;

use Topvisor\TinkoffSdk\Core\Parser;

class BankAccountParser implements Parser {

	private static ?self $instance = NULL;

	private function __construct() {}

	public static function instance(): self {
		if (!self::$instance)
			self::$instance = new self();

		return self::$instance;
	}

	public function parse($raw) {
		$bankAccount = new BankAccount();
		$bankAccount->accountNumber = $raw->accountNumber ?? NULL;
		$bankAccount->name = $raw->name ?? NULL;
		$bankAccount->currency = $raw->currency ?? NULL;
		$bankAccount->bankBik = $raw->bankBik ?? NULL;
		$bankAccount->accountType = $raw->accountType ?? NULL;
		$bankAccount->balance = BalanceParser::instance()->parse($raw->balance ?? NULL);

		if (isset($raw->transitAccount))
			$bankAccount->transitAccount = TransitAccountParser::instance()->parse($raw->transitAccount);

		return $bankAccount;
	}

}