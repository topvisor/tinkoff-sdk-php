<?php

namespace Topvisor\TinkoffSdk\Business;

use Topvisor\TinkoffSdk\Core\Parser;

class BankStatementOperationParser implements Parser {

	private static ?self $instance = NULL;

	private function __construct() {}

	public static function instance(): self {
		if (!self::$instance)
			self::$instance = new self();

		return self::$instance;
	}

	public function parse($raw) {
		$operation = new BankStatementOperation();

		$this->parseRequired($operation, $raw);
		$this->parsePayer($operation, $raw);
		$this->parseRecipient($operation, $raw);
		$this->parseAdditional($operation, $raw);

		return $operation;
	}

	private function parseRequired(BankStatementOperation $operation, \stdClass $raw): void {
		if (!isset($raw->date) || !isset($raw->drawDate) || !isset($raw->chargeDate))
			throw new \Exception('wrong bank statement operation: ' . json_encode($raw));

        if (isset($raw->id))
            $operation->id = $raw->id;
        if (isset($raw->operationId))
            $operation->operationId = $raw->operationId;
		if (isset($raw->amount))
			$operation->amount = $raw->amount;
		if (isset($raw->date))
			$operation->date = $raw->date;
		if (isset($raw->drawDate))
			$operation->drawDate = $raw->drawDate;
		if (isset($raw->chargeDate))
			$operation->chargeDate = $raw->chargeDate;
		if (isset($raw->operationType))
			$operation->operationType = $raw->operationType;
		if (isset($raw->paymentPurpose))
			$operation->paymentPurpose = $raw->paymentPurpose;
		if (isset($raw->creatorStatus))
			$operation->creatorStatus = $raw->creatorStatus;
	}

	private function parsePayer(BankStatementOperation $operation, \stdClass $raw): void {
		$operation->payerInn = $raw->payerInn ?? NULL;
		$operation->payerAccount = $raw->payerAccount ?? NULL;
		$operation->payerCorrAccount = $raw->payerCorrAccount ?? NULL;
		$operation->payerKpp = $raw->payerKpp ?? NULL;

		if (isset($raw->payerName))
			$operation->payerName = $raw->payerName;

		if (isset($raw->payerBic))
			$operation->payerBic = $raw->payerBic;

		if (isset($raw->payerBank))
			$operation->payerBank = $raw->payerBank;
	}

	private function parseRecipient(BankStatementOperation $operation, \stdClass $raw): void {
		$operation->recipientInn = $raw->recipientInn ?? NULL;
		$operation->recipientCorrAccount = $raw->recipientCorrAccount ?? NULL;
		$operation->recipientKpp = $raw->recipientKpp ?? NULL;

		if (isset($raw->recipient))
			$operation->recipient = $raw->recipient;

		if (isset($raw->recipientAccount))
			$operation->recipientAccount = $raw->recipientAccount;

		if (isset($raw->recipientBic))
			$operation->recipientBic = $raw->recipientBic;

		if (isset($raw->recipientBank))
			$operation->recipientBank = $raw->recipientBank;
	}

	private function parseAdditional(BankStatementOperation $operation, \stdClass $raw): void {
		if (isset($raw->paymentType))
			$operation->paymentType = $raw->paymentType;

		if (isset($raw->uin))
			$operation->uin = $raw->uin;

		if (isset($raw->kbk))
			$operation->kbk = $raw->kbk;

		if (isset($raw->oktmo))
			$operation->oktmo = $raw->oktmo;

		if (isset($raw->taxEvidence))
			$operation->taxEvidence = $raw->taxEvidence;

		if (isset($raw->taxPeriod))
			$operation->taxPeriod = $raw->taxPeriod;

		if (isset($raw->taxDocNumber))
			$operation->taxDocNumber = $raw->taxDocNumber;

		if (isset($raw->taxDocDate))
			$operation->taxDocDate = $raw->taxDocDate;

		if (isset($raw->taxType))
			$operation->taxType = $raw->taxType;

		if (isset($raw->executionOrder))
			$operation->executionOrder = $raw->executionOrder;
	}

}