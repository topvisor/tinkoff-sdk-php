<?php

namespace Topvisor\TinkoffSdk\Business;

class BankStatementOperation {

	public string $id;
	public int $amount;
	public string $date;
	public string $drawDate;
	public string $chargeDate;
	public string $operationType;
	public string $paymentPurpose;
	public string $creatorStatus;

	public string $payerName;
	public ?string $payerInn = NULL;
	public ?string $payerAccount = NULL;
	public ?string $payerCorrAccount = NULL;
	public string $payerBic;
	public string $payerBank;
	public ?string $payerKpp = NULL;

	public string $recipient;
	public ?string $recipientInn = NULL;
	public string $recipientAccount;
	public ?string $recipientCorrAccount = NULL;
	public string $recipientBic;
	public string $recipientBank;
	public ?string $recipientKpp = NULL;

	public ?string $paymentType = NULL;
	public ?string $uin = NULL;
	public ?string $kbk = NULL;
	public ?string $oktmo = NULL;
	public ?string $taxEvidence = NULL;
	public ?string $taxPeriod = NULL;
	public ?string $taxDocNumber = NULL;
	public ?string $taxDocDate = NULL;
	public ?string $taxType = NULL;
	public ?string $executionOrder = NULL;

}