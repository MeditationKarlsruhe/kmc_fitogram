<?php

namespace Fitogram;

class FitogramDataTransformer
{
    public static function transform($fitogramData)
    {
        return array_map(function ($feg) use ($fitogramData) {
            $fgEvents = $fitogramData->fitogramEvents;

            $fgProductsForEvents = array_reduce($fgEvents, function ($carry, $fge) use ($fitogramData) {
                $productId = $fge->id;
                $fitogramProduct = $fitogramData->products[array_search($productId, array_column($fitogramData->products, 'eventId'))]->fitogramProduct;

                $carry[$productId] = array_map(function ($p) {
                    return new Product($p->name, $p->recurringFeeAmount ?? $p->amount, $p->displaySalesPriceRhythm, $p->currencySymbol);
                }, $fitogramProduct);

                return $carry;
            }, []);

            $events = array_map(function ($e) use ($fgProductsForEvents) {
                return new Event($e->id, $e->start, $e->end, $e->timeZoneId, $fgProductsForEvents[$e->id]);
            }, $fgEvents);

            $eventText = $fitogramData->eventTexts[array_search($feg->id, array_column($fitogramData->eventTexts, 'eventGroupGuid'))]->fitogramEventText;

            return new EventGroup($feg->id, $feg->name, $eventText->content, $feg->imageUrl, $events);
        }, $fitogramData->fitogramEventGroups);
    }
}