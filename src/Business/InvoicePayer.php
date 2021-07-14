<?php

namespace Topvisor\TinkoffSdk\Business;

class InvoicePayer implements \JsonSerializable {

	public ?string $name;
	public ?string $inn;
	public ?string $kpp;

	public function jsonSerialize() {
		$obj = new \stdClass();

		if(!is_null($this->name ?? NULL))
			$obj->name = $this->name;
		if(!is_null($this->inn ?? NULL))
			$obj->inn = $this->inn;
		if(!is_null($this->kpp ?? NULL))
			$obj->kpp = $this->kpp;

		return $obj;
	}

}