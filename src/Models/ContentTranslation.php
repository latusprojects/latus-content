<?php


namespace Latus\Content\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ContentTranslation extends Model
{
    protected $fillable = [
        'content_id', 'language', 'title', 'text'
    ];

    public function content(): BelongsTo
    {
        return $this->belongsTo(Content::class);
    }

}