<?php

namespace Topvisor\TinkoffSdk\Business;

class BankStatement {

	public string $accountNumber;
	public int $saldoIn;
	public int $income;
	public int $outcome;
	public int $saldoOut;
	public ?array $operation = NULL;

}