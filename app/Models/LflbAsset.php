<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Storage;

/**
 * @property integer $id
 * @property string $_oldid
 * @property string $orgId
 * @property string $link
 * @property string $originalImage
 * @property string $type
 * @property string $text
 * @property string $cleanText
 * @property string $name
 * @property string $caption
 * @property string $tags
 * @property string $thumbnail
 * @property string $created_at
 * @property string $updated_at
 * @property LflbStoryPart[] $lflbStoryParts
 */
class LflbAsset extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['_oldid', 'orgId', 'link', 'originalImage', 'type', 'text', 'cleanText', 'name', 'caption', 'tags', 'thumbnail', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function lflbStoryParts()
    {
        return $this->hasMany('App\Models\LflbStoryPart', 'asset_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function lflbStories()
    {
        return $this->belongsToMany(LflbStory::class, 'lflb_story_parts', 'asset_id', 'story_id')->withPivot(['position', 'caption'])->withTimestamps();
    }

    protected $guarded = [];
    protected $casts = ['created_at' => 'datetime'];
    // protected $with = ['lflbApp', 'lflbStoryParts'];

    public function getDateForHumansAttribute()
    {
        return Carbon::parse($this->created_at)->diffForHumans();
    }

    public function mainImageUrl()
    {
        return $this->image
            ? Storage::disk('public')->url($this->image)
            : 'https://www.gravatar.com/avatar/' . md5(strtolower(trim($this->email)));
    }
}
