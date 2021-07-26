<?php


namespace Latus\Content\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Content extends Model
{
    protected $fillable = [
        'type', 'name', 'owner_model_id', 'owner_model_class', 'title', 'text'
    ];

    public function owner(): BelongsTo
    {
        return $this->belongsTo($this->owner_model_class, 'owner_model_id');
    }

    public function translations(): HasMany
    {
        return $this->hasMany(ContentTranslation::class);
    }

}