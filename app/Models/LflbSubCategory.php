<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Storage;
use Kirschbaum\PowerJoins\PowerJoins;

/**
 * @property integer $id
 * @property integer $category_id
 * @property string $_oldid
 * @property string $title
 * @property string $stories
 * @property string $stories_old
 * @property string $subTitle
 * @property string $mainImage
 * @property boolean $position
 * @property string $created_at
 * @property string $updated_at
 * @property LflbCategory $lflbCategory
 */
class LflbSubCategory extends Model
{
    use PowerJoins;
    /**
     * @var array
     */
    protected $fillable = ['category_id', '_oldid', 'title', 'stories', 'stories_old', 'subTitle', 'mainImage', 'position', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function lflbCategory()
    {
        return $this->belongsTo(LflbCategory::class, 'category_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function lflbStories()
    {
        return $this->belongsToMany(LflbStory::class, 'lflb_story_lflb_sub_category', 'lflb_sub_category_id', 'lflb_story_id')->withTimestamps();
    }

    protected $guarded = [];
    protected $casts = ['created_at' => 'datetime', 'updated_at' => 'datetime'];
    protected $with = ['lflbCategory'];

    public function getCreatedDateForHumansAttribute()
    {
        return Carbon::parse($this->created_at)->diffForHumans();
    }

    public function getUpdatedDateForHumansAttribute()
    {
        return Carbon::parse($this->updated_at)->diffForHumans();
    }
    // Custom code David F.
    public function storyIds()
    {
        return explode(',', $this->stories);
    }

    public function mainImageUrl()
    {
        return $this->mainImage
            ? Storage::disk('public')->url($this->mainImage)
            : 'https://via.placeholder.com/300x150.png?text=NO%20IMAGE';
    }
}
