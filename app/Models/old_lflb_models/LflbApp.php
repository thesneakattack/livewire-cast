<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property string $_oldid
 * @property string $name
 * @property string $orgId
 * @property string $description
 * @property string $image
 * @property string $categories
 * @property string $categories_old
 * @property string $mapCenterAddress
 * @property string $mapCenterAddressCoords_lat
 * @property string $mapCenterAddressCoords_lng
 * @property string $mainColor
 * @property string $secondaryColor
 * @property LflbStory[] $lflbStories
 */
class LflbApp extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['_oldid', 'name', 'orgId', 'description', 'image', 'categories', 'categories_old', 'mapCenterAddress', 'mapCenterAddressCoords_lat', 'mapCenterAddressCoords_lng', 'mainColor', 'secondaryColor'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function lflbStories()
    {
        return $this->hasMany('App\Models\LflbStory', 'app_id');
    }
}
