<?php

namespace Includes;

final class Init
{
    public static function getServices()
    {
        return [Pages\Admin::class, Base\SettingsLink::class, Base\EnqueueController::class];
    }
    public static function registerServices()
    {
        foreach (self::getServices() as $class) {
            $service = new $class();
            $service->register();
        }
    }
}
