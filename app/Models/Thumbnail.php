<?php

namespace App\Models;

use App\Scopes\ExcludeInactive;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

/**
 * Class Thumbnail
 *
 * @package App\Models
 * @mixin Builder
 */
class Thumbnail extends Model
{
    use HasFactory;

    /**
     * @inheritdoc
     *
     * @var string[]
     */
    protected $guarded = [
        'id',
    ];

    /**
     * @inheritdoc
     *
     * @var string[]
     */
    protected $fillable = [
        'url',
        'size',
        'width',
        'height',
        'active'
    ];

    /**
     * @inheritdoc
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new ExcludeInactive());
    }

    /**
     * Thumbnails relationship.
     *
     * @return MorphTo
     */
    public function thumbnailable()
    {
        return $this->morphTo();
    }
}
