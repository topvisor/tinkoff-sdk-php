<?php

namespace Topvisor\TinkoffSdk\Business;

use DateTime;

/**
 * Class BankStatementOperation
 * @package Topvisor\TinkoffSdk\Business
 */
class BankStatementOperation {

    /**
     * Дата операции. В зависимости от статуса операции равна дате проведения по балансу или дате авторизации.
     */
    public DateTime $operationDate;

    /**
     * Уникальный ID операции.
     */
    public string $operationId;

    /**
     * Статус операции: авторизация или подтвержденная транзакция.
     */
    public ?string $operationStatus = NULL;

    /**
     * Номер счета.
     */
    public ?string $accountNumber = NULL;

    /**
     * БИК.
     */
    public ?string $bic = NULL;

    /**
     * Тип операции: Сredit — поступления, Debit — списания.
     */
    public ?string $typeOfOperation = NULL;

    /**
     * Категория операции.
     */
    public ?string $category = NULL;

    /**
     * Дата транзакции.
     */
    public ?DateTime $trxnPostDate = NULL;

    /**
     * Дата авторизации.
     */
    public ?DateTime $authorizationDate = NULL;

    /**
     * Дата списано.
     */
    public DateTime $drawDate;

    /**
     * Дата поступило.
     */
    public DateTime $chargeDate;

    /**
     * Дата создания документа.
     */
    public ?DateTime $docDate = NULL;

    /**
     * Номер платежного документа.
     */
    public ?string $documentNumber = NULL;

    /**
     * Вид операции (строка).
     */
    public ?string $payVo = NULL;

    /**
     * Вид операции (номер).
     */
    public ?string $vo = NULL;

    /**
     * Очередность платежа.
     */
    public ?int $priority = NULL;

    /**
     * Сумма в валюте операции.
     */
    public float $operationAmount;

    /**
     * Числовой код валюты операции.
     */
    public ?string $operationCurrencyDigitalCode = NULL;

    /**
     * Сумма в валюте счета.
     */
    public ?float $accountAmount = NULL;

    /**
     * Числовой код валюты счета.
     */
    public ?string $accountCurrencyDigitalCode = NULL;

    /**
     * Сумма в рублях по курсу ЦБ на дату операции.
     */
    public ?float $rubleAmount = NULL;

    /**
     * Описание операции.
     */
    public ?string $description = NULL;

    /**
     * Назначение платежа.
     */
    public ?string $payPurpose;


    /**
     * Информация о плательщике.
     *
     * @var object{
     *     @var string $name Наименование плательщика
     *     @var string|null $inn ИНН плательщика
     *     @var string|null $acct Номер счета плательщика
     *     @var string|null $corAcct Корреспондентский счет плательщика
     *     @var string|null $bicRu БИК банка плательщика
     *     @var string|null $bicSwift SWIFT-код банка плательщика
     *     @var string|null $bankName Название банка плательщика
     *     @var string|null $kpp КПП плательщика
     * }
     */
    public ?object $payer = NULL;

    /**
     * Информация о получателе.
     * @var ?object{
     *     @var string $name Наименование получателя
     *     @var string|null $inn ИНН получателя
     *     @var string|null $acct Номер счета получателя
     *     @var string|null $corAcct Корреспондентский счет получателя
     *     @var string|null $bicRu БИК получателя
     *     @var string|null $bicSwift SWIFT-код банка получателя
     *     @var string|null $bankName Название банка получателя
     *     @var string|null $kpp КПП получателя
     * }
     */
    public ?object $receiver = NULL;

    /**
     * Информация о контрагенте.
     * @var ?object{
     *     @var string|null $account Номер счета контрагента
     *     @var string|null $inn ИНН контрагента
     *     @var string|null $kpp КПП контрагента
     *     @var string|null $name Наименование контрагента
     *     @var string|null $bankName Название банка контрагента
     *     @var string|null $bankBic БИК банка контрагента
     *     @var string|null $bankSwiftCode SWIFT-код банка контрагента
     *     @var string|null $corrAccount Корреспондентский счет контрагента
     * }
     */
    public ?object $counterParty = NULL;

    /**
     * Маскированный номер карты.
     */
    public ?string $cardNumber = NULL;

    /**
     * UCID карты — ее уникальный идентификатор.
     */
    public ?int $ucid = NULL;

    /**
     * МСС операции.
     */
    public ?string $mcc = NULL;

    /**
     * Информация о мерчанте.
     * @var ?object{
     *     @var string|null $name Название мерчанта
     *     @var string|null $address Адрес мерчанта
     *     @var string|null $city Место совершения (город)
     *     @var string|null $index Почтовый индекс мерчанта
     *     @var string|null $country Место совершения (страна)
     * }
     */
    public ?object $merch = NULL;

    /**
     * Код авторизации.
     */
    public ?string $authCode = NULL;

    /**
     * RRN (Reference Retrieval Number) — уникальный идентификатор банковской транзакции.
     */
    public ?string $rrn = NULL;

    /**
     * ID эквайера.
     */
    public ?string $acquirerId = NULL;

    /**
     * Информация по налогам.
     * @var ?object{
     *     @var string|null $kbk КБК-код бюджетной классификации
     *     @var string|null $oktmo Код ОКТМО
     *     @var string|null $payerStatus Статус отправителя
     *     @var string|null $evidence Основание налогового платежа
     *     @var string|null $period Налоговый период / Код таможенного органа
     *     @var string|null $nalType Тип налогового документа
     *     @var string|null $docNumber Номер налогового документа
     *     @var DateTime|null $docDate Дата налогового документа
     *     @var string|null $uin Код УИН
     *     @var string|null $thirdPartyInn ИНН налогоплательщика
     *     @var string|null $thirdPartyKpp КПП налогоплательщика
     * }
     */
    public ?object $tax = NULL;
}
