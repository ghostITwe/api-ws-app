<?php

namespace App\Filters;

use DateTime;
use Illuminate\Database\Eloquent\Builder;

class CreatedFilter
{
    /**
     * @throws \Exception
     */
    public function handle(Builder $query, $next, $request)
    {
        if ($request->date_start && $request->date_end) {
            $dateStart = (new DateTime($request->date_start))->setTime(0,0);
            $dateEnd = (new DateTime($request->date_end))->setTime(23,59, 59);

            $query->whereBetween('created_at', [$dateStart, $dateEnd]);
        }

        return $next($query);
    }
}
