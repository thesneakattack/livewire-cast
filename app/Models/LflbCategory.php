<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property string $_oldid
 * @property string $title
 * @property string $description
 * @property string $coverPhoto
 * @property string $sub_categories_old
 * @property string $sub_categories
 * @property string $featured
 * @property string $introText
 * @property string $bodyText
 * @property string $mainImage
 * @property string $created_at
 * @property string $updated_at
 * @property LflbSubCategory[] $lflbSubCategories
 */
class LflbCategory extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['_oldid', 'title', 'description', 'coverPhoto', 'sub_categories_old', 'sub_categories', 'featured', 'introText', 'bodyText', 'mainImage', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function lflbSubCategories()
    {
        return $this->hasMany('App\Models\LflbSubCategory', 'category_id');
    }
}
