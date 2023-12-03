<?php

namespace Fitogram;

class FitogramProduct
{
    public ?int $credits;
    public ?int $validQty;
    public string $validPeriod;
    public ?bool $autoBook;
    public ?bool $buyableAsVoucher;
    public ?int $voucherValidQty;
    public string $voucherValidPeriod;
    public array $bookingGroups;
    public int $id;
    public string $uuid;
    public string $providerUUID;
    public ?bool $archived;
    public ?bool $public;
    public ?int $order;
    public string $name;
    public string $type;
    public ?string $description;

    /**
     * @JMS\Serializer\Annotation\Type("array<Fitogram\FitogramProductDescription>")
     */
    public array $descriptions;
    public float $amount;
    public string $taxGroupId;
    public ?bool $onlyOnce;
    public ?object $inStockQty;
    public float $oneTimePrice;
    public float $recurringPrice;
    public ?float $displaySalesPrice;
    public string $displaySalesPriceRhythm;
    public string $currencyName;
    public string $currencySymbol;
    public ?bool $disablePayment;
    public ?bool $trial;
    public ?object $purchasedQty;
    public ?bool $individualPaymentMethods;
    public array $productPaymentMethods;
    public string $validPeriodType;
    public ?int $initialContractLength;
    public ?int $cancellationCount;
    public ?int $renewalCount;
    public string $initialFeeText;
    public string $recurringFeeText;
    public ?float $recurringFeeAmount;
    public string $contractRhythm;
    public string $paymentCycle;
}