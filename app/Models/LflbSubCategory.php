<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Storage;

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
    /**
     * @var array
     */
    protected $fillable = ['category_id', '_oldid', 'title', 'stories', 'stories_old', 'subTitle', 'mainImage', 'position', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function lflbCategory()
    {
        return $this->belongsTo('App\Models\LflbCategory', 'category_id');
    }

    protected $guarded = [];
    protected $casts = ['created_at' => 'datetime'];

    public function getDateForHumansAttribute()
    {
        return Carbon::parse($this->created_at)->diffForHumans();
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
            : 'https://www.gravatar.com/avatar/' . md5(strtolower(trim($this->email)));
    }
}
