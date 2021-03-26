<?php

namespace App\Scopes;

use App\Models\Channel;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class ExcludeInactive implements Scope
{
    /**
     * @inheritdoc
     *
     * @param Builder $builder
     * @param Model $model
     */
    public function apply(Builder $builder, Model $model)
    {
        if ($model->is(new Channel())) {
            $builder
                ->whereHas('country')
                ->whereDoesntHave('categories', function (Builder $query) {
                    return $query->withoutGlobalScopes()->where('active', false);
                });
        }

        $builder->where('active', true);
    }
}
