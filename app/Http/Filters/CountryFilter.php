<?php

namespace App\Http\Filters;

use Illuminate\Database\Eloquent\Builder;
use Kodewbit\Meteor\Filter;

class CountryFilter extends Filter
{
    /**
     * Filter countries by name.
     *
     * @param string|null $name
     * @return Builder
     */
    public function name(string $name = null)
    {
        return $this->builder->where('name', 'LIKE', "%{$name}%");
    }
}
