<?php

namespace Condividendo\LaravelCBI\Traits;

use Illuminate\Support\Carbon;

trait UsesDate
{
    /**
     * @param string|\Illuminate\Support\Carbon $date
     */
    protected static function makeDate($date): Carbon
    {
        /** @phpstan-ignore-next-line */
        return Carbon::make($date);
    }

    /**
     * @param string|\Illuminate\Support\Carbon $date
     */
    protected static function makeDateIso8601($date): Carbon
    {
        return Carbon::parse($date)->toIso8601String();
    }
}
