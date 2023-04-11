<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;

class SearchFilter
{
    public function handle(Builder $query, $next, $request)
    {
        if ($request->search) {
            $query->where('name', 'like', "%{$request->search}%");
        }

        return $next($query);
    }
}
