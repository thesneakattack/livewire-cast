<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property string $_oldid
 * @property string $contributor
 * @property string $creator
 * @property string $description
 * @property string $format
 * @property string $identifier
 * @property string $language
 * @property string $publisher
 * @property string $relation
 * @property string $rights
 * @property string $source
 * @property string $subject
 * @property string $type
 */
class LflbMetadatum extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['_oldid', 'contributor', 'creator', 'description', 'format', 'identifier', 'language', 'publisher', 'relation', 'rights', 'source', 'subject', 'type'];
}
