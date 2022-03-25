<?php

namespace Topvisor\TinkoffSdk\Business;

class BankStatement {

	public string $accountNumber;
	public float $saldoIn;
	public float $income;
	public float $outcome;
	public float $saldoOut;
	public ?array $operation = NULL;

}
