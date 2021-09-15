<?php


namespace Latus\Content\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Latus\Content\Models\Traits\HasMediaAssets;
use Latus\Permalink\Generators\Contracts\PermalinkGenerator;
use Latus\Permalink\Models\Traits\HasPermalinks;

class Content extends Model
{
    use HasPermalinks, HasMediaAssets;

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

    public function getPermalinkGenerator(): PermalinkGenerator
    {
        return new \Latus\Permalink\Generators\PermalinkGenerator();
    }

    public function getPermalinkName(): string
    {
        return $this->title;
    }

    public function getPermalinkDate(): string
    {
        return $this->created_at;
    }

    public function getPermalinkId(): int|string
    {
        return $this->id;
    }
}