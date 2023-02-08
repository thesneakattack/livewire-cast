<?php

namespace App\Models;

use App\Models\Pivots\Category;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Storage;
use Kirschbaum\PowerJoins\PowerJoins;

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
 * @property string $created_at
 * @property string $updated_at
 * @property LflbApp $lflbApp
 * @property LflbStoryPart[] $lflbStoryParts
 * @property LflbTag[] $lflbTags
 * @property LflbAsset[] $lflbAssets
 */
class LflbStory extends Model
{
    use PowerJoins;
    /**
     * @var array
     */
    protected $fillable = ['app_id', '_oldid', 'title', 'description', 'image', 'imageUrl', 'categories_old', 'categories', 'startDay', 'startMonth', 'startYear', 'endDay', 'endMonth', 'endYear', 'locationName', 'location_lat', 'location_lng', 'metaData', 'created_at', 'updated_at'];

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

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function lflbAssets()
    {
        return $this->belongsToMany(LflbAsset::class, 'lflb_asset_lflb_story', 'story_id', 'asset_id')->withPivot(['position', 'caption'])->withTimestamps();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function lflbSubCategories()
    {
        return $this->belongsToMany(LflbSubCategory::class, 'lflb_story_lflb_sub_category', 'lflb_story_id', 'lflb_sub_category_id')->withTimestamps();
    }

    public function lflbCategories()
    {
        $collection = $this->lflbSubCategories;
        $grouped = $collection->mapToGroups(function ($item, $key) {
            return [$item->lflbCategory->title => $item];
        });
        // ->map(function ($group) {
        //     return $group->all();
        // })->all();

        return $grouped;
    }

    protected $guarded = [];
    protected $casts = ['created_at' => 'datetime', 'updated_at' => 'datetime'];
    protected $with = ['lflbSubCategories'];

    public function getDateForHumansAttribute()
    {
        return Carbon::parse($this->updated_at)->diffForHumans();
    }

    public function mainImageUrl()
    {
        return $this->image
            ? Storage::disk('public')->url($this->image)
            : 'https://via.placeholder.com/300x150.png?text=NO%20IMAGE';
    }
}
