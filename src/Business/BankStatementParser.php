<?php

namespace Topvisor\TinkoffSdk\Business;

use Topvisor\TinkoffSdk\Core\Parser;

class BankStatementParser implements Parser {

	private static ?self $instance = NULL;

	private function __construct() {}

	public static function instance(): self {
		if (!self::$instance)
			self::$instance = new self();

		return self::$instance;
	}

	public function parse($raw) {
		$statement = new BankStatement();

		$statement->accountNumber = $raw->accountNumber ?? NULL;
		$statement->saldoIn = $raw->saldoIn ?? NULL;
		$statement->income = $raw->income ?? NULL;
		$statement->outcome = $raw->outcome ?? NULL;
		$statement->saldoOut = $raw->saldoOut ?? NULL;

		if (isset($raw->operation)) {
			if (!is_array($raw->operation))
				throw new \Exception('wrong bank statement: ' . json_encode($raw));

			$statement->operation = [];

			foreach ($raw->operation as $rawOperation)
				$statement->operation[] = BankStatementOperationParser::instance()->parse($rawOperation);
		}

		return $statement;
	}
}