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
		if (isset($raw->accountNumber))
			$bankAccount->accountNumber = $raw->accountNumber;
		if (isset($raw->name))
			$bankAccount->name = $raw->name;
		if (isset($raw->currency))
			$bankAccount->currency = $raw->currency;
		if (isset($raw->bankBik))
			$bankAccount->bankBik = $raw->bankBik;
		if (isset($raw->accountType))
			$bankAccount->accountType = $raw->accountType;
		if (isset($raw->balance))
			$bankAccount->balance = $raw->balance;

		if (isset($raw->transitAccount))
			$bankAccount->transitAccount = TransitAccountParser::instance()->parse($raw->transitAccount);

		return $bankAccount;
	}

}