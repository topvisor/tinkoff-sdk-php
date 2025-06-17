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

        $statement->balances = $raw->balances ?? NULL;

        if (isset($raw->operations)) {
            if (!is_array($raw->operations))
                throw new \Exception('wrong bank statement: ' . json_encode($raw));

            $statement->operations = [];

            foreach ($raw->operations as $rawOperation)
                $statement->operations[] = BankStatementOperationParser::instance()->parse($rawOperation);
        }

        return $statement;
    }
}
