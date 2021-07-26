<?php


namespace Latus\Content\Repositories\Contracts;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Latus\Content\Models\Content;
use Latus\Repositories\Contracts\Repository;

interface ContentRepository extends Repository
{

    public function __construct(Content $content);

    public function delete(Content $content);

    public function findByOwner(string $ownerClass, string $ownerId): Model|null;

    public function findByName(string $name): Model|null;

    public function getTranslations(Content $content): Collection;

    public function getTranslation(Content $content, string $language): Model|null;

    public function setTitle(Content $content, string|null $title);

    public function setText(Content $content, string $text);

}