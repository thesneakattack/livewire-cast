<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
 * @property LflbStoryPart[] $lflbStoryParts
 */
class LflbAsset extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['_oldid', 'orgId', 'link', 'originalImage', 'type', 'text', 'cleanText', 'name', 'caption', 'tags', 'thumbnail'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function lflbStoryParts()
    {
        return $this->hasMany('App\Models\LflbStoryPart', 'asset_id');
    }
}
