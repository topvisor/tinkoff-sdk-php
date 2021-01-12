<?php

namespace Topvisor\TinkoffSdk\Core;

class ArrayParser implements Parser {

	private Parser $itemParser;

	public function __construct(Parser $itemParser) {
		$this->itemParser = $itemParser;
	}

	public function parse($raw) {
		$data = [];

		if (!is_array($raw))
			throw new \Exception('wrong array: ' . json_encode($raw));

		foreach ($raw as $item)
			$data[] = $this->itemParser->parse($item);

		return $data;
	}

}