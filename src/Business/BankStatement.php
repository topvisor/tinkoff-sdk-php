<?php

namespace Topvisor\TinkoffSdk\Business;

use stdClass;

class BankStatement {

	/**
	 * @var BankStatementOperation[]|null
	 */
	public ?array $operations = null;

	public ?stdClass $balances = null;

}
