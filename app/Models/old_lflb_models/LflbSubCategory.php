<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
 * @property LflbCategory $lflbCategory
 */
class LflbSubCategory extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['category_id', '_oldid', 'title', 'stories', 'stories_old', 'subTitle', 'mainImage', 'position'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function lflbCategory()
    {
        return $this->belongsTo('App\Models\LflbCategory', 'category_id');
    }

    // Custom code David F.
    public function storyIds()
    {
        return explode(',', $this->stories);
    }      
}
