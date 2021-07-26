<?php


namespace Latus\Content\Repositories\Eloquent;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Latus\Content\Models\Content;
use Latus\Repositories\EloquentRepository;
use Latus\Content\Repositories\Contracts\ContentRepository as ContentRepositoryContract;

class ContentRepository extends EloquentRepository implements ContentRepositoryContract
{

    public function delete(Content $content)
    {
        $content->delete();
    }

    public function findByOwner(string $ownerClass, string $ownerId): Model|null
    {
        return Content::where('owner_model_class', $ownerClass)->where('owner_model_id', $ownerId)->first();
    }

    public function findByName(string $name): Model|null
    {
        return Content::where('name', $name)->first();
    }

    public function getTranslations(Content $content): Collection
    {
        return $content->translations()->get();
    }

    public function getTranslation(Content $content, string $language): Model|null
    {
        return $content->translations()->where('language', $language)->first();
    }

    public function setTitle(Content $content, ?string $title)
    {
        $content->title = $title;
        $content->save();
    }

    public function setText(Content $content, string $text)
    {
        $content->text = $text;
        $content->save();
    }
}