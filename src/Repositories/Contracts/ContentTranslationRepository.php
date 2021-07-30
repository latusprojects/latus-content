<?php


namespace Latus\Content\Repositories\Contracts;


use Illuminate\Database\Eloquent\Model;
use Latus\Content\Models\ContentTranslation;
use Latus\Repositories\Contracts\Repository;

interface ContentTranslationRepository extends Repository
{

    public function delete(ContentTranslation $contentTranslation);

    public function getContent(ContentTranslation $contentTranslation): Model;

    public function setTitle(ContentTranslation $contentTranslation, string|null $title);

    public function setText(ContentTranslation $contentTranslation, string $text);

}