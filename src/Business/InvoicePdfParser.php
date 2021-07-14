<?php

namespace Topvisor\TinkoffSdk\Business;

use Topvisor\TinkoffSdk\Core\Parser;

class InvoicePdfParser implements Parser {

	private static ?self $instance = NULL;

	private function __construct() {}

	public static function instance(): self {
		if (!self::$instance)
			self::$instance = new self();

		return self::$instance;
	}

	public function parse($raw) {
		$invoicePdf = new InvoicePdf();
		if (isset($raw->pdfUrl))
			$invoicePdf->pdfUrl = $raw->pdfUrl;

		return $invoicePdf;
	}

}