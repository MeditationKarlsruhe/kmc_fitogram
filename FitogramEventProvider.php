<?php


namespace Fitogram;

class FitogramEventProvider
{
    private static \JMS\Serializer\Serializer $serializer;
    private static string $providerId = "ea44f9bd-729e-4d3f-bf1c-e5c25334f487";

    public function __construct()
    {
        if (self::$serializer === null) {
            self::$serializer = \JMS\Serializer\SerializerBuilder::create()->build();
        }
    }

    public static function provide($color)
    {
        $fgEventGroups = self::getEventGroups($color);
        $fgEvents = self::getEvents($color);
        $fgEventTexts = self::getEventTexts($fgEventGroups);
        $fgProducts = self::products($fgEvents);

        $result = new \Fitogram\FitogramData();
        $result->fitogramEventGroups = $fgEventGroups;
        $result->fitogramEvents = $fgEvents;
        $result->eventTexts = $fgEventTexts;
        $result->products = $fgProducts;
        return $result;
    }

    private static function getEventGroups($color)
    {
        $eventGroups = self::download(
            "https://event-service.fitogram.pro/eventgroups?archived=false&providerId=" . self::$providerId,
            \Fitogram\FitogramEventGroup::class
        );

        return array_filter($eventGroups, function ($eventGroup) use ($color) {
            return $eventGroup->color == $color;
        });
    }

    private static function download(string $url, string $type)
    {
        $body = wp_remote_retrieve_body(wp_remote_get($url));

        return self::$serializer->deserialize($body, 'array<' . $type . '>', 'json');
    }

    private static function products($events)
    {
        $eventIds = array_map(function ($event) {
            return $event->id;
        }, $events);

        return array_map(function ($eId) {
            return ['eventId' => $eId, 'fitogramProducts' => self::getProducts($eId)];
        }, $eventIds);
    }

    private static function getProducts($eventId)
    {
        return self::download(
            "https://api.fitogram.pro/event/{$eventId}/products/public",
            \Fitogram\FitogramProduct::class
        );
    }

    private static function getEventTexts($eventGroups)
    {
        $eventGroupIds = array_map(function ($eg) {
            return $eg->id;
        }, $eventGroups);

        $getEventText = function ($eventGroupId) {
            return self::download(
                "https://event-service.fitogram.pro/texts/EventGroup-{$eventGroupId}/de",
                \Fitogram\FitogramEventText::class
            );
        };

        return array_map(function ($eventGroupId) use ($getEventText) {
            return [$eventGroupId, $getEventText($eventGroupId)];
        }, $eventGroupIds);
    }

    private static function getEvents($color)
    {
        $fromDate = urlencode(date("c"));
        $request = "https://event-service.fitogram.pro/events?archived=false&from={$fromDate}&size=1000&providerId="
            . self::$providerId;

        $events = json_decode(file_get_contents($request));
        $isColor = function ($e) use ($color) {
            return $e->public && $e->color == $color;
        };

        return array_filter($events, $isColor);
    }
}


