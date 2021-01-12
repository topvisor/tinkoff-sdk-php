<?php

namespace Topvisor\TinkoffSdk\Core\Http;

class Headers {

	public array $valuesByName = [];

	public function add(Header $header): void {
		$values = $this->valuesByName[$header->getName()] ?? [];
		$values[] = $header->getValue();

		$this->valuesByName[$header->getName()] = $values;
	}

	public function set(Header $header): void {
		$this->valuesByName[$header->getName()] = [$header->getValue()];
	}

	public function del(string $name): void {
		$name = (new Header($name))->getName();

		unset($this->valuesByName[$name]);
	}

	public function get(string $name): ?array {
		$name = (new Header($name))->getName();

		return $this->valuesByName[$name] ?? NULL;
	}

	public function getAll(): array {
		return $this->valuesByName;
	}

	public function getAllStrings(): array {
		$headers = [];

		foreach ($this->valuesByName as $name => $values) {
			foreach ($values as $value)
				$headers[] = "$name: $value";
		}

		return $headers;
	}

}