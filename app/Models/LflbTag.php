<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $story_id
 * @property string $_oldid
 * @property string $storyid
 * @property string $value
 * @property LflbStory $lflbStory
 */
class LflbTag extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['story_id', '_oldid', 'storyid', 'value'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function lflbStory()
    {
        return $this->belongsTo('App\Models\LflbStory', 'story_id');
    }
}
