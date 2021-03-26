<?php

namespace App\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class ExcludeEmptyCountries implements Scope
{
    /**
     * @inheritdoc
     *
     * @param Builder $builder
     * @param Model $model
     */
    public function apply(Builder $builder, Model $model)
    {
        $builder->whereHas('channels', function (Builder $query) {
            return $query->withoutGlobalScopes()->where('active', true);
        });
    }
}
