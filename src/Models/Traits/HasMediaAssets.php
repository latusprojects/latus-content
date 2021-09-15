<?php

namespace Latus\Content\Models\Traits;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Latus\Content\Models\MediaAsset;

trait HasMediaAssets
{
    /**
     * Returns has-many relationship to the MediaAsset-model
     *
     * @return HasMany
     */
    public function mediaAssets(): HasMany
    {
        return $this->hasMany(MediaAsset::class, 'owner_model_id')->where('owner_model_class', static::class);
    }
}