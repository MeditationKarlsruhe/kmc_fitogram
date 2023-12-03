<?php

namespace Fitogram;

class FitogramEventGroup {
    public string $type;
    public string $categoryType;
    public ?int $seats;
    public ?bool $waitingListEnabled;
    public string $id;
    public ?int $numericId;
    public string $providerId;
    public string $name;
    public string $number;
    public string $color;
    public ?bool $public;
    public ?bool $archived;
    public ?object $archivedDate;
    public string $originalImageUrl;
    public string $imageUrl;
    public string $locationId;
    public array $trainerIds;
    public array $bookingGroupIds;
    public ?bool $multipleBookingEnabled;
    public ?bool $publicBookingEnabled;
    public ?object $publicBookingWindowStart;
    public ?object $publicBookingWindowEnd;
    public ?bool $publicCancellationEnabled;
    public ?object $publicCancellationWindowStart;
    public ?object $publicCancellationWindowEnd;
    public string $publicCancellationRefundEnd;
    public ?bool $deleted;
    public \DateTime $timeStamp;
    public ?int $categoryId;
    public ?bool $livestream;
}
