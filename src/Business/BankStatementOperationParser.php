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

		$operation->id = $raw->id ?? NULL;
		$operation->amount = $raw->amount ?? NULL;
		$operation->date = new \DateTime($raw->date);
		$operation->drawDate = new \DateTime($raw->drawDate);
		$operation->chargeDate = new \DateTime($raw->chargeDate);
		$operation->operationType = $raw->operationType ?? NULL;
		$operation->paymentPurpose = $raw->paymentPurpose ?? NULL;
		$operation->creatorStatus = $raw->creatorStatus ?? NULL;
	}

	private function parsePayer(BankStatementOperation $operation, \stdClass $raw): void {
		$operation->payerName = $raw->payerName ?? NULL;
		$operation->payerBic = $raw->payerBic ?? NULL;
		$operation->payerBank = $raw->payerBank ?? NULL;

		if (isset($raw->payerInn))
			$operation->payerInn = $raw->payerInn;

		if (isset($raw->payerAccount))
			$operation->payerAccount = $raw->payerAccount;

		if (isset($raw->payerCorrAccount))
			$operation->payerCorrAccount = $raw->payerCorrAccount;

		if (isset($raw->payerKpp))
			$operation->payerKpp = $raw->payerKpp;
	}

	private function parseRecipient(BankStatementOperation $operation, \stdClass $raw): void {
		$operation->recipient = $raw->recipient ?? NULL;
		$operation->recipientAccount = $raw->recipientAccount ?? NULL;
		$operation->recipientBic = $raw->recipientBic ?? NULL;
		$operation->recipientBank = $raw->recipientBank ?? NULL;

		if (isset($raw->recipientInn))
			$operation->recipientInn = $raw->recipientInn;

		if (isset($raw->recipientCorrAccount))
			$operation->recipientCorrAccount = $raw->recipientCorrAccount;

		if (isset($raw->recipientKpp))
			$operation->recipientKpp = $raw->recipientKpp;
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