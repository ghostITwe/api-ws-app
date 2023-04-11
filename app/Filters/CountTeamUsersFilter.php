<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;

class CountTeamUsersFilter
{
    public function handle(Builder $query, $next, $request)
    {
        if ($request->user_count_from && $request->user_count_to) {
            $query->whereHas('team', function (Builder $q) {
                $q->whereHas('users', function (Builder $subq) {

                });
            });
        }

        return $next($query);
    }
}
