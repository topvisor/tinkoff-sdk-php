<?php

namespace Topvisor\TinkoffSdk\Business;

class Invoice implements \JsonSerializable {

	public string $invoiceNumber;
	public ?string $dueDate;
	public ?string $invoiceDate;
	public ?string $accountNumber;
	public ?InvoicePayer $payer;
	public ?array $items;
	public ?array $contacts;

	public function __destruct() {
		unset($this->payer);
		unset($this->items);
		unset($this->contacts);
	}

	public function jsonSerialize(): mixed {
		$obj = new \stdClass();
		$obj->invoiceNumber = $this->invoiceNumber;

		if(!is_null($this->dueDate ?? NULL))
			$obj->dueDate = $this->dueDate;
		if(!is_null($this->invoiceDate ?? NULL))
			$obj->invoiceDate = $this->invoiceDate;
		if(!is_null($this->accountNumber ?? NULL))
			$obj->accountNumber = $this->accountNumber;
		if(!is_null($this->payer ?? NULL))
			$obj->payer = $this->payer;
		if(!is_null($this->items ?? NULL))
			$obj->items = $this->items;
		if(!is_null($this->contacts ?? NULL))
			$obj->contacts = $this->contacts;

		return $obj;
	}
}