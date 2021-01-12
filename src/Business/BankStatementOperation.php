<?php

namespace Topvisor\TinkoffSdk\Business;

class BankStatementOperation {

	public string $id;
	public int $amount;
	public \DateTime $date;
	public \DateTime $drawDate;
	public \DateTime $chargeDate;
	public string $operationType;
	public string $paymentPurpose;
	public string $creatorStatus;

	public string $payerName;
	public ?string $payerInn;
	public ?string $payerAccount;
	public ?string $payerCorrAccount;
	public string $payerBic;
	public string $payerBank;
	public ?string $payerKpp;

	public string $recipient;
	public ?string $recipientInn;
	public string $recipientAccount;
	public ?string $recipientCorrAccount;
	public string $recipientBic;
	public string $recipientBank;
	public ?string $recipientKpp;

	public ?string $paymentType;
	public ?string $uin;
	public ?string $kbk;
	public ?string $oktmo;
	public ?string $taxEvidence;
	public ?string $taxPeriod;
	public ?string $taxDocNumber;
	public ?string $taxDocDate;
	public ?string $taxType;
	public ?string $executionOrder;

}