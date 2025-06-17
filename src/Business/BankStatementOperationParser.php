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
		$this->parseReceiver($operation, $raw);
		$this->parseAdditional($operation, $raw);

		return $operation;
	}

	private function parseRequired(BankStatementOperation $operation, \stdClass $raw): void {
		if (!isset($raw->operationDate) || !isset($raw->operationId))
			throw new \Exception('wrong bank statement operation: ' . json_encode($raw));

        if (isset($raw->operationId))
            $operation->operationId = $raw->operationId;
		if (isset($raw->operationAmount))
			$operation->operationAmount = $raw->operationAmount;
		if (isset($raw->operationDate))
			$operation->operationDate = new \DateTime($raw->operationDate);
		if (isset($raw->drawDate))
			$operation->drawDate = new \DateTime($raw->drawDate);
		if (isset($raw->chargeDate))
			$operation->chargeDate = new \DateTime($raw->chargeDate);
		if (isset($raw->operationStatus))
			$operation->operationStatus = $raw->operationStatus;
		if (isset($raw->payPurpose))
			$operation->payPurpose = $raw->payPurpose;
		if (isset($raw->accountNumber))
			$operation->accountNumber = $raw->accountNumber;
		if (isset($raw->bic))
			$operation->bic = $raw->bic;
		if (isset($raw->typeOfOperation))
			$operation->typeOfOperation = $raw->typeOfOperation;
		if (isset($raw->category))
			$operation->category = $raw->category;
		if (isset($raw->trxnPostDate))
			$operation->trxnPostDate = new \DateTime($raw->trxnPostDate);
		if (isset($raw->authorizationDate))
			$operation->authorizationDate = new \DateTime($raw->authorizationDate);
		if (isset($raw->docDate))
			$operation->docDate = new \DateTime($raw->docDate);
		if (isset($raw->documentNumber))
			$operation->documentNumber = $raw->documentNumber;
		if (isset($raw->payVo))
			$operation->payVo = $raw->payVo;
		if (isset($raw->vo))
			$operation->vo = $raw->vo;
		if (isset($raw->priority))
			$operation->priority = $raw->priority;
		if (isset($raw->operationCurrencyDigitalCode))
			$operation->operationCurrencyDigitalCode = $raw->operationCurrencyDigitalCode;
		if (isset($raw->accountAmount))
			$operation->accountAmount = $raw->accountAmount;
		if (isset($raw->accountCurrencyDigitalCode))
			$operation->accountCurrencyDigitalCode = $raw->accountCurrencyDigitalCode;
		if (isset($raw->rubleAmount))
			$operation->rubleAmount = $raw->rubleAmount;
		if (isset($raw->description))
			$operation->description = $raw->description;
	}

	private function parsePayer(BankStatementOperation $operation, \stdClass $raw): void {
		$operation->payer = new \stdClass();
		$operation->payer->inn = null;
		$operation->payer->kpp = null;

		if (isset($raw->payer)) {
			if (isset($raw->payer->acct)) {
				$operation->payer->acct = $raw->payer->acct;
			}
			if (isset($raw->payer->inn)) {
				$operation->payer->inn = $raw->payer->inn;
			}
			if (isset($raw->payer->kpp)) {
				$operation->payer->kpp = $raw->payer->kpp;
			}
			if (isset($raw->payer->name)) {
				$operation->payer->name = $raw->payer->name;
			}
			if (isset($raw->payer->bicRu)) {
				$operation->payer->bicRu = $raw->payer->bicRu;
			}
			if (isset($raw->payer->bicSwift))
				$operation->payer->bicSwift = $raw->payer->bicSwift;
			if (isset($raw->payer->bankName)) {
				$operation->payer->bankName = $raw->payer->bankName;
			}
			if (isset($raw->payer->corAcct)) {
				$operation->payer->corAcct = $raw->payer->corAcct;
			}
		}
	}

	private function parseReceiver(BankStatementOperation $operation, \stdClass $raw): void {
		$operation->receiver = new \stdClass();

		// Handle receiver object if it exists in raw data
		if (isset($raw->receiver)) {
			if (isset($raw->receiver->acct)) {
				$operation->receiver->acct = $raw->receiver->acct;
			}
			if (isset($raw->receiver->inn)) {
				$operation->receiver->inn = $raw->receiver->inn;
			}
			if (isset($raw->receiver->kpp)) {
				$operation->receiver->kpp = $raw->receiver->kpp;
			}
			if (isset($raw->receiver->name)) {
				$operation->receiver->name = $raw->receiver->name;
			}
			if (isset($raw->receiver->bicRu)) {
				$operation->receiver->bicRu = $raw->receiver->bicRu;
			}
			if (isset($raw->receiver->bicSwift))
				$operation->receiver->bicSwift = $raw->receiver->bicSwift;
			if (isset($raw->receiver->bankName)) {
				$operation->receiver->bankName = $raw->receiver->bankName;
			}
			if (isset($raw->receiver->corAcct)) {
				$operation->receiver->corAcct = $raw->receiver->corAcct;
			}
		}
	}

	private function parseAdditional(BankStatementOperation $operation, \stdClass $raw): void {
		if (isset($raw->cardNumber))
			$operation->cardNumber = $raw->cardNumber;

		if (isset($raw->ucid))
			$operation->ucid = $raw->ucid;

		if (isset($raw->mcc))
			$operation->mcc = $raw->mcc;

		if (isset($raw->authCode))
			$operation->authCode = $raw->authCode;

		if (isset($raw->rrn))
			$operation->rrn = $raw->rrn;

		if (isset($raw->acquirerId))
			$operation->acquirerId = $raw->acquirerId;

		if (isset($raw->counterParty)) {
			$operation->counterParty = new \stdClass();

			if (isset($raw->counterParty->account))
				$operation->counterParty->account = $raw->counterParty->account;
			$operation->counterParty->inn = $raw->counterParty->inn ?? null;
			$operation->counterParty->kpp = $raw->counterParty->kpp ?? null;
			if (isset($raw->counterParty->name))
				$operation->counterParty->name = $raw->counterParty->name;
			if (isset($raw->counterParty->bankName))
				$operation->counterParty->bankName = $raw->counterParty->bankName;
			if (isset($raw->counterParty->bankBic))
				$operation->counterParty->bankBic = $raw->counterParty->bankBic;
			if (isset($raw->counterParty->bankSwiftCode))
				$operation->counterParty->bankSwiftCode = $raw->counterParty->bankSwiftCode;
			if (isset($raw->counterParty->corrAccount))
				$operation->counterParty->corrAccount = $raw->counterParty->corrAccount;
		}

		if (isset($raw->merch)) {
			$operation->merch = new \stdClass();

			if (isset($raw->merch->name))
				$operation->merch->name = $raw->merch->name;
			if (isset($raw->merch->address))
				$operation->merch->address = $raw->merch->address;
			if (isset($raw->merch->city))
				$operation->merch->city = $raw->merch->city;
			if (isset($raw->merch->index))
				$operation->merch->index = $raw->merch->index;
			if (isset($raw->merch->country))
				$operation->merch->country = $raw->merch->country;
		}

		if (isset($raw->tax)) {
			$operation->tax = new \stdClass();

			if (isset($raw->tax->kbk))
				$operation->tax->kbk = $raw->tax->kbk;
			if (isset($raw->tax->oktmo))
				$operation->tax->oktmo = $raw->tax->oktmo;
			if (isset($raw->tax->payerStatus))
				$operation->tax->payerStatus = $raw->tax->payerStatus;
			if (isset($raw->tax->evidence))
				$operation->tax->evidence = $raw->tax->evidence;
			if (isset($raw->tax->period))
				$operation->tax->period = $raw->tax->period;
			if (isset($raw->tax->nalType))
				$operation->tax->nalType = $raw->tax->nalType;
			if (isset($raw->tax->docNumber))
				$operation->tax->docNumber = $raw->tax->docNumber;
			if (isset($raw->tax->docDate))
				$operation->tax->docDate = new \DateTime($raw->tax->docDate);
			if (isset($raw->tax->uin))
				$operation->tax->uin = $raw->tax->uin;
			if (isset($raw->tax->thirdPartyInn))
				$operation->tax->thirdPartyInn = $raw->tax->thirdPartyInn;
			if (isset($raw->tax->thirdPartyKpp))
				$operation->tax->thirdPartyKpp = $raw->tax->thirdPartyKpp;
		}
	}

}
