<?php

namespace Fitogram;





class EventGroup {
    public string $id;
    public string $name;
    public string $content;
    public string $imageUrl;
    public array $events;
}

class Event {
    public string $id;
    public \DateTime $start;
    public \DateTime $end;
    public string $timeZoneId;
    public array $products;
}

class Product {
    public string $name;
    public float $amount;
    public string $displaySalesPriceRhythm;
    public string $currencySymbol;
}

class FitogramEventText {
    public string $key;
    public string $language;
    public string $content;
    public \DateTime $timeStamp;
}












