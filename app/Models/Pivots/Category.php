<?php

namespace App\Models\Pivots;

use Illuminate\Database\Eloquent\Relations\Pivot;

class Category extends Pivot
{
    protected $table = 'lflb_story_lflb_sub_category';
    public function lflbStory()
    {
        return $this->belongsTo('App\Models\LflbStory');
    }

    public function lflbSubCategory()
    {
        return $this->belongsTo('App\Models\LflbSubCategory');
    }

    public function lflbCategory()
    {
        return $this->hasManyThrough(
            'App\Models\LflbCategory',
            'App\Models\LflbSubCategory',
            'category_id',
            'category_id'
        );
    }
}
