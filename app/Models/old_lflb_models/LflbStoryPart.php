<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $story_id
 * @property integer $asset_id
 * @property string $_oldid
 * @property string $caption
 * @property boolean $position
 * @property string $annotations
 * @property LflbAsset $lflbAsset
 * @property LflbStory $lflbStory
 */
class LflbStoryPart extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['story_id', 'asset_id', '_oldid', 'caption', 'position', 'annotations'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function lflbAsset()
    {
        return $this->belongsTo('App\Models\LflbAsset', 'asset_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function lflbStory()
    {
        return $this->belongsTo('App\Models\LflbStory', 'story_id');
    }
}
