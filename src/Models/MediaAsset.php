<?php

namespace Latus\Content\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MediaAsset extends Model
{
    protected $fillable = [
        'is_public', 'name', 'filename', 'description', 'owner_model_id', 'owner_model_class', 'reference', 'tags', 'virtual_folder'
    ];

    protected $hidden = [
        'created_at', 'updated_at'
    ];

    protected $attributes = [
        'description' => ''
    ];

    public function owner(): BelongsTo
    {
        return $this->belongsTo($this->owner_model_class, 'owner_model_id');
    }
}