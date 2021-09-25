<?php


namespace Latus\Content\Repositories\Eloquent;


use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Latus\Content\Models\Content;
use Latus\Repositories\EloquentRepository;
use Latus\Content\Repositories\Contracts\ContentRepository as ContentRepositoryContract;

class ContentRepository extends EloquentRepository implements ContentRepositoryContract
{

    protected Content $relatedModel;

    public function setRelatedModel(Content $content)
    {
        $this->relatedModel = $content;
    }

    public function relatedModel(): Model
    {
        if (isset($this->{'relatedModel'})) {
            return $this->relatedModel;
        }

        return new Content();
    }

    public function delete(Content $content)
    {
        $content->delete();
    }

    public function findByOwner(string $ownerClass, string $ownerId): Model|null
    {
        return $this->relatedModel()::where('owner_model_class', $ownerClass)->where('owner_model_id', $ownerId)->first();
    }

    public function findByName(string $name): Model|null
    {
        return $this->relatedModel()::where('name', $name)->first();
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

    public function paginate(string $type, int $amount, \Closure $authorize = null): LengthAwarePaginator
    {
        $query = $this->relatedModel()::where('type', $type)->orderBy('created_at');

        if ($authorize) {
            $query->each($authorize);
        }

        return $query->paginate($amount);
    }
}