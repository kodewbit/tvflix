<?php

namespace App\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class SortDescending implements Scope
{
    /**
     * Column by which to sort by default.
     *
     * @var string
     */
    private $column;

    /**
     * SortDescending constructor.
     *
     * @param string $column
     */
    public function __construct(string $column = 'created_at')
    {
        $this->column = $column;
    }

    /**
     * @inheritdoc
     *
     * @param Builder $builder
     * @param Model $model
     */
    public function apply(Builder $builder, Model $model)
    {
        $builder->orderByDesc($this->column);
    }
}
