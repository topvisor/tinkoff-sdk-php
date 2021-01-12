<?php

namespace Topvisor\TinkoffSdk\Core\Http;

class Header {

	private string $name;
	private string $value;

	public function __construct(string $name = '', string $value = '') {
		$this->setName($name);
		$this->setValue($value);
	}

	function setName(string $name): void {
		$name = strtolower($name);
		$name = preg_replace("~[^a-zA-Z0-9]+~", "-", $name);
		$name = trim($name, '-');
		$name = ucwords($name, '-');

		$this->name = $name;
	}

	function setValue(string $value): void {
		$value = trim($value);

		$this->value = $value;
	}

	function getName(): string {
		return $this->name;
	}

	function getValue(): string {
		return $this->value;
	}

}