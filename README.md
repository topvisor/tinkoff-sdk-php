# tinkoff-sdk-php

SDK для Tinkoff Api

# Установка

Используйте [composer](https://getcomposer.org/) для установки

composer.json
```json
{
    "require": {
        "topvisor/tinkoff-sdk-php": "~0.15"
    }
}
```

# Пример использования библиотеки

Для работы с api требуется авторизоваться в [Tinkoff Id](https://business.tinkoff.ru/openapi/docs#section/Avtorizaciya-v-Tinkoff-Id).

```php
use Topvisor\TinkoffSdk\Id\AuthToken;
use Topvisor\TinkoffSdk\Id\Session;

$accessToken = ''; // подставьте ваш access token
$expired = (new DateTime('2022-01-01'))->getTimestamp();

$authToken = new AuthToken($accessToken, $expired);
$session = new Session($authToken); // используется для дальнейших запросов к api
```

## Методы

* [Tinkoff Business OpenApi](#tinkoff-business-openapi)
    * [Выставить счет](#выставить-счет)
    * [Получить счета](#получить-счета)
    * [Получить выписку по счету](#получить-выписку-по-счету)

### Tinkoff Business OpenApi

Пример обработки ошибок

```php
use Topvisor\TinkoffSdk\Business\Error;

try {
	$data = $service->get();
} catch (Throwable $e) {
    if ($e instanceof Error) {
        // ошибка Tinkoff Business OpenApi
        var_dump($e->statusCode);
        var_dump($e->id);
        var_dump($e->xRequestId);
        var_dump($e->getCode());
        var_dump($e->getMessage());
        var_dump($e->details);
    } else {
        // остальные ошибки
        // ...
    }
} 
```

#### Выставить счет

```php
use Topvisor\TinkoffSdk\Business\Invoice;
use Topvisor\TinkoffSdk\Business\InvoicePayer;
use Topvisor\TinkoffSdk\Business\InvoiceItem;
use Topvisor\TinkoffSdk\Business\InvoiceService;

$payer = new InvoicePayer();
$payer->inn = '730990470834';

$item = new InvoiceItem();
$item->name = 'Test';
$item->price = 10;
$item->unit = ' ';
$item->vat = 'None';
$item->amount = 1;

$invoice = new Invoice();
$invoice->invoiceNumber = '12345';
$invoice->payer = $payer;
$invoice->items = [$item];

$invoiceService = new InvoiceService($session);
$invoicePdf = $invoiceService->add($invoice);

var_dump($invoicePdf);
```

#### Получить счета

```php
use Topvisor\TinkoffSdk\Business\BankAccountsService;

$bankAccountsService = new BankAccountsService($session);
$bankAccounts = $bankAccountsService->get();

var_dump($bankAccounts);
```

#### Получить выписку по счету

```php
use Topvisor\TinkoffSdk\Business\BankStatementService;

$accountNumber = ''; // подставьте ваш номер счета
$from = new DateTime('2021-01-01');
$till = new DateTime('2021-01-31');

$bankStatementService = new BankStatementService($session);
$bankStatement = $bankStatementService->get($accountNumber, $from, $till);

var_dump($bankStatement);
```
