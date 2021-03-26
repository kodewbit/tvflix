<?php

namespace App\Http\Filters;

use Illuminate\Database\Eloquent\Builder;
use Kodewbit\Meteor\Filter;

class ChannelFilter extends Filter
{
    /**
     * Filter channels by name.
     *
     * @param string|null $name
     * @return Builder
     */
    public function name(string $name = null)
    {
        return $this->builder->where('name', 'LIKE', "%{$name}%");
    }

    /**
     * Filter channels by description.
     *
     * @param string|null $description
     * @return Builder
     */
    public function description(string $description = null)
    {
        return $this->builder->where('description', 'LIKE', "%{$description}%");
    }

    /**
     * Filter channels by country.
     *
     * @param int|null $country
     * @return Builder
     */
    public function country(int $country = null)
    {
        return $this->builder->where('country_id', $country);
    }

    /**
     * Filter channels by category.
     *
     * @param int|null $category
     * @return Builder
     */
    public function category(int $category = null)
    {
        return $this->builder->whereHas('categories', function (Builder $query) use ($category) {
            return $query->where('category_id', $category);
        });
    }
}
