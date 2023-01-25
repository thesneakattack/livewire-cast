<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $app_id
 * @property string $_oldid
 * @property string $title
 * @property string $description
 * @property string $image
 * @property string $imageUrl
 * @property string $categories_old
 * @property string $categories
 * @property string $startDay
 * @property string $startMonth
 * @property string $startYear
 * @property string $endDay
 * @property string $endMonth
 * @property string $endYear
 * @property string $locationName
 * @property string $location_lat
 * @property string $location_lng
 * @property string $metaData
 * @property LflbApp $lflbApp
 * @property LflbStoryPart[] $lflbStoryParts
 * @property LflbTag[] $lflbTags
 */
class LflbStory extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['app_id', '_oldid', 'title', 'description', 'image', 'imageUrl', 'categories_old', 'categories', 'startDay', 'startMonth', 'startYear', 'endDay', 'endMonth', 'endYear', 'locationName', 'location_lat', 'location_lng', 'metaData'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function lflbApp()
    {
        return $this->belongsTo('App\Models\LflbApp', 'app_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function lflbStoryParts()
    {
        return $this->hasMany('App\Models\LflbStoryPart', 'story_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function lflbTags()
    {
        return $this->hasMany('App\Models\LflbTag', 'story_id');
    }
}
