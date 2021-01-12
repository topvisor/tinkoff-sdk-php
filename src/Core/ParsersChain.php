<?php

namespace Topvisor\TinkoffSdk\Core;

class ParsersChain implements Parser {

	private array $parsers;

	public function __construct(Parser ...$parsers) {
		$this->parsers = $parsers;
	}

	public function __destruct(){
		for ($i = 0; $i < count($this->parsers); $i++)
			unset($this->parsers[$i]);
	}

	public function parse($raw) {
		foreach ($this->parsers as $parser)
			$raw = $parser->parse($raw);

		return $raw;
	}

}