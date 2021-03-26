<?php

namespace App\Models;

use App\Scopes\ExcludeInactive;
use App\Scopes\SortDescending;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Kodewbit\Meteor\Filterable;

/**
 * Class Video
 *
 * @package App\Models
 * @mixin Builder
 */
class Video extends Model
{
    use HasFactory, Filterable;

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
        'name',
        'description',
        'url',
        'identifier',
        'published',
        'active'
    ];

    /**
     * @inheritdoc
     *
     * @var array[]
     */
    protected $relations = [
        'channel',
        'thumbnails'
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
        static::addGlobalScope(new SortDescending('published'));
    }

    /**
     * Channel relationship.
     *
     * @return BelongsTo
     */
    public function channel()
    {
        return $this->belongsTo(Channel::class);
    }

    /**
     * Thumbnails relationship.
     *
     * @return MorphMany
     */
    public function thumbnails()
    {
        return $this->morphMany(Thumbnail::class, 'thumbnailable');
    }

    /**
     * Build video URL.
     *
     * @param string $identifier
     */
    public function setUrlAttribute(string $identifier)
    {
        $this->attributes['url'] = "https://www.youtube.com/watch?v={$identifier}";
    }

    /**
     * The YouTube API returns the date of the videos in ISO 8601 format.
     * This method converts it to UTC format.
     *
     * @param string $published
     */
    public function setPublishedAttribute(string $published)
    {
        $this->attributes['published'] = Carbon::parse($published)->setTimezone('UTC');
    }
}
