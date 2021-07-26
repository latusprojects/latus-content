<?php


namespace Latus\Content\Repositories\Eloquent;


use Illuminate\Database\Eloquent\Model;
use Latus\Content\Models\ContentTranslation;
use Latus\Content\Repositories\Contracts\ContentTranslationRepository as ContentTranslationRepositoryContract;
use Latus\Repositories\EloquentRepository;

class ContentTranslationRepository extends EloquentRepository implements ContentTranslationRepositoryContract
{

    public function delete(ContentTranslation $contentTranslation)
    {
        $contentTranslation->delete();
    }

    public function getContent(ContentTranslation $contentTranslation): Model
    {
        return $contentTranslation->content()->first();
    }

    public function setTitle(ContentTranslation $contentTranslation, ?string $title)
    {
        $contentTranslation->title = $title;
        $contentTranslation->save();
    }

    public function setText(ContentTranslation $contentTranslation, string $text)
    {
        $contentTranslation->text = $text;
        $contentTranslation->save();
    }
}