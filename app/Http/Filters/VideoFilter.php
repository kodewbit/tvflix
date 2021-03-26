<?php

namespace App\Http\Filters;

use Illuminate\Database\Eloquent\Builder;
use Kodewbit\Meteor\Filter;

class VideoFilter extends Filter
{
    /**
     * Filter videos by name.
     *
     * @param string|null $name
     * @return Builder
     */
    public function name(string $name = null)
    {
        return $this->builder->where('name', 'LIKE', "%{$name}%");
    }

    /**
     * Filter videos by description.
     *
     * @param string|null $description
     * @return Builder
     */
    public function description(string $description = null)
    {
        return $this->builder->where('description', 'LIKE', "%{$description}%");
    }

    /**
     * Filter videos by channel.
     *
     * @param int $channel
     * @return Builder
     */
    public function channel(int $channel)
    {
        return $this->builder->where('channel_id', $channel);
    }

    /**
     * Filter videos by category.
     *
     * @param int $category
     * @return Builder
     */
    public function category(int $category)
    {
        return $this->builder->whereHas('channel', function (Builder $query) use ($category) {
            return $query->whereHas('categories', function (Builder $query) use ($category) {
                return $query->where('category_id', $category);
            });
        });
    }

    /**
     * Filter videos by country.
     *
     * @param int $country
     * @return Builder
     */
    public function country(int $country)
    {
        return $this->builder->whereHas('channel', function (Builder $query) use ($country) {
            return $query->where('country_id', $country);
        });
    }
}
